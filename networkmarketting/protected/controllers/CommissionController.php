<?php

class CommissionController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
         
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }


    /**
     * Lists all models.
     */
    public function actionIndex() {


        $model = Commission::model()->findAll("user_id=? AND created_date >=?", array(yii::app()->user->getId(), UtilityManager::getSqlYesterdayDate()));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    private function showRewards() {


        $model = new Commission('search');
        $model->unsetAttributes();
        $model->user_id = yii::app()->user->getId();
        if (isset($_GET['Commission']))
            $model->attributes = $_GET['Commission'];


        $rmodel = new Redemption('search');
        $rmodel->unsetAttributes();  // clear any default values
        $rmodel->user_id = yii::app()->user->getId();
        if (isset($_GET['Redemption']))
            $rmodel->attributes = $_GET['Redemption'];


        $this->render('admin', array(
            'model' => $model,
            'rmodel' => $rmodel,
        ));
    }

    public function actionAdmin() {

        $authorzied = Yii::app()->user->getState("authorziedConfirm", false);


        if ($authorzied) {

            return $this->showRewards();
        }


        if (isset($_POST['Users'])) {
            $user = Users::model()->findbypk(yii::app()->user->getId());

            if ($user->security_quest_id == $_POST['Users']['security_quest_id'] && $user->answer == $_POST['Users']['answer'] && $user->pincode == $_POST['Users']['pincode']) {
                if (!$authorzied)
                    Yii::app()->user->setState("authorziedConfirm", true);

                return $this->showRewards();
            }


            else {
                $model = new Users();
                $this->render('verify', array(
                    'model' => $model,
                ));
            }
        } else {
            $model = new Users();
            $this->render('verify', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Commission the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Commission::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Commission $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'commission-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
