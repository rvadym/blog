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
    public $api_var        = 'rvadym_blog';
    public $addon_name     = 'Agile Toolkit Blog Addon';
    public $addon_private_locations = array(
        'docs'      => 'docs',
        'php'       => 'lib',
        'page'      => 'page',
        'template'  => 'templates',
    );
    public $addon_public_locations  = array(
        'js'     => 'js',
        'css'    => 'css',
    );
    public $with_pages = true;

    public $db;
    public $db_name        = '';
    public $db_path        = '../db/';
    public $db_full_path   = '';
    public $file_full_path = '';
    public $db_extn        = '.sqlite3';
    public $db_user        = '';
    public $db_pass        = '';

    function init() {
        parent::init();
        $this->getDB();
        if (is_a($this->api,'Api_Admin') ) {
            $this->api->menu->addMenuItem('rvadym/blog/admin','Blog');
            $this->routePages('rvadym_blog');
        }
    }
    function addMenu($page) {
        $this->m = $page->add('Menu');
        $this->m->addMenuItem('rvadym/blog/admin','Admin');
    }
    private function getDB() {
        if (!$this->db) {
            $this->creteDBIfNotExist();
            $this->connect();
        }
        return $this->db;
    }
    private function creteDBIfNotExist() {
        $this->configureDatabase();
        !$this->checkDatabaseFile();
    }
    private function configureDatabase() {
        if ($this->db_name == '') {
            $this->db_name = str_replace(array('/','\\'),'_',$this->namespace);
        }
        if ($this->db_full_path == '') {
            $this->db_full_path = 'sqlite:'.$this->db_path.$this->db_name.$this->db_extn;
            $this->file_full_path = $this->db_path.$this->db_name.$this->db_extn;
        }
    }
    private function checkDatabaseFile() {
        if (!file_exists($this->file_full_path)) {
            $sqlite3 = new \SQLite3($this->file_full_path); // creates file if not exists
            $this->runMigrations($sqlite3);
            $sqlite3->close();
        }
    }


    /*
     *    array(
     *      'sqlite:../db/rvadym_blog.sqlite3',
     *      'username',
     *      'password'
     *    );
     */
    private function connect() {
        $connect_config = array($this->db_full_path);
        if ($this->db_user) $connect_config[] = $this->db_user;
        if ($this->db_pass) $connect_config[] = $this->db_pass;

        $this->db = $this->add('DB');
        $this->db->connect($connect_config);
    }

    private function runMigrations($pdo) {
        $pdo->query(
            'CREATE TABLE "rvadym_blog_article" (
                "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "title" TEXT NOT NULL,
                "text" TEXT
            );'
        );
    }
}
