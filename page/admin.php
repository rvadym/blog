<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vadym
 * Date: 12/13/13
 * Time: 2:27 PM
 * To change this template use File | Settings | File Templates.
 */
namespace rvadym\blog;
class page_admin extends \Page {
    function init() {
        parent::init();
        //$this->m = $this->add('Menu');
        //$this->m->addMenuItem('rvadym/blog/admin/bla','Bla');
    }
    function page_index() {
        $this->add('View_Info')->set(__METHOD__);

        $cr = $this->add('CRUD');
        $cr->setModel('rvadym\\blog\\Article');
    }
    function page_bla() {
        $this->add('View_Info')->set(__METHOD__);
    }
}