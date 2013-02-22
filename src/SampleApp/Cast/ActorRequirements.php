<?php

/**
 * @package SampleApp\Cast
 */

namespace SampleApp\Cast;

/**
 * Interfaces allows us to specify what data objects can play this role.
 * based on http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
interface ActorRequirements
{

    public function getName();

    public function setName($name);
}
