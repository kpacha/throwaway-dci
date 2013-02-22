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
    
    /**
     * Check if the step exists in the use case
     * @param String $step
     * @throws Core\Exception
     */
    public function __construct($step)
    {
        if (!method_exists($this, $this->_getStepMethodName($step))) {
            throw new Exception("Unknown step [$step] for the useCase " . self::$useCaseName);
        }
    }

    /**
     * Wrapper for the step execution. Adds some info about the use case and the executed step
     * @param String $name
     * @param array $arguments
     * @return array
     * @throws Core\Exception
     */
    public function __call($name, $arguments)
    {
        $stepMethod = $this->_getStepMethodName($name);
        if (!method_exists($this, $stepMethod)) {
            throw new Core_Exception("Unknown step [$stepMethod] for the useCase " . self::$useCaseName);
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
    private function _getStepMethodName($stepName)
    {
        return $stepName . 'Step';
    }

}
