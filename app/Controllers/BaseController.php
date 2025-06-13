<?php
/**
 * Example Welcome controller
 *
 *---------------------------------------------------------------------------------------
 * @author Fábio Assunção da Silva - fabioassuncao.com
 * @version 0.0.1
 * @date March 13, 2016
 *---------------------------------------------------------------------------------------
 */

namespace Controllers;

use Babita\Mvc\Controller;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class BaseController extends Controller
{

    public $menu;
    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->menu = require BABITA . 'menu.php';
    }

    /**
     * Define Index page title and load template files
     */
    public function renderSite($path_view, $data)
    {
        $data['menu'] = $this->renderMenu($this->menu);
        $this->view->render('header', $data);
        $this->view->render($path_view, $data);
        $this->view->render('footer', $data);
    }

    public function renderMenu($menu)
    {
      $path_url = '';

      if(!empty($_SERVER['REQUEST_URI'])){
          $path_url = ltrim($_SERVER['REQUEST_URI'], '/');
      }

      foreach ($menu as $key => $value) {


          if($value['submenu']){

              foreach ($value['submenu'] as $k => $v) {
                if($path_url == $menu[$key]['submenu'][$k]['slug']){
                  $menu[$key]['submenu'][$k]['status'] = 'active';
                  $menu[$key]['status'] = 'active';
                }
              }

          }else{

            if($path_url == $menu[$key]['slug'])
              $menu[$key]['status'] = 'active';

          }
      }

      return $menu;
    }
}
