<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

/**
 * The methodfull role for Romeo
 * based on http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
trait RomeoInteractions
{

    public function callJuliet()
    {
        return $this->getName() . ': Hey Juliet!';
    }

    public function leave()
    {
        return $this->getName() . ': Fine then. Goodbye.';
    }

}