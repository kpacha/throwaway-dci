<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

use SampleApp\Cast\Account;

class SourceAccount extends Account
{

    use SourceAccountInteractions;
}
