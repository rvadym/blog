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
    public $db;
    public $db_name = '';
    public $db_path = '../db/';
    public $db_extn = '.sqlite3';
    public $db_user = '';
    public $db_pass = '';

    function init() {
        parent::init();
        exit('ddd');
        $this->getDB();
        if (is_a($this->api,'Api_Admin') ) {
            $this->api->menu->addMenuItem('rvadym/blog/admin','Blog');
            $this->routePages('rvadym_blog');
        }
    }
    private function getDB() {
        if (!$this->db) {
            $this->creteDBIfNotExist();
            $this->configureDatabase();
            $this->connect();
        }
        return $this->db;
    }
    private function creteDBIfNotExist() {
        $this->configureDatabase();
        if (!$this->databaseFileExist()) {
            $this->createDatabase();
        }
    }
    private function configureDatabase() {
        if ($this->db_name == '') {
            $this->db_name = str_replace(array('/','\\'),'_',$this->namespace);
        }
    }
    private function databaseFileExist() {
        var_dump('sqlite:'.$this->db_path.$this->db_name);
        exit();
    }
    private function createDatabase() {
    }


    /*
     *    array(
     *      'sqlite:../db/rvadym_blog.sqlite3',
     *      'username',
     *      'password'
     *    );
     */
    private function connect() {
        $connect_config = array('sqlite:'.$this->db_path.$this->db_name);
        if ($this->db_user) $connect_config[] = $this->db_user;
        if ($this->db_pass) $connect_config[] = $this->db_pass;

        $this->db = $this->add('DB');
        $this->db->connect();
    }
}
