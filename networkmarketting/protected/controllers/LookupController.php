<?php

class LookupController extends CController {

    public function actionCities() {

        echo CHtml::label("City", 'city_id');
        if (isset($_POST['Users']['country_id'])) {

            $cities = City::getCitiesArrayForCountry($_POST['Users']['country_id']);
            if (!empty($cities)) {

                echo CHtml::dropDownList('Users[' . 'city_id' . ']', array('empty' => '---Select City---'), $cities, array('class' => 'span5'));
            }
        }
    }

    public function actionProducts() {

        echo CHtml::label("Users", 'product_id');
        if (isset($_POST['Users']['product_id'])) {

            $products = ProductDetail::model()->findAll("product_id=?", array($_POST['Users']['product_id']));
            if (!empty($products)) {
                $str = '';
                foreach ($products as $model) {
                

                    $str .= '<tr><td>
                ' . CHtml::activeRadioButton($model, 'product_detail_id', array('value' => $model->product_detail_id, 'uncheckValue' => null))
                            . CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->image )
                            . $model->product_detail . '            
               
                Price:' . $model->price . 'Points
                </td></tr>';
                }
                echo $str;
            }
        }
    }

    public function actionResetPassword() {
        if (!empty($_POST['LoginForm']['username'])) {

            $model = Account::model()->find("LOWER(username)=?", array(strtolower($_POST['LoginForm']['username'])));

            if (!empty($model)) {
                $pass = UtilityManager::rand_string(8);
                $model->password = $pass;
                $model->password_repeat = $pass;

                $text = $this->renderInternal('protected/views/mail/notifications/newPassword.php', array('username' => $_POST['LoginForm']['username'], "full_name" => $model->full_name, "code" => $pass), true);
                if ($model->update()) {
                    UtilityManager::sendEmail($model->primary_email, $model->full_name, 'New Password', $text);
                }
            }
        } else {

            echo "Please enter the Username";
        }

        echo "Please check your primary email inbox for the new password";
    }

    public function actionOtherCharge() {

        if (!empty($_POST['Users']['primary_email']) && filter_var($_POST['Users']['primary_email'], FILTER_VALIDATE_EMAIL)) {

            $share = new EmailFundShare();
            $share->email = $_POST['Users']['primary_email'];
            $share->code = UtilityManager::rand_string(4);
            $sharer = Users::getUserUserFromUserName($_POST['Users']['other_username']);
            $share->share_id = $sharer->user_id;

            $transaction = Yii::app()->db->beginTransaction();
            try {

                if ($share->save()) {
                    $text = $this->renderInternal('protected/views/mail/notifications/shareVerification.php', array('full_name' => $_POST['Users']['full_name'], "email" => $_POST['Users']['primary_email'], "code" => $share->code), true);
                    UtilityManager::sendEmail($sharer->primary_email, $sharer->full_name, 'Funds Sharring code', $text);
                    $transaction->commit();
                    echo "Code sent to email of user " . $sharer->username;
                } else {

                    echo CHtml::errorSummary($share);
                }
            } catch (Exception $ex) {
                if ($transaction->active) {
                    $transaction->rollBack();
                }

                echo $ex->getMessage();
                Yii::log('Exception when saving data: ' . $ex->getMessage(), CLogger::LEVEL_ERROR);
                //echo "Please check the email address you used for verification and use the code which is sent or contact support";
            }



//sendEmail($email, $fullname, $subject, $message_body,
        } else {

            echo "Please set a valid Primary email";
        }
    }

    public function actionEmailVerify() {

        if (isset($_POST['Account']))
            $_POST['Users'] = $_POST['Account'];

        if (!empty($_POST['Users']['primary_email']) && filter_var($_POST['Users']['primary_email'], FILTER_VALIDATE_EMAIL)) {

            $verify = new EmailVerification();
            $verify->email = $_POST['Users']['primary_email'];
            $verify->code = UtilityManager::rand_string(4);
            $transaction = Yii::app()->db->beginTransaction();
            try {

                if ($verify->save()) {
                    $text = $this->renderInternal('protected/views/mail/notifications/mailVerification.php', array('full_name' => $_POST['Users']['full_name'], "code" => $verify->code), true);
                    UtilityManager::sendEmail($_POST['Users']['primary_email'], $_POST['Users']['full_name'], 'Email Verification code', $text);
                    $transaction->commit();
                    echo "Code sent to email " . $_POST['Users']['primary_email'];
                } else {

                    echo CHtml::errorSummary($verify);
                }
            } catch (Exception $ex) {
                if ($transaction->active) {
                    $transaction->rollBack();
                }

                Yii::log('Exception when saving data: ' . $ex->getMessage(), CLogger::LEVEL_ERROR);
                echo "Please check the email address you used for verification and use the code which is sent or contact support";
            }



//sendEmail($email, $fullname, $subject, $message_body,
        } else {

            echo "Please set a valid Primary email";
        }
    }

    public function actionSecurityReminder() {

        $user = $this->loadModel(Yii::app()->user->getId());

        if (!empty($user->primary_email) && filter_var($user->primary_email, FILTER_VALIDATE_EMAIL)) {

            $text = $this->renderInternal('protected/views/mail/notifications/securityReminder.php', array('user' => $user), true);
            UtilityManager::sendEmail($user->primary_email, $user->full_name, 'Confidential Security Information', $text);
            echo "Confidential Security Information to email " . $user->primary_email;
        } else {

            echo "Please set a valid Primary email";
        }
    }

    public function actionChildData() {

        if (isset($_GET['id'])) {
            $user  = Account::model()->findByPk($_GET['id']);
            
            if($user->stage == 1){
                
               $data = UtilityManager::getUserLeftAndRight($user->user_id);
            
                            echo '<div class="modal-header">
    <a class="close" data-dismiss="modal">';
            echo $user->full_name. '</a>
    <h4>';

            echo $user->username . ' </h4>
</div>';
            echo '<div class="modal-body">
    <p>';
            echo "<br> <b>Team</b> </br>";
            echo "left: " . $data['left'] . ' / right: ' . $data['right'];

            echo '</p>
</div>';
            }
            else{

            $data = UtilityManager::getRemainingSale($_GET['id']);



            echo '<div class="modal-header">
    <a class="close" data-dismiss="modal">';
            echo $data['full_name'] . '</a>
    <h4>';

            echo $data['username'] . ' </h4>
</div>';
            echo '<div class="modal-body">
    <p>';
            echo "<br> <b>Sale</b> </br>";
            echo "left: " . $data['total_sales']['left_sales'] . ' / right: ' . $data['total_sales']['right_sales'];

            echo "<br> <b>Remaining Sale</b> </br>";
            echo "left: " . $data['remaining_sale']['left'] . ' / right: ' . $data['remaining_sale']['right'];

            echo '</p>
</div>';
    }
    
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Users;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->user_id));
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

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->user_id));
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
        $model = Users::model()->findByPk($id);
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
