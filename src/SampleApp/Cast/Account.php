<?php

/**
 * @package SampleApp\Cast
 */

namespace SampleApp\Cast;

use SampleApp\Data\Account as AccountData;
use ThrowawayDCI\Interactions;

/**
 * The class that casts the data object as the role
 * based on http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
abstract class Account implements AccountRequirements
{

    use Interactions;
    
    /**
     * the data wrapper
     * @var AccountRequirements
     */
    private $_data = null;

    public function __construct(AccountRequirements $account)
    {
        $this->_data = $account;
    }
    
    public function getData(){
        return $this->_data;
    }

    public function getId(){
        return $this->_data->getId();
    }

    public function getName(){
        return $this->_data->getId();
    }

    public function getNumber(){
        return $this->_data->getNumber();
    }

    public function getUserId(){
        return $this->_data->getUserId();
    }

    public function getAmount(){
        return $this->_data->getAmount();
    }

    public function setId($id = 0){
        return $this->_data->setId($id);
    }

    public function setName($name = ''){
        return $this->_data->setName($name);
    }

    public function setNumber($number = ''){
        return $this->_data->setNumber($number);
    }

    public function setUserId($userId = 0){
        return $this->_data->setUserId($userId);
    }

    public function setAmount($amount = 0){
        return $this->_data->setAmount($amount);
    }

}
