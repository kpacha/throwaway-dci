<?php

/**
 * @package SampleApp\Cast
 */

namespace SampleApp\Cast;

use SampleApp\Data\Person;
use ThrowawayDCI\Interactions;

/**
 * The class that casts the data object as the role
 * from http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
abstract class Actor extends Person implements ActorRequirements
{

    use Interactions;

    public function __construct(Person $p)
    {
        parent::__construct(get_object_vars($p));
    }

}
