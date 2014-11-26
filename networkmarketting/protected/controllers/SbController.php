<?php

class SbController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $authorzied = Yii::app()->user->getState("authorziedConfirm", false);


        if (isset($_POST['Users'])) {
            $user = Users::model()->findbypk(yii::app()->user->getId());

            if ($user->security_quest_id == $_POST['Users']['security_quest_id'] && $user->answer == $_POST['Users']['answer'] && $user->pincode == $_POST['Users']['pincode']) {
                $model = new Sb('search');
                if (!$authorzied) {
                    Yii::app()->user->setState("authorziedConfirm", true);
                    $authorzied = TRUE;
                }
                $model->unsetAttributes();  // clear any default values

                $model->user_id = yii::app()->user->getId();
                if (isset($_GET['Users']))
                    $model->attributes = $_GET['Users'];
            }
        }



        if (!$authorzied) {
            $model = new Users();
            return $this->render('verify', array(
                        'model' => $model,
            ));
        }



        $model = new Sb('search');
        $model->unsetAttributes();  // clear any default values


        if (isset($_GET['Sb']))
            $model->attributes = $_GET['Sb'];


        $model->user_id = yii::app()->user->getId();

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Sb::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sb-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
