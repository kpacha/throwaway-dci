<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

trait DestinationAccountInteractions
{

    function deposit($amount)
    {
        $this->setAmount($this->getAmount() + $amount);
        return true;
    }

}
