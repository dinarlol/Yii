<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
    
    public function init(){
        
        
        if(Yii::app()->user->getId() == 'admin'){
       
            Yii::app()->user->setReturnUrl(array('users/admin'));
        }
        else{

            Yii::app()->user->setReturnUrl(array('users/'));
    }
    }

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public static function getSqlCurrentDate() {
        return date('Y-m-d H:i:s');
    }
    
    public static function getSqlYesterdayDate() {
        $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . " -1 day"));
    }
    
    

}
