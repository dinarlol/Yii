<?php

class ReportsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
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
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('upgrades','delete','users','rewards','purchases','test'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

public function actionTest(){

        $users = Users::model()->findAll();
        $list = array();
        $list[] = array("Username", "full_name", "introducer", "balance", "stage");
        foreach ($users as $user) {
            $scriteria = new CDbCriteria(array(
                'condition' => "user_id=" . $user->user_id,
                'order' => 'userbank_id DESC',
                'limit' => 1, 
            ));
       $ubalance = Userbank::model()->find($scriteria);
            $balance = 0;
            if(!empty($ubalance->total)){
                $balance = $ubalance->total;
            }
            $list[] = array($user->username, $user->full_name, $user->introducer->full_name, $balance, $user->stage);
        }

        $fp = fopen('php://output', 'w');

        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="users_balance.csv"');
        
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);


exit;
$com = new Commission();
        $com->user_id = 1449;
        $commission = $com->getComissionTotal();
$commission = $commission * UtilityManager::$pkr;
//$commission = $this->widget('ext.NumtoWord.NumtoWord', array('num'=>$commission));;
$commission_txt = UtilityManager::int_to_words(14000);
//echo $commission_txt;

 $this->render('test',array(
            'model'=>$com,
'amount' => $commission,
'amount_txt' => $commission_txt
        ));
}

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Upgrade;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Upgrade']))
        {
            $model->attributes=$_POST['Upgrade'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

 $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Upgrade']))
        {
            $model->attributes=$_POST['Upgrade'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

  

    /**
     * Manages all models.
     */
    public function actionUpgrades()
    {
        $model=new Upgrade('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Upgrade']))
            $model->attributes=$_GET['Upgrade'];

        $this->render('upgrade',array(
            'model'=>$model,
        ));
    }
    
    
    
    /**
     * Users.
     */
    public function actionUsers()
    {
        $model=new Users('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Users']))
            $model->attributes=$_GET['Users'];
 $this->render('user',array(
            'model'=>$model,
        ));
    }

    
    /**
     * Users.
     */


    public function actionPurchases()
    {

        $model=new Purchase('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Purchase']))
            $model->attributes=$_GET['Purchase'];

        $this->render('purchase',array(
            'model'=>$model,
        ));
    }

    
        
    /**
     * Rewards.
     */
    public function actionRewards()
    {
        $model=new Commission('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Commission']))
            $model->attributes=$_GET['Commission'];
 $this->render('reward',array(
            'model'=>$model,
        ));
    }

    
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Upgrade the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Upgrade::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Upgrade $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='upgrade-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}