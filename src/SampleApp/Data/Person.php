<?php
/**
 * @package SampleApp\Data
 */
namespace SampleApp\Data;

/**
 * A dumb data object for a person.
 * based on http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
class Person
{

    public $name;

    public function __construct(Array $properties)
    {
        foreach ($properties as $propertyName => $propertyValue) {
            $this->{'set' . ucfirst($propertyName)}($propertyValue);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}
