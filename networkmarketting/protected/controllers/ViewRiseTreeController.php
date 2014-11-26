<?php

class ViewRiseTreeController extends Controller {

    public function actionIndex() {

        /**
         * Manages all models.
         */
        $level = 0;

        if (isset($_POST['Users']['search'])) {
            $search = strtoupper(trim($_POST['Users']['search']));
            $model = Users::model()->find("username=?", array($search));
            $level = UtilityManager::getUserChildLevel(yii::app()->user->getId(), $search);
            if (!$level && $model->user_id != yii::app()->user->getId())
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        else {
            $model = Users::model()->findByPk(yii::app()->user->getId());
        } // clear any default values

        $this->render('index', array(
            'model' => $model,
            'level' => $level,
        ));
    }

    public function actionview($id) {

        /**
         * Manages all models.
         */
        $level = 0;

        if ($id) {
            $search = trim($id);
            $model = Users::model()->findByPk($id);
            $level = UtilityManager::getUserChildLevel(yii::app()->user->getId(), $model->username);
            if (!$level && $model->user_id != yii::app()->user->getId())
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        else {
            $model = Users::model()->findByPk(yii::app()->user->getId());
        } // clear any default values

        $this->render('index', array(
            'model' => $model,
            'level' => $level,
        ));
    }

    // Uncomment the following methods and override them if needed

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('create', 'index', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

}