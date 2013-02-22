<?php

/**
 * A dumb data object for an account.
 * based on https://github.com/DCI/dci-examples/blob/master/moneytransfer/php/risto-valimaki/
 * @package SampleApp\Data
 */

namespace SampleApp\Data;

/** 
 * @Entity
 * @Table(name="accounts")
 */
class Account
{

    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @Column(type="string") */
    private $name;

    /** @Column(type="string") */
    private $number;

    /** @Column(name="user_id", type="integer") */
    private $userId;

    /** @Column(type="integer") */
    private $amount;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setId($id = 0)
    {
        return $this->id = $id;
    }

    public function setName($name = '')
    {
        return $this->name = $name;
    }

    public function setNumber($number = '')
    {
        return $this->number = $number;
    }

    public function setUserId($userId = 0)
    {
        return $this->userId = $userId;
    }

    public function setAmount($amount = 0)
    {
        return $this->amount = $amount;
    }

}
