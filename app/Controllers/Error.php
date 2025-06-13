<?php
/**
 * Example error controller
 *
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date March 17, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Controllers;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Error extends BaseController
{

    /**
     * $error holder.
     *
     * @var string
     */
    private $error = null;

    /**
     * Save error to $this->error.
     *
     * @param string $error
     */
    public function __construct($error = "Oops! Page not found...")
    {
        parent::__construct();
        $this->error = $error;
    }

    /**
     * Load a 404 page with the error message.
     */
    public function index()
    {

        $data['title'] = '404 Página não encontrada';
        $data['error'] = $this->error;

        $this->renderSite('404', $data);
    }

}
