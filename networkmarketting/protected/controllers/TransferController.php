<?php

class TransferController extends Controller {

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
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
	
	$authorzied = Yii::app()->user->getState("authorziedConfirm", false);


        if (isset($_POST['Users'])) {
            $user = Users::model()->findbypk(yii::app()->user->getId());

            if ($user->security_quest_id == $_POST['Users']['security_quest_id'] && $user->answer == $_POST['Users']['answer'] && $user->pincode == $_POST['Users']['pincode']) {
                $model = new Users('search');
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
		
		$model = new Transfer;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Transfer'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $model->attributes = $_POST['Transfer'];
            $model->transfer_user_id = yii::app()->user->getId();
             $scriteria = new CDbCriteria(array(
                    'condition' => "user_id=" . $model->transfer_user_id ,
                    'order' => 'userbank_id DESC',
                    'limit' => 1, // if offset less, thah 0 - it starts from the beginning
                ));
                $sbtotal = Userbank::model()->find($scriteria);
                
                if (!empty($sbtotal) && isset($sbtotal->total) && $sbtotal->total >= $_POST['Transfer']['points']) {
            try {

                $user = Users::model()->find("username=?", array(strtoupper($_POST['Transfer']['user_name'])));
                if(empty($user)){
				
				return false;
				}
				
				$suser = Users::model()->findByPk(Yii::app()->user->getId());
                
                
                $model->reciever_user_id = $user->user_id;
               
                $model->reference = "Points transfered from ".$suser->username." to ".$user->username;


              

                $criteria = new CDbCriteria(array(
                    'condition' => "user_id=" . $user->user_id ,
                    'order' => 'userbank_id DESC',
                    'limit' => 1, // if offset less, thah 0 - it starts from the beginning
                ));

                $model->save();
                
             
           
                
// receiver code 
                
                $uBank = new Userbank();
                $uBank->total = $model->points;
                $uBank->points = $model->points;
                $uBank->transaction_type = Controller::$user_transaction_type." balance shared from ".$suser->username;
                $uBank->created_date = UtilityManager::getSqlCurrentDate();
                $uBank->bank_id = $model->id;
                $uBank->user_id = $model->reciever_user_id;

                $ubtotal = Userbank::model()->find($criteria);

                
                if (!empty($ubtotal)) {
                    if (!empty($ubtotal->total)) {
                        $uBank->total = $ubtotal->total + $model->points;
                    }
                }
                $uBank->save();
                
                
                
       // sender code         
                $sBank = new Userbank();
                $sBank->total = $model->points;
                $sBank->points = $model->points;
                $sBank->transaction_type = Controller::$user_transaction_type." balance shared to ".$user->username;;
                $sBank->created_date = UtilityManager::getSqlCurrentDate();
                $sBank->bank_id = $model->id;
                $sBank->user_id = $model->transfer_user_id;

                 $scriteria = new CDbCriteria(array(
                    'condition' => "user_id=" . $model->transfer_user_id ,
                    'order' => 'userbank_id DESC',
                    'limit' => 1, // if offset less, thah 0 - it starts from the beginning
                ));
                $sbtotal = Userbank::model()->find($scriteria);
                
                if (!empty($sbtotal)) {
                    if (!empty($sbtotal->total)) {
                        $sBank->total = $sbtotal->total - $model->points;
                    }
                }
               
                 if ($sBank->save()){
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

        if (isset($_POST['Transfer'])) {
            $model->attributes = $_POST['Transfer'];
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
        $dataProvider = new CActiveDataProvider('Transfer');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Transfer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Transfer']))
            $model->attributes = $_GET['Transfer'];

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
        $model = Transfer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'transfer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
