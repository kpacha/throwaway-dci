<?php

/**
 * @package ThrowawayDCI
 */

namespace ThrowawayDCI;

/**
 * Common methods for the contexts
 * 
 * @author Kpacha <kpacha666@gmail.com>
 */
class Context
{

    protected static $useCaseName;
    protected static $entityManager;

    /**
     * Check if the step exists in the use case
     * 
     * @param String $step
     * @param type $entityManager
     * @throws Exception
     */
    public function __construct($step, $entityManager = null)
    {
        if (!method_exists($this, $this->_getStepMethodName($step))) {
            throw new Exception("Unknown step [$step] for the useCase " . self::$useCaseName);
        }
        self::$entityManager = $entityManager;
    }

    /**
     * Wrapper for the step execution. Adds some info about the use case and the executed step
     * 
     * @param String $name
     * @param array $arguments
     * @return array
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        $stepMethod = $this->_getStepMethodName($name);
        if (!method_exists($this, $stepMethod)) {
            throw new Exception("Unknown step [$stepMethod] for the useCase " . self::$useCaseName);
        }
        $viewVars = $this->$stepMethod($arguments);
        $viewVars['useCase'] = self::$useCaseName;
        $viewVars['step'] = $name;
        return $viewVars;
    }

    /**
     * Formats the tep method name
     * @param String $stepName
     * @return String
     */
    protected function _getStepMethodName($stepName)
    {
        return $stepName . 'Step';
    }

}
