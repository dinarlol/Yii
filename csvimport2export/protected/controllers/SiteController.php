<?php

class SiteController extends Controller {

    public $layout = 'column1';
    public $defaultAction = 'login';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    protected function beforeAction($action) {

        if (!Yii::app()->user->isGuest && $action->getId() !== 'logout') {
            //  echo $this->action->getId(); exit;
            $this->redirect(Yii::app()->user->returnUrl);
        }
        return parent::beforeAction($action);
    }

    public function actionForgotPassword() {
        $model = new PasswordForm;

        if (isset($_POST['PasswordForm'])) {
            
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
            
            $model->attributes = $_POST['PasswordForm'];

            $text = '<h1> The user request for password: </h1>'
                    . '<h4> Entered following data: </h4>'
                    . 'user_id: '.$model->user_id
                    . '<br>name: '.$model->name
                    . '<br>email: '.$model->email
                    . '<br>state: '.$model->state
                    . '<br>tel: '.$model->tel
                    . '<br>cell: '.$model->cell
                    . '<br>tax id: '.$model->tax_id;

            if (!empty($model->attributes)) {
                    Yii::log("entered data " . $text . " requested password using ip " . Yii::app()->request->getUserHostAddress(), "info");
                    $subject = 'Password Requested';
                    $message = $text;
                    $to = Yii::app()->params['toEmail'];
                     $headers = "From: \"trustee@covenantclearinghouse.com\" <trustee@covenantclearinghouse.com>\n"; 
                     $headers .= "To: \"".$to."\" <".$to.">\n";
			$headers .= "Return-Path: <trustee@covenantclearinghouse.com>\n"; 
			$headers .= "Content-Type: text/HTML; charset=ISO-8859-1\n";
            

                    mail($to, $subject, $message, $headers);
                    Yii::app()->user->setFlash('success', "Password request sent ");
                    $this->redirect(Yii::app()->user->returnUrl);
                
            } else {
                Yii::log(" No information entered requested password using ip " . Yii::app()->request->getUserHostAddress(), "info");
                $model->addError('user_id', ' User id is not in our record');
            }
        }

        $this->render('forgotPass', array('model' => $model));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionIndex() {

        $usertype = Yii::app()->user->isGuest ? ' Guest user ' : Yii::app()->user->getId();
        Yii::log("user id " . $usertype . " on home page using ip " . Yii::app()->request->getUserHostAddress(), "info");
        $this->render('index');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $usertype = Yii::app()->user->isGuest ? ' Guest user ' : Yii::app()->user->getId();
        /*
          if (!defined('CRYPT_BLOWFISH') || !CRYPT_BLOWFISH)
          throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");
         */
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (Yii::app()->user->getId() == 'admin') {
                    Yii::app()->user->setReturnUrl(array('users/admin'));
                }
                Yii::log("user " . $model->username . " login success from ip " . Yii::app()->request->getUserHostAddress(), "info");
                $this->redirect(Yii::app()->user->returnUrl);
            } else {
                Yii::log("user " . $model->username . " login failure from ip " . Yii::app()->request->getUserHostAddress(), "info");
            }
        } else {
            Yii::log("user id " . $usertype . " on Login page using ip " . Yii::app()->request->getUserHostAddress(), "info");
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::log("user id " . Yii::app()->user->getId() . " logout using ip " . Yii::app()->request->getUserHostAddress(), "info");
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
