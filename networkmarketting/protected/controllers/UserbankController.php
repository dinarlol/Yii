<?php

class UserbankController extends Controller {

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
                'actions' => array( 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
			
			            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'update','resetBank', 'resetreward'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    public function actionResetBank() {
exit;	
	
			$criteria = new CDbCriteria(array(
                    'condition' => "user_id=78"  ,
                    'order' => 'id DESC',
                    'limit' => 1, // 
    

	));
	$sale = Sale::model()->findByPk(6671);

$paid_count = UtilityManager::getUserPaidCommission($sale->user_id, $sale->stage);
            $rightsale = $sale->getSaleForStage($sale->stage, 'right');
            $leftsale = $sale->getSaleForStage($sale->stage, 'left');
			$sblimit = $paid_count;

            // total sale eligible for commission ex: 6000 / 3000   = 3000
            $salecount = min($rightsale, $leftsale);
			
			
if ($salecount > UtilityManager::LEVEL_TWO_COMMISSION_BASED) {

                $commissionsmade = floor($salecount / UtilityManager::LEVEL_TWO_COMMISSION_BASED);

				echo "<br>$commissionsmade is  $paid_count made for $salecount $rightsale, $leftsale <br>".UtilityManager::LEVEL_TWO_COMMISSION_BASED;
				}
				
				if ($commissionsmade > $paid_count) {
				echo "<br>$commissionsmade is greater $paid_count <br>";
				
				}
			
			if ($sblimit % 5) {
			
			echo "<br>$sblimit is sblimit yes <br>";
				
			}
			else{
			echo "<br>$sblimit is sblimit no <br>";
			}
			
	
	exit;
	$users = Users::model()->findAll();
          echo '<table> <tr><th>Username</th><th>Commission</th><th>Redemption</th><th>Balance</th></tr>';  
            foreach($users as $user){
    
	$reswards = UtilityManager::getUserRewardsByUserId($user->user_id);
	
			$total = $reswards['commission'] - $reswards['redemption'];
	
            if ($total < 0) {
			
			
			$criteria = new CDbCriteria(array(
                    'condition' => "user_id=" . $user->user_id ,
                    'order' => 'userbank_id DESC',
                    'limit' => 1, // if offset less, thah 0 - it starts from the beginning
    

	));
	$ubtotal = Userbank::model()->find($criteria);
/*
if(!empty($ubtotal)){
	
				$uBank = new Userbank();
                $uBank->total = 0;
                $uBank->points = $ubtotal->total;
                $uBank->transaction_type = " *** Balance Revoked by admin ***";
                $uBank->created_date = UtilityManager::getSqlCurrentDate();
                $uBank->bank_id = 1;
                $uBank->user_id = $user->user_id;
	
	$uBank->save();
			}
	*/		
			
			echo "<tr>";
			echo "<td>".$user->username." </td>";
			if(empty($reswards['commission'])){
			  $model = Redemption::model()->find("user_id=?",array($user->user_id));
			echo "<td>".$model->id." points ".$model->points." </td>";
			//$model->delete();
			
			}
			else{
			
			if(!empty($ubtotal)){
			echo "<td>".$reswards['commission']."  in Bank".$ubtotal->total."</td>";
			}
			else
			echo "<td>".$reswards['commission']." </td>";
			}
			echo "<td>".$reswards['redemption']."</td>";
			echo "<td>$total </td>";
echo "</tr>";
			}
	}
	echo "</table>";
	
	
	$users = Users::model()->findAll();
            
            foreach($users as $user){
                
                
                if($user->stage == 1){
                
                if(!empty($user->left) || !empty($user->right)){
                
                    // deduct 5 points
            $total = 5;
            $model = new Redemption;
            $model->user_id = $user->user_id;
            $model->created_date = UtilityManager::getSqlCurrentDate();
            $model->modified_date = UtilityManager::getSqlCurrentDate();
            $model->points = $total;
            $model->status = " 5 point revoked by admin for first commission ";

            $model->save();
                    
                }
                }
                elseif($user->stage == 2){
                    
            $total = 15;
            $model = new Redemption;
            $model->user_id = $user->user_id;
            $model->created_date = UtilityManager::getSqlCurrentDate();
            $model->modified_date = UtilityManager::getSqlCurrentDate();
            $model->points = $total;
            $model->status = " 15 point revoked by admin for first commission ";

            $model->save();
                    
                    
                }
                    
                
                
            }
			exit;
	
	$ub = new Userbank();
	
	
	if (isset($_POST['Userbank'])) {
	
	$user = Users::model()->find("username=?", array(strtoupper($_POST['Userbank']['user_name'])));
	
	$criteria = new CDbCriteria(array(
                    'condition' => "user_id=" . $user->user_id ,
                    'order' => 'userbank_id DESC',
                    'limit' => 1, // if offset less, thah 0 - it starts from the beginning
    

	));
	$ubtotal = Userbank::model()->find($criteria);

if(!empty($ubtotal)){
	
				$uBank = new Userbank();
                $uBank->total = 0;
                $uBank->points = $ubtotal->total;
                $uBank->transaction_type = " *** Balance Revoked by admin ***";
                $uBank->created_date = UtilityManager::getSqlCurrentDate();
                $uBank->bank_id = 1;
                $uBank->user_id = $user->user_id;
	
	$uBank->save();
			}
			}
	
	
        $this->render('reset', array(
            'model' => $ub,
			'name' => "UserBank",
        ));
    }
	
	    public function actionResetreward() {
    
	$ub = new Userbank();
	
	if(isset($_POST['Userbank'])){
    $user = Users::model()->find("username=?", array(strtoupper($_POST['Userbank']['user_name'])));
	$rewards = UtilityManager::getUserRewardsByUserId($user->user_id);
	$total = $rewards['commission'] - $rewards['redemption'];
	
	$model = new Redemption;
        $model->user_id = $user->user_id;	
				$model->created_date = UtilityManager::getSqlCurrentDate();
                $model->modified_date = UtilityManager::getSqlCurrentDate();
                $model->points = $total;

$model->save();

	}
	
	
		$this->render('reset', array(
            'model' => $ub,
			'name' => "Commission Bank",
        ));
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
        $model = new Userbank;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Userbank'])) {
            $model->attributes = $_POST['Userbank'];

            $user = Users::model()->find("username=?", array($_POST['Userbank']['user_name']));
            $model->user_id = $user->user_id;


            if ($model->save())
                $this->redirect(array('view', 'id' => $model->userbank_id));
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
        //$this->performAjaxValidation($model);

        if (isset($_POST['Userbank'])) {
            $model->attributes = $_POST['Userbank'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->userbank_id));
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
        $dataProvider = new CActiveDataProvider('Userbank');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

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

        $nmodel = new Userbank('search');

        $nmodel->user_id = yii::app()->user->getId();
        if (isset($_GET['Userbank']))
            $nmodel->attributes = $_GET['Userbank'];
        return $this->render('admin', array(
                    'model' => $nmodel,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Userbank::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'userbank-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
