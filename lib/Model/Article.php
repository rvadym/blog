<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vadym
 * Date: 12/13/13
 * Time: 1:59 PM
 * To change this template use File | Settings | File Templates.
 */
namespace rvadym\blog;
class Model_Article extends \Model_Table {
    public $table = 'rvadym_blog_article';
    function init() {
        parent::init();
        $this->db = $this->api->getInitiatedAddons('rvadym_blog')->db;
        $this->addField('title');
        $this->addField('text')->type('text');
    }
}