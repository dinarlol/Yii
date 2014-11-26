<?php

class UsersController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'column1';

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
                'actions' => array('index', 'view', 'sendmail'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('importUser', 'exportUser', 'importInstrument', 'admin', 'clearTable2', 'clearTable4'),
                'users' => array('admin'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update','changePassword'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAdmin() {
        Yii::log("user id " . Yii::app()->user->getId() . " on an admin page using ip " . Yii::app()->request->getUserHostAddress(), "info");

        $this->render('admin');
    }

    public function actionSendmail() {

        Yii::log("user id " . Yii::app()->user->getId() . " on send mail page using ip " . Yii::app()->request->getUserHostAddress() . " regarding file # " . $_POST['line'], "info");
        $user = Users::model()->find('user_id=?', array(yii::app()->user->getId()));
        $data = array(
            'line' => $_POST['line'],
            'to' => Yii::app()->params['adminEmail'],
            'from' => $user->email
        );
        $this->renderPartial('email', array(
            'data' => $data,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::log("user id " . Yii::app()->user->getId() . " on a view profile page using ip " . Yii::app()->request->getUserHostAddress(), "info");
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Users;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->password = $model->hashPassword($model->password);

            try {
                $model->save();
            } catch (Exception $exc) {
                try {
                    $model->save();
                } catch (Exception $exc) {
                    Yii::app()->user->setFlash('profileUpdated', 'Sorry Server busy try it again.');
                }
            }

            $this->redirect(array('view', 'id' => $model->user_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionChangePassword() {
        $model = $this->loadModel(yii::app()->user->getId());
        $model->password = '';
        print_r($model);exit;
        $model->setscenario('edit');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {

                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if ($model->validate()) {
                $model->password = $model->new_password;
                if ($model->update()) {
                    
                    
                    Yii::log("user id " . Yii::app()->user->getId() . " update profile password using ip " . Yii::app()->request->getUserHostAddress() . ' new password ' . $model->password, "info");

                    Yii::app()->user->setFlash('profileUpdated', 'Password changed.');
                    $this->redirect(array('index'));
                }
            }
        } else {
            Yii::log("user id " . Yii::app()->user->getId() . " on change password page using ip " . Yii::app()->request->getUserHostAddress(), "info");
        }
        $this->render('updatepassword', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $model = $this->loadModel(yii::app()->user->getId());
        //$model->password = '';
        // $model->setscenario('edit'); 
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model2 = $this->loadModelEdit(yii::app()->user->getId());
            if (empty($model2)) {
                $model2 = new UserEdit();
            }
            $datachanged = '';
            $model->attributes = $_POST['Users'];


            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {

                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if ($model->validate()) {

                foreach ($model as $s_key => $m_val) {
                    $model2->$s_key = $m_val;
                    $datachanged.= $s_key . " " . $m_val;
                }
                $model2->date_modified = $this->getSqlCurrentDate();

                if ($model2->save()) {
                    Yii::log("user id " . Yii::app()->user->getId() . " update profile page using ip " . Yii::app()->request->getUserHostAddress() . ' new data ' . $datachanged, "info");

                    Yii::app()->user->setFlash('profileUpdated', 'Contact updated.');
                    $this->redirect(array('index'));
                }
            } else {
                Yii::log("user id " . Yii::app()->user->getId() . " on edit profile page using ip " . Yii::app()->request->getUserHostAddress(), "info");
            }
        }


        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        if (isset($_POST['message'])) {

            Yii::log("user id " . Yii::app()->user->getId() . " sent mail by using ip " . Yii::app()->request->getUserHostAddress() . 'File number: ' . $_POST['line'] . ' message: ' . $_POST['message'], "info");

            /*
             * Send mail to admin
             */

            $to = Yii::app()->params['toEmail'];
            $subject = $_POST['line'];
            $message = 'Message: ' . $_POST['message'];

            $headers = "From: \"" . $_POST['from'] . "\" <" . $_POST['from'] . ">\n";
            $headers .= "To: \"trustee@covenantclearinghouse.com\" <trustee@covenantclearinghouse.com>\n";
            $headers .= "Return-Path: <" . $_POST['from'] . ">\n";
            $headers .= "Content-Type: text/HTML; charset=ISO-8859-1\n";


            mail($to, $subject, $message, $headers);
            Yii::app()->user->setFlash('success', "Request sent " . $subject);
        }

        $dataProvider = new Users('search');
        $activeInstruments = ActiveInstrument::model()->findAll('userid=?', array(yii::app()->user->getId()));
        $dataProvider->user_id = yii::app()->user->getId();
        Yii::log("user id " . Yii::app()->user->getId() . " on main profile page using ip " . Yii::app()->request->getUserHostAddress(), "info");
        $this->render('index', array(
            'dataProvider' => $dataProvider->search(),
            'activeInstruments' => $activeInstruments,
        ));
    }

    public function actionImportUser() {
        $rec = 0;
        $cols = array();
        if (($handle = fopen(Yii::getPathOfAlias('webroot') . '/input/Table1.csv', 'r')) !== false) {
            // Get the first row (Header)
            $header = fgetcsv($handle);
            foreach ($header as $string) {
                $array = explode('_', $string);
                $string = preg_replace("/[^A-Za-z]/", '', $array[1]);
                $cols[] = strtolower($string);
            }

            // loop through the file line-by-line
            while (($data = fgetcsv($handle)) !== false) {
                $rec +=1;
                $rawuser = new Users();
                foreach ($data as $key => $val) {
                    if ($cols[$key] == 'userid') {
                        $rawuser->user_id = $val;
                    } else if ($cols[$key] == 'streetaddress') {
                        $rawuser->street = $val;
                    } else if ($cols[$key] == 'ein') {
                        $rawuser->tax_id = $val;
                    } else
                        $rawuser->$cols[$key] = $val;
                }

                $rawuser->date_modified = $this->getSqlCurrentDate();
                $user = Users::model()->find('user_id=?', array($rawuser->user_id));
                if (empty($user)) {
                    $rawuser->save();
                } else {
                    $user->attributes = $rawuser->attributes;

                    $user->save();
                }

                // Process Your Data
                unset($data);
            }
            fclose($handle);
        }

        echo " <h3> $rec users imported </h3>";
        Yii::log("user id " . Yii::app()->user->getId() . " $rec users imported  using ip " . Yii::app()->request->getUserHostAddress(), "info");
    }

    public function actionExportUser() {
        $users = UserEdit::model()->findAll();
        $rec = 0;
        if (!empty($users)) {
            $fp = fopen(Yii::getPathOfAlias('webroot') . '/output/Table2.csv', 'w');
            $headers = (array) $users[0]->attributes;
            $header = array();
            foreach ($headers as $k => $v) {
                $header[] = $k;
            }
            fputcsv($fp, $header);
            foreach ($users as $user) {
                $rec = +1;
                $fields = (array) $user->attributes;
                fputcsv($fp, $fields);
            }
            fclose($fp);
            echo " <h3> $rec users edited data exported </h3>";
            Yii::log("user id " . Yii::app()->user->getId() . " $rec users exported  using ip " . Yii::app()->request->getUserHostAddress(), "info");
        } else {

            echo 'No Data Available to export';
        }
    }

    public function actionClearTable2() {
        Yii::app()->db->createCommand()->truncateTable('user_edit');
        echo " <h3> Table 2 data has been deleted from local storage </h3>";
        Yii::log("user id " . Yii::app()->user->getId() . " Users Contact edit data deleted using ip " . Yii::app()->request->getUserHostAddress(), "info");
    }

    public function actionClearTable4() {
        Yii::app()->db->createCommand()->truncateTable('active_instrument');
        echo " <h3> Table 4 data has been deleted from local storage </h3>";
        Yii::log("user id " . Yii::app()->user->getId() . " Users Instrument data deleted using ip " . Yii::app()->request->getUserHostAddress(), "info");
    }

    public function actionImportInstrument() {
        $cols = array();
        $rec = 0;
        if (($handle = fopen(Yii::getPathOfAlias('webroot') . '/instruments/Table4.csv', 'r')) !== false) {
            // Get the first row (Header)
            $header = fgetcsv($handle);
            foreach ($header as $string) {
                $array = explode('_', $string);
                $string = preg_replace("/[^A-Za-z]/", '', $array[1]);
                $cols[] = strtolower($string);
            }

            // loop through the file line-by-line
            while (($data = fgetcsv($handle)) !== false) {

                $rawuser = new ActiveInstrument();
                $rec++;


                foreach ($data as $key => $val) {
                    if ($key <= 6) {
                        if ($cols[$key] == 'filenumber') {
                            $rawuser->file = $val;
                        } else if ($cols[$key] == 'oprreference') {
                            $rawuser->opr = $val;
                        } else if ($cols[$key] == 'daterecorded') {
                            $rawuser->dt_rec = $val;
                        } else
                            $rawuser->$cols[$key] = $val;
                    }
                    else if ($key % 2) {
                        //odd
                        if (!empty($val)) {
                            $user = new ActiveInstrument();
                            $user->attributes = $rawuser->attributes;
                            $user->userid = $val;
                        }
                    } else {
                        //even
                        if (!empty($val)) {
                            $user->percent = number_format($val, 2);
                            $user->save();
                        }
                    }
                }


                // Process Your Data
                unset($data);
            }
            fclose($handle);
            echo " <h3> $rec Instrument lines imported </h3>";
            Yii::log("user id " . Yii::app()->user->getId() . " $rec Instrument lines imported  using ip " . Yii::app()->request->getUserHostAddress(), "info");
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModelEdit($id) {
        $model = UserEdit::model()->findByPk($id);
        if ($model === null)
            return false;
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
