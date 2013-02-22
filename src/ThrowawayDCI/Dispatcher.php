<?php

/**
 * @package ThrowawayDCI
 */

namespace ThrowawayDCI;

/**
 * Simple dispatcher for the DCI pattern. It executes the required step of the
 * requested use case and instantiates a view with the right template
 * 
 * Inspired on the Core_Dispatcher from the [throwaway MVC framework]
 * (https://github.com/kpacha/throwaway) and the [Dion Moult's post]
 * (http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/)
 * 
 * @author Kpacha <kpacha666@gmail.com>
 */
class Dispatcher
{

    protected $_routes = array();

    /**
     * Starts all the dispatcher logic
     */
    public function __construct()
    {
        $this->_routes = $this->_loadRoutes();
    }

    /**
     * Return the specified route to given path
     * @param string $path
     * @return array|null
     */
    public function getRoute($path)
    {
        if (is_string($path) && isset($this->_routes[$path])) {
            $route = $this->_routes[$path];
        } else {
            $requestedPath = explode('/', $path);
            $route['useCase'] = APP_NAME . '\\Context\\' . (($requestedPath[1]) ? ucfirst($requestedPath[1]) : 'Default');
            $route['step'] = (isset($requestedPath[2])) ? $requestedPath[2] : 'default';
        }
        return $route;
    }

    /**
     * Load routes from external file default is APP_NAME/Resources/config/routes.json
     * @return array
     */
    private function _loadRoutes()
    {
        return json_decode(file_get_contents(CONFIG_PATH . '/routes.json'), true);
    }

    /**
     * Get the 'cleaned' requested uri
     * @return string the requested uri without the index.php part 
     */
    private function _getPath()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $path = $requestUri['path'];
        if (strlen($path) > 1) {
            $path = rtrim($path, '/');
        }
        return str_replace('//', '/', str_replace('index.php', '', $path));
    }

    /**
     * Shows the content
     * @param array $viewVars
     */
    private function _fetchView($viewVars)
    {
        $view = new Template(VIEW_PATH . '/' . $viewVars['useCase'] . '/' . $viewVars['step'] . '.phtml');
        foreach ($viewVars as $key => $value) {
            $view->set($key, $value);
        }

        $layoutTemplate = (!empty($viewVars['layout'])) ? $viewVars['layout'] : 'default';
        $layout = new Template(VIEW_PATH . '/layout/' . $layoutTemplate . '.phtml');
        $layout->set('view', $view);

        echo $layout->fetch();
    }

    /**
     * Run the application
     */
    public function run()
    {
        try {
            $viewVars = $this->handle($this->_getRequest());
            $this->_fetchView($viewVars);
        } catch (Exception $e) {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /**
     * Route the request and return the context with the response
     * @return Core\Context
     */
    private function handle($request = null)
    {
        $route = $this->getRoute($this->_getPath());
        $contextClass = $route['useCase'];
        $step = $route['step'];
        $context = new $contextClass($step);

        return $context->$step($request);
    }

    private function _getRequest()
    {
        return $_REQUEST;
    }

}