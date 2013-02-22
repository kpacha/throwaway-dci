<?php

/**
 * @package SampleApp
 */

namespace SampleApp\Context;

use ThrowawayDCI\Context;

class MoneyTransfer extends Context
{

    // MoneyTransfer Use Case:
    // 1. user starts money transfer, and is displayed with money transfer form
    // 2. user then selects source account, destination account and amounnt of money to be sent
    // 3. user commits moneytransfer, system verifies
    // 4. system write logs about transfer

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
    function verifyStep()
    {
        throw new \ThrowawayDCI\Exception("undefined step");
    }

}
