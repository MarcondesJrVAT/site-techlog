<?php
/**
 * Router - routing urls to closurs and controllers - modified from https://github.com/NoahBuscher/Macaw
 *
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 * @date updated February 08, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Babita\Core;

/**
 * Router class will load requested controller / closure based on url.
 */
class Router
{
    /**
     * Fallback for auto dispatching feature.
     *
     * @var boolean $fallback
     */
    public $fallback = true;

    /**
     * If true - do not process other routes when match is found
     *
     * @var boolean $halts
     */
    public $halts = true;

    /**
     * Array of routes
     *
     * @var array $routes
     */
    public $routes = [];

    /**
     * Array of methods
     *
     * @var array $methods
     */
    public $methods = [];

    /**
     * Array of callbacks
     *
     * @var array $callbacks
     */
    public $callbacks = [];

    /**
     * Set an error callback
     *
     * @var null $errorCallback
     */
    public $errorCallback = 'Babita\Core\Error@index';

    /** Set route patterns */
    public $patterns = array(
        ':any' => '[^/]+',
        ':num' => '-?[0-9]+',
        ':all' => '.*',
        ':hex' => '[[:xdigit:]]+',
        ':uuidV4' => '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}'
    );

    /**
     * Defines a route with or without callback and method.
     *
     * @param string $method
     * @param array @params
     */
    public function __call($method, $params)
    {
        $uri = dirname($_SERVER['PHP_SELF']).'/'.$params[0];

        $callback = $params[1];

        array_push($this->routes, $uri);
        array_push($this->methods, strtoupper($method));
        array_push($this->callbacks, $callback);
    }

    /**
     * Defines callback if route is not found.
     *
     * @param string $callback
     */
    public function error($callback)
    {
        $this->errorCallback = $callback;
    }

    /**
     * Don't load any further routes on match.
     *
     * @param  boolean $flag
     */
    public function haltOnMatch($flag = true)
    {
        $this->halts = $flag;
    }

    /**
     * Call object and instantiate.
     *
     * @param  object $callback
     * @param  array  $matched  array of matched parameters
     * @param  string $msg
     */
    public function invokeObject($callback, $matched = null, $msg = null)
    {
        $last = explode('/', $callback);
        $last = end($last);

        $segments = explode('@', $last);

        $controller = $segments[0];
        $method = $segments[1];

        $controller = $msg
        ? new $controller($msg)
        : new $controller();

        call_user_func_array(
            array($controller, $method),
            $matched ? $matched : []
        );
    }

    /**
     * autoDispatch by Volter9.
     *
     * Ability to call controllers in their controller/model/param way.
     */
    public function autoDispatch()
    {
        $uri = parse_url($_SERVER['QUERY_STRING'], PHP_URL_PATH);
        $uri = '/'.$uri;
        if (strpos($uri,DIR) === 0) {
            $uri=substr($uri,strlen(DIR));
        }
        $uri = trim($uri, ' /');
        $uri = ($amp = strpos($uri, '&')) !== false ? substr($uri, 0, $amp) : $uri;

        $parts = explode('/', $uri);

        $controller = array_shift($parts);
        $controller = $controller ? $controller : DEFAULT_CONTROLLER;
        $controller = ucwords($controller);

        $method = array_shift($parts);
        $method = $method ? $method : DEFAULT_METHOD;

        $args = !empty($parts) ? $parts : [];

        // Check for file
        if (!file_exists(BABITA.DS.CONTROLLERS_PATH.DS."$controller.php")) {
            return false;
        }

        $controller = "\Controllers\\$controller";
        $c = new $controller;

        if (method_exists($c, $method)) {
            call_user_func_array(array($c,$method),$args);
            //found method so stop
            return true;
        }

        return false;
    }

    /**
     * Runs the callback for the given request.
     */
    public function dispatch()
    {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $searches = array_keys($this->patterns);
        $replaces = array_values($this->patterns);

        $this->routes = str_replace('//', '/', $this->routes);

        $found_route = false;

        // parse query parameters

        $query = '';
        $q_arr = [];
        if (strpos($uri, '&') > 0) {
            $query = substr($uri, strpos($uri, '&') + 1);
            $uri = substr($uri, 0, strpos($uri, '&'));
            $q_arr = explode('&', $query);
            foreach ($q_arr as $q) {
                $qobj = explode('=', $q);
                $q_arr[] = array($qobj[0] => $qobj[1]);
                if (!isset($_GET[$qobj[0]])) {
                    $_GET[$qobj[0]] = $qobj[1];
                }
            }
        }

        // check if route is defined without regex
        if (in_array($uri, $this->routes)) {
            $route_pos = array_keys($this->routes, $uri);

            // foreach route position
            foreach ($route_pos as $route) {
                if ($this->methods[$route] == $method || $this->methods[$route] == 'ANY') {
                    $found_route = true;

                    //if route is not an object
                    if (!is_object($this->callbacks[$route])) {
                        //call object controller and method
                        $this->invokeObject($this->callbacks[$route]);
                        if ($this->halts) {
                            return;
                        }
                    } else {
                        //call closure
                        call_user_func($this->callbacks[$route]);
                        if ($this->halts) {
                            return;
                        }
                    }
                }

            }
            // end foreach

        } else {
            // check if defined with regex
            $pos = 0;

            // foreach routes
            foreach ($this->routes as $route) {
                $route = str_replace('//', '/', $route);

                if (strpos($route, ':') !== false) {
                    $route = str_replace($searches, $replaces, $route);
                }

                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if (
                        $this->methods[$pos] == $method
                        || $this->methods[$pos] == 'ANY'
                    ) {
                        $found_route = true;

                        //remove $matched[0] as [1] is the first parameter.
                        array_shift($matched);

                        if (!is_object($this->callbacks[$pos])) {
                            //call object controller and method
                            $this->invokeObject($this->callbacks[$pos], $matched);
                            if ($this->halts) {
                                return;
                            }
                        } else {
                            //call closure
                            call_user_func_array($this->callbacks[$pos], $matched);
                            if ($this->halts) {
                                return;
                            }
                        }
                    }
                }
                $pos++;
            }
            // end foreach
        }

        if ($this->fallback) {
            //call the auto dispatch method
            $found_route = $this->autoDispatch();
        }

        // run the error callback if the route was not found
        if (!$found_route) {

            if (!is_object($this->errorCallback)) {
                //call object controller and method
                $this->invokeObject($this->errorCallback);
                if ($this->halts) {
                    return;
                }
            } else {
                call_user_func($this->errorCallback);
                if ($this->halts) {
                    return;
                }
            }
        }
    }
}
