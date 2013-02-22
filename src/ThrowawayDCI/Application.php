<?php

/**
 * @package ThrowawayDCI
 */

namespace ThrowawayDCI;

/**
 * Application logic from the throwaway framework
 *
 * @author Kpacha <kpacha666@gmail.com>
 * @see https://github.com/kpacha/throwaway
 */
class Application
{

    /**
     * Autoloader to use
     *
     * @var ThrowawayDCI\Autoloader
     */
    protected $_autoloader;

    /**
     * Dispatcher
     *
     * @var ThrowawayDCI\Dispatcher
     */
    protected $_dispatcher;

    /**
     * The default constructor loads the composer autoloader and updates it with the
     * required namespaces
     */
    public function __construct()
    {
        define('PHP_ACTIVERECORD_AUTOLOAD_DISABLE', true);
        require_once LIBRARY_PATH . '/php-activerecord/php-activerecord/ActiveRecord.php';
        
        require_once LIBRARY_PATH . '/composer/ClassLoader.php';
        $this->_autoloader = new \Composer\Autoload\ClassLoader();

        // add the framework prefix
        $this->_autoloader->add("ThrowawayDCI", SRC_PATH);
        // add the application prefix
        $this->_autoloader->add(APP_NAME, SRC_PATH);
        $this->_autoloader->register();
        
        // composer autoloader
        require_once LIBRARY_PATH . '/autoload.php';
    }

    /**
     * Get dispatcher object
     *
     * @return Core_Dispatcher
     */
    public function getDispatcher()
    {
        if (null === $this->_dispatcher) {
            $this->_dispatcher = new Dispatcher();
        }
        return $this->_dispatcher;
    }

    /**
     * Run the application
     *
     * @return void
     */
    public function run()
    {
        $this->getDispatcher()->run($this->_getEntityManager());
    }
    
    private function _getEntityManager(){
        return DoctrineEntityManagerFactory::create();
    }

}
