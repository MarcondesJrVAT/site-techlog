<?php
/**
 * Base Controller
 *
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 * @date updated March 18, 2016
 */

namespace Babita\Mvc;

use Babita\Mvc\View;
use Babita\Core\I18n;

/**
 * Core controller, all other controllers extend this base controller.
 */
abstract class Controller
{
    /**
     * View variable to use the view class.
     *
     * @var object
     */
    public $view;

    /**
     * I18n variable to use the languages class.
     *
     * @var object
     */
    public $lang;

    /**
     * On run make an instance of the config class and view class.
     */
    public function __construct()
    {
        /** initialise the views object */
        $this->view = new View;

        /** initialise the language object */
        $this->lang = new I18n;
    }
}
