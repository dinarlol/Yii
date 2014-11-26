<?php

class RedemptionController extends Controller {

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'update'),
                'users' => array('admin'),
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $authorzied = Yii::app()->user->getState("authorziedConfirm", false);


        if (isset($_POST['Users'])) {
            $user = Users::model()->findbypk(yii::app()->user->getId());

            if ($user->security_quest_id == $_POST['Users']['security_quest_id'] && $user->answer == $_POST['Users']['answer'] && $user->pincode == $_POST['Users']['pincode']) {
                if (!$authorzied) {
                    Yii::app()->user->setState("authorziedConfirm", true);
                    $authorzied = TRUE;
                }
            }
        }

        if (!$authorzied) {

            $model = new Users();
            return $this->render('application.views.commission.verify', array(
                        'model' => $model,
            ));
        }



        $model = new Redemption;
        $model->user_id = yii::app()->user->getId();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $transaction = Yii::app()->db->beginTransaction();
        if (isset($_POST['Redemption'])) {
            $model->attributes = $_POST['Redemption'];
            $reswards = UtilityManager::getUserRewardsByUserId($model->user_id);
            if ($reswards['commission'] - $model->points >= 0) {

                try {



                    $model->created_date = UtilityManager::getSqlCurrentDate();
                    $model->modified_date = UtilityManager::getSqlCurrentDate();
                    $model->user_id = yii::app()->user->getId();

                    $ubalance = UtilityManager::getUserBalance(yii::app()->user->getId());

                    $sBank = new Userbank();
                    $sBank->total = $ubalance + $model->points;
                    $sBank->points = $model->points;
                    $sBank->transaction_type = Controller::$redemtion_transaction_type;
                    $sBank->created_date = UtilityManager::getSqlCurrentDate();

                    $sBank->user_id = yii::app()->user->getId();

                    $model->save();
                    $sBank->bank_id = $model->id;

                    if ($sBank->save()) {
                        $transaction->commit();
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                } catch (Exception $e) { // an exception is raised if a query fails
                    //something was really wrong - exception!
                    if ($transaction->active) {
                        $transaction->rollBack();
                    }

                    print($e->getMessage());
                    exit;
                    //you should do sth with this exception (at least log it or show on page)
                    Yii::log('Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
                }
            } else {
                $model->addError("points", " Not Enough Funds available");
                $this->render('create', array(
                    'model' => $model,
                ));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
	
	
        $model = $this->loadModel($id);
	
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Redemption'])) {
            $model->attributes = $_POST['Redemption'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Redemption');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Redemption('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Redemption']))
            $model->attributes = $_GET['Redemption'];

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
	
        $auth=Yii::app()->authManager;

        if($auth->isAssigned("admin",Yii::app()->user->id)){
			$model = Redemption::model()->findByPk($id);
       	
	}
	else{
        $model = Redemption::model()->find("id=? AND user_id=?", array($id, Yii::app()->user->getId()));
        }
		if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'redemption-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
