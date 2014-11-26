<?php

class UsersController extends Controller {

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
                'actions' => array('create'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'profile', 'view', 'security'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'index'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionProfile() {


        $this->render('view', array(
            'model' => Users::model()->findbypk(yii::app()->user->getId()),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Users;

        if (isset($_GET['parent'])) {
            $model->parent_id = $_GET['parent'];
        }

        if (isset($_GET['position'])) {
            $model->position = $_GET['position'];

            if (trim($model->position) == "left") {

                $model->position_id = self::LEFT_ID;
            } else {
                $model->position_id = self::RIGHT_ID;
            }
        }

        if (empty($model->introducer_id) && !yii::app()->user->isGuest) {

            $user = Users::model()->findByPk(yii::app()->user->getId());
            $model->user_name = $user->username;
        }

        // Uncomment the following errorCode if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {

            $transaction = Yii::app()->db->beginTransaction();

            try {
                $model->attributes = $_POST['Users'];
                $model->stage = $model->plan_id;

                if (empty($model->introducer_id) && yii::app()->user->isGuest) {

                    // $user = Users::model()->find("username=?", array($_POST['Users']['user_name']));
                    //          $model->introducer_id = $user->user_id;
                    $model->addError('introducer_id', 'Please contact support you need to have introducer to join');

                    return $this->render('create', array(
                                'model' => $model,
                    ));
                }

                if (empty($model->introducer_id)) {
                    $model->introducer_id = yii::app()->user->getId();
                }


                if (empty($model->product_id)) {
                    $model->addError('product_id', 'Please select a product');
                    return $this->render('create', array(
                                'model' => $model,
                    ));
                }
                
                $prod_id = $_POST['ProductDetail']['product_detail_id'];
                 if (empty($prod_id)) {
                    $model->addError('product_id', 'Please select a product');
                    return $this->render('create', array(
                                'model' => $model,
                    ));
                }

                $prod_price = UtilityManager::getProductPrice($prod_id);

                // satge one is working and 2 and 3 are on hold
                 $bill = $prod_price;

                

                $uBank = new Userbank();

                $uBank->created_date = UtilityManager::getSqlCurrentDate();
                $uBank->bank_id = $model->user_id;
                /*
                  $email_verify = EmailVerification::model()->find("email=? and code=?", array($model->primary_email, $model->verified_pin));


                  if (empty($email_verify)) {
                  $model->addError('primary_email', "Email Verification failed please recheck the pin codes you enter or contact support");

                  return $this->render('create', array(
                  'model' => $model,
                  ));
                  }

                 */ if ($model->payment_type_id == self::PAYMENT_TYPE_ID_OTHER) {
                    $payee_userid = Users::getUserIdFromUserName($model->other_username);
                    if (!empty($payee_userid)) {

                        $model->other_pin;
                        $share_verify = EmailFundShare::model()->find("email=? and code=? and share_id=? and shared=?", array($model->primary_email, $model->other_pin, $payee_userid, 0));

                        if (empty($share_verify)) {
                            $model->addError('other_username', "Security check fail please recheck the pin codes you enter or contact support");

                            return $this->render('create', array(
                                        'model' => $model,
                            ));
                        }
                        $share_verify->shared = 1;


                        $uBank->user_id = $payee_userid;
                        $userBalance = UtilityManager::getUserBalance($payee_userid);
                    } else {

                        $model->addError('other_username', "Security check fail please recheck the pin codes you enter or contact support");

                        return $this->render('create', array(
                                    'model' => $model,
                        ));
                        // generate validation error to add otherusername
                    }
                } else if ($model->payment_type_id == self::PAYMENT_TYPE_ID) {
                    $uBank->user_id = $model->introducer_id;
                    $userBalance = UtilityManager::getUserBalance($model->introducer_id);
                }

                if (isset($_GET['parent'])) {
                    $model->parent_id = $_GET['parent'];
                }

                if (isset($_GET['position'])) {
                    $model->position = $_GET['position'];



                    if (trim($model->position) == "left") {

                        $model->position_id = self::LEFT_ID;
                    } else {
                        $model->position_id = self::RIGHT_ID;
                    }
                }

                if (isset($_POST['dob']))
                    $model->dob = $_POST['dob'];

                if (!$model->validate()) {
                    return $this->render('create', array(
                                'model' => $model,
                    ));
                }

                if ($bill > $userBalance) {

                    $model->addError('username', "Not enough funds available you need $bill please recharge");

                    return $this->render('create', array(
                                'model' => $model,
                    ));
                } else {
                    $uBank->points = $bill;
                    $uBank->total = $userBalance - $bill;
                }





                if (!yii::app()->user->isGuest) {
                    $model->introducer_id = yii::app()->user->getId();
                }
                $model->role_id = Role::getRoleIdForMember();
                //$model->dob = $_POST['dob'];
                $model->created_date = UtilityManager::getSqlCurrentDate();
                $model->modified_date = UtilityManager::getSqlCurrentDate();
                $model->username = UtilityManager::random_username();


                if ($model->save()) {


                    /*
                      if (!$email_verify->save()) {
                      throw new Exception("Email verification failed errorCode 217");
                      }
                     */
                    if ($model->payment_type_id == self::PAYMENT_TYPE_ID_OTHER) {
                        if (!$share_verify->save()) {
                            throw new Exception("Shared verification failed errorCode 217");
                        }
                    }
                    $uBank->transaction_type = Controller::$user_transaction_type . " " . $model->username;
                    if ($uBank->save()) {
                        
                    } else {
                        print_r($uBank);
                        throw new Exception("errorCode 216");
                    }


                    $purchase = new Purchase();
                    $purchase->product_id = $prod_id;
                    $purchase->created_date = UtilityManager::getSqlCurrentDate();
                    $purchase->points = $bill;
                    $purchase->user_id = $model->user_id;


                    if ($purchase->save()) {
                        
                    } else {
                        print_r($purchase);
                        throw new Exception("errorCode 151");
                    }


                    $parent = Account::model()->findByPk($model->parent_id);
                    
                    if (!$parent->lock && !UtilityManager::getFlushOut($parent)) {
                        if ($model->stage == $parent->stage && $parent->stage != 1) {
                           UtilityManager::isRmsUser($parent, $_GET['position']);
                        }

                       $sale = new Sale();
                            $sale->amount = $bill;
                            $sale->user_id = $parent->user_id;
                            $sale->stage = $parent->stage;
                            $sale->joining_id = $model->username;

                            if ($_GET['position'] == 'left') {
                                $sale->position = 'left';
                                $parent->left = $model->user_id;
                            } else {
                                $sale->position = 'right';
                                $parent->right = $model->user_id;
                            }
                            $sale->save();

                        if ($parent->save()) {
                            
                        } else {
                            print_r($sale);
                            print_r($parent);
                            throw new Exception("errorCode 151");
                        }
                    }
                    $mparent = $parent->parent;
                    $mchild = $parent;
                    while ($mparent) {

                        //  echo "<br>child ".$mchild->username." mparent " . $mparent->username." parent ". $parent->username." <br/>";

                        if (!$mparent->lock && !UtilityManager::getFlushOut($mparent)) {
                            $sale = new Sale();
                            $sale->amount = $bill;
                            $sale->user_id = $mparent->user_id;
                            $sale->stage = $mparent->stage;
                            $sale->joining_id = $model->username;

                            if ($mparent->left == $mchild->user_id) {
                                // Position left
                                $sale->position = 'left';
                            } elseif ($mparent->right == $mchild->user_id) {
                                // Position right
                                $sale->position = 'right';
                            }

                            if ($sale->save()) {


                                // check if any commmission due
                            } else {
                                // print_r($sale);
                                //print_r($mchild);
                                throw new Exception($mchild->username . " errorCode 187 " . $mparent->username . " parent " . $parent->username);
                            }
                        }

                        $mchild = $mparent;
                        $mparent = $mparent->parent;
                    }
                }
                $text = $this->renderInternal('protected/views/mail/notifications/welcome_'.$model->stage.'.php', array('full_name' => $_POST['Users']['full_name'], "email" => $_POST['Users']['primary_email'], "introducer" => $model->user_name, "address" => $model->address, "user_name" => $model->username, "tele" => $model->mobile, "country" => Country::getCountryNameById($model->country_id)), true);
                UtilityManager::sendEmail($model->primary_email, $model->full_name, 'Welcome to Rise4People', $text);


                //$email_verify->delete();
                //throw new Exception("By dino errorCode 206");
                $transaction->commit();
                //throw new Exception("broke by dino");
            } catch (Exception $e) { //an exception is raised if a query fails
                //something was really wrong - exception!
                if ($transaction->active) {
                    $transaction->rollBack();
                }

                print($e->getMessage());
                exit;
                //you should do sth with this exception (at least log it or show on page)
                Yii::log('Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
            }
            $this->redirect(array('/viewRiseTree', 'view' => $model->user_id));
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
            return $this->render('application.views.userbank.verify', array(
                        'model' => $model,
            ));
        }

        if (Yii::app()->user->checkAccess(Controller::$admin, array("userId" => Yii::app()->user->getId()))) {
            $model = $this->loadModel($id);
        } else {

            $model = $this->loadModel(Yii::app()->user->getId());
        }

        // Uncomment the following errorCode if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Account'])) {
            $model->attributes = $_POST['Account'];

            if ($model->update()) {
                
            }

            $this->redirect(array('profile'));
        }

        $this->render('_changepass', array(
            'model' => $model,
        ));
    }

    public function actionSecurity() {

        $id = Yii::app()->user->getId();
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
            return $this->render('application.views.userbank.verify', array(
                        'model' => $model,
            ));
        }

        if (Yii::app()->user->checkAccess(Controller::$admin, array("userId" => Yii::app()->user->getId()))) {
            $model = $this->loadModel($id);
        } else {

            $model = $this->loadModel(Yii::app()->user->getId());
        }

        // Uncomment the following errorCode if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Account'])) {
            $model->attributes = $_POST['Account'];

            if ($model->update()) {
                
            }

            $this->redirect(array('profile'));
        }

        $this->render('_changepass', array(
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Users');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

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
        $model = Account::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
