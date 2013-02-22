<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

trait SourceAccountInteractions
{

    function drawMoney($amount)
    {
        if ($done = ($amount <= $this->getAmount())) {
            $this->setAmount($this->getAmount() - $amount);
        }
        return $done;
    }

}
