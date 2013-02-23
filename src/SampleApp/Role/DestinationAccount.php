<?php
/**
 * @package SampleApp\Role
 */
namespace SampleApp\Role;

use SampleApp\Cast\Account;

class DestinationAccount extends Account
{

    use DestinationAccountInteractions;
}
