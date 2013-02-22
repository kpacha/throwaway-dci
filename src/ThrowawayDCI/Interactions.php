<?php

/**
 * @package ThrowawayDCI
 */

namespace ThrowawayDCI;

/**
 * What the role is able to do
 * from http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
trait Interactions
{

    public function link($roles)
    {
        foreach ($roles as $roleName => $roleInstance) {
            $this->$roleName = $roleInstance;
        }
    }

}
