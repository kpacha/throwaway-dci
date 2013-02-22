<?php

/**
 * @package SampleApp\Role
 */

namespace SampleApp\Role;

trait PersistibleInteractions
{

    function persist($entityManager)
    {
        $entityManager->persist($this->getData());
        return true;
    }

}
