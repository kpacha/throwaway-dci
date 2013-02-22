<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

use SampleApp\Cast\Actor;
/**
 * Inject role interactions into the casting to make our final roleplayer.
 * Separating the Cast\Foo object and the final roleplaying object allow for 
 * reusing generic casts.
 * from http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
class Juliet extends Actor
{

    use JulietInteractions;
}
