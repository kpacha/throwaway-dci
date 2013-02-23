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
    const DATA_DEFAULT = self::DATA_ACCOUNT;

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
        $v['sourceAccounts'] = self::$entityManager->getRepository('SampleApp\Data\Account')->findBy(array('userId' => 1));
        return $v; // v is just short for variables, a temporary table where all the view vars are stored
    }

    // this function looks messy, and actually does much more than only verify...
    function verifyStep($request = null)
    {
        $request = $request[0];
        if ($request['SourceAccount']['number'] == $request['DestinationAccount']['number']) {
            $v['message'] = 'Source and Destination are same';
            return $v;
        }

        $source = new SourceAccount($this->_getAccountRepo()->findOneBy(array('number' => $request['SourceAccount']['number'])));
        if (!$source) {
            $v['message'] = 'Invalid Source Account';
            return $v;
        }

        $destination = new DestinationAccount($this->_getAccountRepo()->findOneBy(array('number' => $request['DestinationAccount']['number'])));
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
            self::$entityManager->persist($source->getData());
            self::$entityManager->persist($destination->getData());
//            $this->log($source, $destination, $amount);
            self::$entityManager->flush();
            $v['message'] = 'Success';
        } else {
            $v['message'] = 'Operation failed';
        }
        return $v;
    }

    private function _getDataTypeClass($requestedType = self::DATA_DEFAULT)
    {
        $requestdClassName = self::$_dataTypes[self::DATA_DEFAULT];
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
