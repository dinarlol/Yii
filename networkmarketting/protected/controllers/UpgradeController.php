<?php

class UpgradeController extends CController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    
    public $menu = array();
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
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
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
        $model = new Account;
        $model->full_name = Users::getFullName(Yii::app()->user->getId());

        // Uncomment the following line if AJAX validation is needed

        if (isset($_POST['Account'])) {

            $transaction = Yii::app()->db->beginTransaction();
            try {

                $model = Account::model()->findByPk(Yii::app()->user->getId());
                $model->attributes = $_POST['Account'];

                $email_verify = EmailVerification::model()->find("email=? and code=?", array($model->primary_email, $model->verified_pin));


                if (empty($email_verify)) {
                    $model->addError('primary_email', "Email Verification failed please recheck the pin codes you enter or contact support");
                    return $this->render('create', array(
                                'model' => $model,
                    ));
                }
				
				

                //$this->performAjaxValidation($model);

                $userBalance = UtilityManager::getUserBalance($model->user_id);


                if (UtilityManager::LEVEL_UPGRADE > $userBalance) {

                    $model->addError('primary_email', "Not enough funds available you need " . UtilityManager::LEVEL_UPGRADE . " please recharge");

                    return $this->render('create', array(
                                'model' => $model,
                    ));
                }

                $uBank = new Userbank();
                $uBank->created_date = UtilityManager::getSqlCurrentDate();
                $uBank->bank_id = $model->user_id;
                $uBank->user_id = $model->user_id;
                $uBank->points = UtilityManager::LEVEL_UPGRADE;
                $uBank->total = $userBalance - UtilityManager::LEVEL_UPGRADE;

                if (!$uBank->save()) {
                    throw new Exception($model->username . " errorCode amount " . $uBank->points . " total " . $uBank->total);
                }
                
                $remarks = '';
                if($model->stage == 1){
                 $purchase = Purchase::model()->find("user_id=?", array($model->user_id));
                if(!empty($purchase->product_id)){
                    if($purchase->product_id == 1){
                        $remarks = "Qualified for Braclet";
                    }
                }
                }
                $model->stage = $model->stage + 1;
                $model->lock = 0;


                if (!$model->save()) {
                    throw new Exception($model->username . " errorCode 112 upgrade ");
                }
                $upgrade = new Upgrade();
                $upgrade->remark = $remarks;
                $upgrade->user_id = $model->user_id;
                $upgrade->stage = $model->stage;
                $upgrade->point = UtilityManager::LEVEL_UPGRADE;
                $upgrade->created_date = UtilityManager::getSqlCurrentDate();

                if (!$upgrade->save()) {
                    print_r($upgrade);
                    throw new Exception($model->username . " errorCode 125 upgrade ");
                }

                
				$email_verify->delete();
				
				$transaction->commit();

                $this->redirect(array('/viewRiseTree'));
            } catch (Exception $e) { //an exception is raised if a query fails
                //something was really wrong - exception!
                
                print_r($e);
                
                if ($transaction->active) {
                    $transaction->rollBack();
                }
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

        if (isset($_POST['Upgrade'])) {
            $model->attributes = $_POST['Upgrade'];
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
        $dataProvider = new CActiveDataProvider('Upgrade');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Upgrade('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Upgrade']))
            $model->attributes = $_GET['Upgrade'];

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
        $model = Upgrade::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'upgrade-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
