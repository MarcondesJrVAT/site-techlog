<?php
/**
 * The base Model
 *
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date February 06, 2016
 * @date updated March 18, 2016
 */

namespace Babita\Mvc;

use Babita\Database\Database;

/**
 * Base model class all other models will extend from this base.
 */
abstract class Model
{
    /**
     * Object with methods to access the database
     *
     * @var object
     */
    protected $db;


    public function __construct()
    {
        /**
         * Create a new instance of the database componet.
         */
        $this->db = Database::get();
    }
}
