<?php
/**
 * @package SampleApp
 */
namespace SampleApp\Cast;

interface AccountRequirements
{

    public function getId();

    public function getName();

    public function getNumber();

    public function getUserId();

    public function getAmount();

    public function setId($id = 0);

    public function setName($name = '');

    public function setNumber($number = '');

    public function setUserId($userId = 0);

    public function setAmount($amount = 0);
}
