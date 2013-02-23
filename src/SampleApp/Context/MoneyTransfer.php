<?php

/**
 * @package SampleApp
 */

namespace SampleApp\Context;

use ThrowawayDCI\Context;
use SampleApp\Role\DestinationAccount;
use SampleApp\Role\SourceAccount;

class MoneyTransfer extends Context
{
    // MoneyTransfer Use Case:
    // 1. user starts money transfer, and is displayed with money transfer form
    // 2. user then selects source account, destination account and amounnt of money to be sent
    // 3. user commits moneytransfer, system verifies
    // 4. system write logs about transfer

    const DATA_ACCOUNT = 'SampleApp\Data\Account';
    const DATA_MOBILEACCOUNT = 'SampleApp\Data\MobileAccount';
    const DATA_SAVESACCOUNT = 'SampleApp\Data\SavesAccount';
    
    const KEY_ACCOUNT = 'account';
    const KEY_MOBILEACCOUNT = 'mobile';
    const KEY_SAVESACCOUNT = 'saves';
    const KEY_DEFAULT = self::KEY_ACCOUNT;

    private static $_dataTypes = array(
        'account' => self::DATA_ACCOUNT,
        'mobile' => self::DATA_MOBILEACCOUNT,
        'saves' => self::DATA_SAVESACCOUNT
    );

    public function __construct($step, $entityManager = null)
    {
        parent::__construct($step, $entityManager);
        self::$useCaseName = substr(__CLASS__, strrpos(__CLASS__, '\\') + 1);
    }

    function startStep()
    {
        //find all possible source accounts for current user
        $userId = 1;

        foreach (self::$_dataTypes as $dataType => $className) {
            $v['sourceAccounts'][$dataType] = $this->_getAccountRepo($className)->findBy(array('userId' => $userId));
        }
        return $v; // v is just short for variables, a temporary table where all the view vars are stored
    }

    // this function looks messy, and actually does much more than only verify...
    function verifyStep($request = array())
    {
        $request = $request[0];
        if ($request['SourceAccount']['number'] == $request['DestinationAccount']['number']) {
            $v['message'] = 'Source and Destination are same';
            return $v;
        }

        $sourceDataType = $this->_getDataTypeClass($request['SourceAccount']['type']);
        $sourceData = $this->_getAccountRepo($sourceDataType)
                ->findOneBy(array('number' => $request['SourceAccount']['number']));
        $source = new SourceAccount($sourceData);
        if (!$source) {
            $v['message'] = 'Invalid Source Account';
            return $v;
        }

        $destinationDataType = $this->_getDataTypeClass($request['DestinationAccount']['type']);
        $destinationData = $this->_getAccountRepo($destinationDataType)
                ->findOneBy(array('number' => $request['DestinationAccount']['number']));
        $destination = new DestinationAccount($destinationData);
        if (!$destination) {
            $v['message'] = 'Invalid Destination Account';
            return $v;
        }

        $amount = $request['MoneyTransfer']['amount'];
        if ($amount <= 0) {
            $v['message'] = 'Invalid Amount';
            return $v;
        }

        if ($source->drawMoney($amount)) {
            $destination->deposit($amount);
            self::$entityManager->getConnection()->beginTransaction();
            try{
                self::$entityManager->persist($source->getData());
                self::$entityManager->persist($destination->getData());
//                $this->log($source, $destination, $amount);
                self::$entityManager->flush();
                self::$entityManager->getConnection()->commit();
                $v['message'] = 'Success';
            } catch (\Exception $exception){
                self::$entityManager->getConnection()->rollback();
                $v['message'] = $exception;
            }
            self::$entityManager->close();
        } else {
            $v['message'] = 'Operation failed';
        }
        return $v;
    }

    private function _getDataTypeClass($requestedType = self::KEY_DEFAULT)
    {
        $requestdClassName = self::$_dataTypes[self::KEY_DEFAULT];
        if (key_exists($requestedType, self::$_dataTypes)) {
            $requestdClassName = self::$_dataTypes[$requestedType];
        }
        return $requestdClassName;
    }

    private function _getAccountRepo($className = self::DATA_ACCOUNT)
    {
        return self::$entityManager->getRepository($className);
    }

}
