<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

/**
 * The methodfull role for Juliet
 * based on http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
trait JulietInteractions {
    public function rejectRomeo() {
        return $this->getName(). ': Not now, sorry.';
    }
}