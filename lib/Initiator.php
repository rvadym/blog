<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vadym
 * Date: 12/13/13
 * Time: 2:16 PM
 * To change this template use File | Settings | File Templates.
 */
 namespace rvadym\blog;
 class Initiator extends \Controller_Addon {
     public $namespace = 'rvadym\blog';
     public $addon_name = 'Agile Toolkit Blog Addon';

     function init() {
         parent::init();
         if (is_a($this->api,'Api_Admin') ) {
             $this->api->menu->addMenuItem('rvadym/blog/admin','Blog');
             $this->routePages('rvadym_blog');
         }
     }
 }
