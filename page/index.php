<?php
/**
 * Created by Vadym Radvansky
 * Date: 2/18/14 7:23 PM
 */
namespace rvadym\blog;
class page_index extends \Page_AddonIndex {
    function init() {
        parent::init();
        $this->api->title = 'Blog addon - ' . $this->api->title;
        $this->api->layout->template->set('page_title','Blog addon');


        $this->api->getInitiatedAddons('rvadym_blog')->addMenu($this);
    }
}