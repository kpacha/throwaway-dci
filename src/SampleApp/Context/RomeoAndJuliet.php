<?php

/**
 * @package SampleApp\Context
 */

namespace SampleApp\Context;

use ThrowawayDCI\Context;
use SampleApp\Role\Romeo;
use SampleApp\Role\Juliet;
use SampleApp\Data\Person;

/**
 * Simple use case for the Romeo and Juliet use case
 * based on http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/
 */
class RomeoAndJuliet extends Context
{

    /**
     * Use case: enact Romeo & Juliet
     */
    private $romeo;
    private $juliet;

    public function __construct($step)
    {
        parent::__construct($step);
        self::$useCaseName = substr(__CLASS__, strrpos(__CLASS__, '\\') + 1);
    }

    public function startStep($request = null)
    {
        // Cast objects into roles
        $this->romeo = new Romeo(new Person(array('name' => 'Romeo')));
        $this->juliet = new Juliet(new Person(array('name' => 'Juliet')));

        // Defines connections between roles.
        $this->romeo->link(array(
            'juliet' => $this->juliet
        ));
        $this->juliet->link(array(
            'romeo' => $this->romeo
        ));

        $transcription = array();
        try {
            $transcription[] = $this->romeo->callJuliet();
            $transcription[] = $this->juliet->rejectRomeo();
            $transcription[] = $this->romeo->leave();
        } catch (Core_Exception $e) {
            $errors['misc'] = $e->getMessage();
        }

        $result['transcriptions'] = $transcription;
        $result['errors'] = (isset($errors))? : null;
        $result['status'] = (isset($errors)) ? 'failure' : 'success';
        return $result;
    }

}
