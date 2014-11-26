<?php

class UtilityManager {

    const SATOSHI = 100000000;

    /*
     * will be used only one time to get the address for escrow
     */
    const CALL_BACK_URL = 'http://www.cheaperbitcoins.com/trade/verify?secret=dha540378';
    const ROOT_URL = 'https://blockchain.info/api/receive?api_code=ff4e4c60-7f1d-422a-8ba0-aabe11c49c54';
    const SECRET = 'dha540378';
    const REAL_ADDRESS = '17mrSHyBFkzyDHUDbd1eUmPtL5zp6QXVmb';
    const API_CODE = 'ff4e4c60-7f1d-422a-8ba0-aabe11c49c54';
    const PRICE_UPDATE_TYPE = 'remote_prices';

    // const REAL_ADDRESS_KEY = ' the real actaul address key';
    const ADMIN = 'admin';
    const USER = 'user';

    public static function sendSms($to,$message_body){
        
        if(empty($to)){
            return ' require to have a verified phone number, please verify your phone first';
        }
        
        // Instantiate a new Twilio Rest Client
	$client = new Services_Twilio(Yii::app()->params['accountSid'], Yii::app()->params['authToken']);
        $from = Yii::app()->params['fromSms'];
        $resp = $client->account->sms_messages->create($from, $to, $message_body);
        return $resp->status;
        
    }
    
    public static function getDIsputeNotificationVars($dispute){
        
        $var = array();
         
            $var ['disputer_trade_link'] = CHtml::link(CHtml::encode('Trade'), array('trade/'. $dispute->transaction->trade->getTradeType().'/' . $dispute->transaction->trade->id), array("class" => "btn-link"));
            $var['disputer_client_link'] = CHtml::link($dispute->users->username, array('trader/profile/' . $dispute->users->username), array("class" => "primary-link"));
            $var['disputer_email'] = $dispute->users->email;
            $var['disputer_fullname'] = $dispute->transaction->trade->users->username;
            
            if($dispute->users_id !== $dispute->transaction->users_id){
                $user = $dispute->transaction->users;
            }else{
                $user = $dispute->transaction->trade->users;
            }
       
            $var['trade_link'] = CHtml::link(CHtml::encode('Trade'), array('trade/'. $dispute->transaction->trade->getTradeType().'/' . $dispute->transaction->trade->id), array("class" => "btn-link"));
            $var['client_link'] = CHtml::link($user->username, array('trader/profile/' . $user->username), array("class" => "primary-link"));
            $var['email'] = $user->email;
            $var['fullname'] = $dispute->transaction->users->username;
        
        return $var;
        
    }

    public static function sendDisputeNotification($dispute,$controller){
        $subject = 'Decision of dispute';
        $var = self::getDIsputeNotificationVars($dispute);
        if($dispute->won){
            $client_link = $var['disputer_client_link'];
        }
        else{
            $client_link = $var['client_link'];
        }
         $message_body = $controller->renderInternal('protected/views/mail/notifications/disputeWon.php', array('trade_link' => $var['disputer_trade_link'],
             'client_link' => $client_link), true);
         $users = array($dispute->transaction->escrow->owner->username => $dispute->transaction->escrow->owner->email,
             $dispute->transaction->escrow->user->username => $dispute->transaction->escrow->user->email);
        foreach($users as $username=>$email)
             UtilityManager::sendEmail($email, $username, $subject, $message_body);
        
    }

    public static function debug($model) {
        echo '<pre>';
        print_r($model);
    }

    public static function _getTwoFactorCodes() {

        return TwoFactorAuthentication::model()->findAll('users_id=?', array(Yii::app()->user->getId()));
    }

    public static function createTwoFactorCodes() {

        foreach (range(1, 90) as $number) {
            $two_fac = new TwoFactorAuthentication();
            $two_fac->code = self::rand_int(6);
            $two_fac->users_id = Yii::app()->user->getId();
            $two_fac->number = $number;
            $two_fac->save();
        }
        return self::_getTwoFactorCodes();
    }

    public static function getTwoFactorCodes() {
        $twoFactor = self::_getTwoFactorCodes();
        if (empty($twoFactor)) {
            return self::createTwoFactorCodes();
        }
        return $twoFactor;
    }

    public static function escrowCoins($trans_id, $user_id, $owner_id) {
        $transaction = Transaction::model()->findByPk($trans_id);
        $wallet = self::getMyWallet($$transaction->users_id);
        $balance = UtilityManager::getWalletBalance($wallet->wallet_id);
        if ($balance < $transaction->btc) {
            return "Not enough coins to escrow";
        }

        $wallet_balance = new WalletBalance();
        $wallet_balance->btc_out = $transaction->btc;
        $wallet_balance->wallet_id = $wallet->id;
        $wallet_balance->btc = $balance - $wallet->btc;
        if ($wallet_balance->save()) {
            
        }

        $trans = new TransactionData();
        $trans->user_id = $user_id;
        $trans->transaction_id = $trans_id;
        $trans->owner_id = $owner_id;
        if ($trans->save()) {
            return false;
        }

        return $trans;
    }

    public static function sendEmailVerification($email, $code, $full_name = 'User') {

        $verify = new EmailVerification();
        $verify->email = $email;
        $verify->code = $code;
        $transaction = Yii::app()->db->beginTransaction();
        try {

            if ($verify->save()) {
                $text = $this->renderInternal('protected/views/mail/notifications/mailVerification.php', array('full_name' => $full_name, "code" => $verify->code), true);
                UtilityManager::sendEmail($email, $full_name, 'Email Verification code', $text);
                $transaction->commit();
                echo "Code sent to email " . $email;
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
    }

    public static function getMyWallet($user_id = null) {
        if (empty($user_id)) {
            $user_id = Yii::app()->user->getId();
        }
        $model = Wallet::model()->find('users_id=?', array($user_id));

        if (empty($model)) {
            $params = array(
                'method' => 'create',
                'address' => self::REAL_ADDRESS,
                'secret' => self::SECRET,
                'api_code' => self::API_CODE,
                'callback_url' => urlencode(self::CALL_BACK_URL . '&user_id=' . $user_id)
            );
            $link = http_build_query($params);
            $resp = self::getCurlResponse(self::ROOT_URL . '&user_id=' . $user_id . '&' . $link);

            if (!empty($resp)) {
                $model = new Wallet();
                $model->address = $resp->input_address;
                $model->user_id = $user_id;
                $model->save();
            } else {
                
            }
        }
        return $model;
    }

    public static function getMyWalletIdentity($user_id) {

        $model = Wallet::model()->find('users_id=?', array($user_id));

        if (!empty($model)) {
            return base64_decode($model->identifier);
        }
        return false;
    }

    /**
     * Returns an encrypted & utf8-encoded
     * @param string $pure_string The text need to be encrypt
     * @param string $encryption_key the key use for encryption
     */
    public static function encrypt($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    /**
     * Returns decrypted original string
     * @param string $encrypted_string The encrypted text need to be decrypt
     * @param string $encryption_key the key use for encryption
     */
    public static function decrypt($encrypted_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }

    public static function int_to_words($x) {
        $nwords = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        if (!is_numeric($x)) {
            $w = '#';
        } else if (fmod($x, 1) != 0) {
            $w = '#';
        } else {
            if ($x < 0) {
                $w = 'minus ';
                $x = -$x;
            } else {
                $w = '';
            }
            if ($x < 21) {
                $w .= $nwords[$x];
            } else if ($x < 100) {
                $w .= $nwords[10 * floor($x / 10)];
                $r = fmod($x, 10);
                if ($r > 0) {
                    $w .= '-' . $nwords[$r];
                }
            } else if ($x < 1000) {
                $w .= $nwords[floor($x / 100)] . ' hundred';
                $r = fmod($x, 100);
                if ($r > 0) {
                    $w .= ' and ' . self::int_to_words($r);
                }
            } else if ($x < 100000) {
                $w .= self::int_to_words(floor($x / 1000)) . ' thousand';
                $r = fmod($x, 1000);
                if ($r > 0) {
                    $w .= ' ';
                    if ($r < 100) {
                        $w .= 'and ';
                    }
                    $w .= self::int_to_words($r);
                }
            } else {
                $w .= self::int_to_words(floor($x / 100000)) . ' lakh';
                $r = fmod($x, 100000);
                if ($r > 0) {
                    $w .= ' ';
                    if ($r < 100) {
                        $word .= 'and ';
                    }
                    $w .= self::int_to_words($r);
                }
            }
        }
        return $w;
    }

    public static function numberToWords($number) {
        $words = array('zero',
            'one',
            'two',
            'three',
            'four',
            'five',
            'six',
            'seven',
            'eight',
            'nine',
            'ten',
            'eleven',
            'twelve',
            'thirteen',
            'fourteen',
            'fifteen',
            'sixteen',
            'seventeen',
            'eighteen',
            'nineteen',
            'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand');
        $number_in_words = '';
        if (is_numeric($number)) {
            $number = (int) round($number);
            if ($number < 0) {
                $number = -$number;
                $number_in_words = 'minus ';
            }
            if ($number > 1000) {
                $number_in_words = $number_in_words . numberToWords(floor($number / 1000)) . " " . $words[1000];
                $hundreds = $number % 1000;
                $tens = $hundreds % 100;
                if ($hundreds > 100) {
                    $number_in_words = $number_in_words . ", " . numberToWords($hundreds);
                } elseif ($tens) {
                    $number_in_words = $number_in_words . " and " . numberToWords($tens);
                }
            } elseif ($number > 100) {
                $number_in_words = $number_in_words . numberToWords(floor($number / 100)) . " " . $words[100];
                $tens = $number % 100;
                if ($tens) {
                    $number_in_words = $number_in_words . " and " . numberToWords($tens);
                }
            } elseif ($number > 20) {
                $number_in_words = $number_in_words . " " . $words[10 * floor($number / 10)];
                $units = $number % 10;
                if ($units) {
                    $number_in_words = $number_in_words . numberToWords($units);
                }
            } else {
                $number_in_words = $number_in_words . " " . $words[$number];
            }
            return $number_in_words;
        }
        return false;
    }

    public static function rand_string($length = 1) {

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        return substr(str_shuffle($chars), 0, $length);
    }

    public static function rand_int($length = 4) {

        $chars = "0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public static function random_username() {
        $username = self::rand_string() . self::rand_int() . self::rand_string();
        $user = Users::model()->find("username=?", array($username));
        while ($user) {
            $username = self::rand_string() . self::rand_int() . self::rand_string();
            $user = Users::model()->find("username=?", array($username));
        }

        return $username;
    }

    public static function getRandomPassword($length = 10) {
        $chars = '0123456789@#$%^&*()_+!~ABCDEFGHIJKLMNOPQRSTUVWXYZ?><:"{}[]';
        return substr(str_shuffle($chars), 0, $length);
    }

    public static function number_format_unlimited_precision($number, $decimal = '.') {
        $broken_number = explode($decimal, $number);

        if (!isset($broken_number[1][1]))
            return $number;

        return number_format($broken_number[0]) . $decimal . $broken_number[1][0] . $broken_number[1][1];
    }
    
    public static function sendBroadcast($user_id,$type,$message){
        
        $broadcast = new Broadcast();
            $broadcast->users_id = $user_id;
            $broadcast->type = strtolower($type);
            $broadcast ->message = $message;
            return $broadcast->save();
    }

    public static function sendEmail($email, $fullname, $subject, $message_body, $unlink = false) {
        
        if (Yii::app()->params['debug']) {
            $email = Yii::app()->params['adminEmail'];
            $fullname = Yii::app()->params['companyName'];
        }
        
        $params=array('email'=>  $email,
                'fullname' => $fullname,
            'subject' => $subject,
           'message_body' => $message_body
                );

            Yii::import('ext.runactions.components.ERunActions');
            ERunActions::runAction('notifications/sendEmail',$params,$ignoreFilters=true,$ignoreBeforeAfterAction=TRUE,$logOutput=false,$silent=false);

    }

    public static function getMyWalletBalance() {
        $wallet = Wallet::model()->find('users_id=?', array(Yii::app()->user->getId()));
        if (empty($wallet)) {
            return 0;
        }
        $criteria = new CDbCriteria(array(
            'condition' => "wallet_id=" . $wallet->id,
            'order' => 'id DESC',
            'limit' => 1,
        ));
        $balance = WalletBalance::model()->find($criteria);
        if (!empty($balance)) {
            return $balance->btc;
        }
        return 0;
    }

    public static function getWalletBalance($wallet_id) {
        $criteria = new CDbCriteria(array(
            'condition' => "wallet_id=" . $wallet_id,
            'order' => 'id DESC',
            'limit' => 1,
        ));
        $balance = WalletBalance::model()->find($criteria);
        if (!empty($balance)) {
            return $balance->btc;
        }
        return 0;
    }

    public static function sendEmailWithAttachement($email, $fullname, $subject, $message_body, $paths = array(), $unlink = false) {

        //$email = Yii::app()->params['adminEmail'];
        //	if (ERunActions::runBackground())
        //{
        ini_set('max_execution_time', 600);
        if (Yii::app()->params['debug']) {
            $email = Yii::app()->params['adminEmail'];
            $fullname = Yii::app()->params['adminName'];
        }

        //do all the stuff that should work in background
        $contentType = 'text/html';
        $charset = 'utf-8';
        $message = new YiiMailMessage();
        $message->setTo(
                array($email => $fullname));
        $message->setFrom(array(Yii::app()->params['adminEmail'] => Yii::app()->params['adminName']));
        $message->setSubject($subject);

        $message->setBody($message_body, $contentType, $charset);

        foreach ($paths as $path) {
            $message->fileAttach($path); //this is succeed
            //after send
        }

        Yii::log('going');
        return Yii::app()->mail->send($message);


        //	Yii::log('going');

        /*
          }
          else
          {


          //this code will be executed immediately
          //echo 'Time-consuming process has been started'
          //user->setFlash ...render ... redirect,

          Yii::app()->user->setFlash('success', 'Thank You please check your email.');
          }
         */
    }

    public static function toArray(SimpleXMLElement $xml) {
        $array = (array) $xml;

        foreach (array_slice($array, 0) as $key => $value) {
            if ($value instanceof SimpleXMLElement) {
                $array[$key] = empty($value) ? NULL : self::toArray($value);
            }
        }
        return $array;
    }

    public static function activeCheckBoxList($model, $attribute, $data, $htmlOptions = array()) {

        if (is_array($model)) {

            $raw_model = $model[0];
            $attributes = array();
            foreach ($model as $raw)
                $attributes[] = $raw->$attribute;
            $raw_model->$attribute = $attributes;


            return CHtml::activeCheckBoxList($raw_model, $attribute, $data);
        } else
            return CHtml::activeCheckBoxList($model, $attribute, $data);
    }

    public static function deleteImage($path) {

        try {

            if (is_file(Yii::getPathOfAlias('webroot') . '/' . $path)) {
                unlink(Yii::getPathOfAlias('webroot') . '/' . $path);
            }
        } catch (Exception $ex) {
            
        }
    }
    
    public static function isJobRunning($type){
        $job = BackgroundJobs::model()->find('type=?', array($type));
        if (empty($job)) {
            return false;
        }
        
       return $job->is_runing;
        
    }

    public static function getTickerCompare() {
       self::getExchanegRate();
        $criteria = new CDbCriteria;
        $criteria->select = 'min(trade_price) as minprice';
        //$criteria->compare('trade_type_id ', TradeType::getTypeIds("buy_online"));
        $bid = Trade::model()->find($criteria);

        $localBitcoins = PriceTicker::getRates('LocalBitcoins','GBP');
        $bitstamp = PriceTicker::getRates('Bitstamp', 'GBP');
         
        if( Time::getDifferenceInSeconds($bitstamp->created_at, UtilityManager::getSqlCurrentDate()) > 600  && !self::isJobRunning(self::PRICE_UPDATE_TYPE)){
            Yii::import('ext.runactions.components.ERunActions');
            ERunActions::runAction('notifications/priceUpdate',$params=array(),$ignoreFilters=true,$ignoreBeforeAfterAction=true,$logOutput=false,$silent=false);

        }

        $criteria = new CDbCriteria;
        $criteria->select = 'MIN(trade_price) as minprice';
        $criteria->compare('trade_type_id ', TradeType::getTypeIds("sell_online"));
        $ask = Trade::model()->find($criteria);

        return array('bid' => $bid->minprice, 'ask' => $ask->minprice, 'localbitcoins' => $localBitcoins, 'bitstamp' => $bitstamp);
    }

    public static function getExchanegRate($currency = 'GBP') {
        
        $coinDesk = PriceTicker::getRates('CoinDesk', $currency);
        $bitstamp = PriceTicker::getRates('Bitstamp',$currency);
        
        

        return array(
            'coinDesk' => $coinDesk,
            'bitstamp' => $bitstamp
        );
    }

    public static function getTransactions($address) {
        return self::getCurlResponse('http://blockchain.info/address/' . $address . '?format=json');
    }

    public static function getBlockChainResponse($url, $postFieldsArray = array()) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFieldsArray));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }

    public static function transferBtc($guid, $params) {

        return self::getBlockChainResponse('https://blockchain.info/merchant/' . $guid . '/payment', $params);
    }

    public static function transferMany($main_password, $amount, $guid) {
        $recipients = array(
            'address' => $amount * UtilityManager::SATOSHI,
        );
        return UtilityManager::transferBtc($guid, array('password' => $main_password,
                    'recipients' => $recipients
        ));
    }

    public static function completedTransactions($guid, $params) {

        return self::getBlockChainResponse('https://blockchain.info/merchant/' . $guid . '/payment', $params);
    }

    public static function getCurlResponse($url) {

        $ch = curl_init();

        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
// Execute
        $result = curl_exec($ch);
        // $info = curl_getinfo($ch);
        //echo '<pre>';  print_r($info);
// Closing
        //   print_r($result);exit;
        curl_close($ch);

        return json_decode($result);
    }

    public static function getUploadDirectory($user_id, $category) {


        // make the directory to store the pic:
        if (!is_dir(Yii::getPathOfAlias('webroot') . "/images/$user_id/" . $category)) {

            if (!is_dir(Yii::getPathOfAlias('webroot') . "/images/")) {
                mkdir(Yii::getPathOfAlias('webroot') . "/images/");
                chmod(Yii::getPathOfAlias('webroot') . "/images/", 0755);

                // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
            }
            if (!is_dir(Yii::getPathOfAlias('webroot') . "/images/$user_id/")) {
                mkdir(Yii::getPathOfAlias('webroot') . "/images/$user_id/");
                chmod(Yii::getPathOfAlias('webroot') . "/images/$user_id/", 0755);
                // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
            }
            if (!is_dir(Yii::getPathOfAlias('webroot') . "/images/$user_id/" . $category)) {
                mkdir(Yii::getPathOfAlias('webroot') . "/images/$user_id/" . $category);
                chmod(Yii::getPathOfAlias('webroot') . "/images/$user_id/" . $category, 0755);
                // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
            }
        }
        return "/images/$user_id/" . $category;
    }

    public static function getSqlCurrentDate() {
        return date('Y-m-d H:i:s');
    }
    
    public static function getCurrentDate() {
        return date('Y-m-d');
    }
    
    public static function getMentorForTicket(){
        
        return Users::model()->find('role_id=?',array(Role::getRoleId('admin')))->id;
    }

    public static function getSqlAfterYearDate() {
        $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . " +1 year"));
    }

    public static function getSqlAfterXMinutesDate($xMinutes = 60) {
        $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . " -$xMinutes min"));
    }

    public static function getSqlTodayDateOnly() {
        return date('Y-m-d');
    }

    public static function getSqlDayAfterDate() {
        $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . " +1 day"));
    }

    public static function getSqlYesterdayDate() {
        $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . " -1 day"));
    }

    public static function uploadAllAttachments($category_id, $category_pk_id, $destination_id = NULL, $new = true) {
        foreach (self::$upload_content_type_array as $upload_content_type) {
            self::uploadAttachments($upload_content_type, $category_id, $category_pk_id, $destination_id, $new);
        }
    }

    public static function uploadProductImage($model, $prop) {

        $pic = CUploadedFile::getInstance($model, $prop);

        //$pic = CUploadedFile::getInstance($model,"image");
        if (!empty($pic)) {
            // go through each uploaded upload

            $fileLocation = self::getUploadDirectory('product', 'preview') . '/';
            if ($pic->saveAs(Yii::getPathOfAlias('webroot') . $fileLocation . $pic->name)) {
                return $fileLocation . $pic->name;
            } else {
                return null;
            }
        }
    }

    public static function uploadAttachments($content_type_upload, $category_id, $category_pk_id, $destination_id = NULL, $new = true) {

        $uploads = CUploadedFile::getInstancesByName($content_type_upload);
        if (isset($uploads) && count($uploads) > 0) {
            // go through each uploaded upload
            foreach ($uploads as $upload => $pic) {
                $fileLocation = self::getUploadDirectory($content_type_upload, Yii::app()->user->id, $category_id) . '/';
                if ($pic->saveAs(Yii::getPathOfAlias('webroot') . $fileLocation . $pic->name)) {
                    // add it to the main model now
                    switch ($content_type_upload) {
                        case self::$content_type_document:
                            $upload_add = new DocumentUploader();
                            break;
                        case self::$content_type_video:
                            $upload_add = new VideoUploader();
                            break;
                        case self::$content_type_photo:
                            $upload_add = new PhotoUploader();
                            break;
                        default:
                            return;
                            break;
                    }
                    $upload_add->size = $pic->size;
                    $upload_add->name = $pic->name; //it might be $upload_add->name for you, filename is just what I chose to call it in my model
                    $upload_add->destination_id = $destination_id; // this links your picture model to the main model (like your user, or profile model)
                    $upload_add->user_id = Yii::app()->user->id;
                    $upload_add->location = $fileLocation;
                    $upload_add->modified_date = self::getSqlCurrentDate();
                    $upload_add->create_date = $upload_add->modified_date;
                    $upload_add->category_id = $category_id;
                    $upload_add->category_pk_id = $category_pk_id;
                    if ($new) {
                        if ($upload_add->save()) {
                            
                        } else {
                            print_r($upload_add);
                            exit;
                        }
                    } // DONE
                    else {
                        $upload_add->update();
                    }
                } else {
                    // handle the errors here, if you want
                }
            }
        }

        return true;
    }

    public static function uploadReplaceAttachments($content_type_upload, $category_id, $category_pk_id, $destination_id = NULL) {
        $uploads = CUploadedFile::getInstancesByName($content_type_upload);
        if (isset($uploads) && count($uploads) > 0) {
            // go through each uploaded upload
            foreach ($uploads as $upload => $pic) {
                $fileLocation = self::getUploadDirectory($content_type_upload, Yii::app()->user->id, $category_id) . '/';
                if ($pic->saveAs(Yii::getPathOfAlias('webroot') . $fileLocation . $pic->name)) {
                    $criteria = new CDbCriteria();
                    $criteria->compare('user_id', Yii::app()->user->id);
                    $criteria->compare('category_id', $category_id);
                    $criteria->compare('category_pk_id', $category_pk_id);
                    $upload_add = PhotoUploader::model()->find($criteria);
                    // add it to the main model now

                    if (!empty($upload_add->id)) {
                        if (Yii::app()->user->id == $upload_add->user_id && (!empty($upload_add))) {

                            unlink(Yii::getPathOfAlias('webroot') . $upload_add->location . $upload_add->name);


                            $upload_add->size = $pic->size;
                            $upload_add->name = $pic->name; //it might be $upload_add->name for you, filename is just what I chose to call it in my model
                            $upload_add->destination_id = $destination_id; // this links your picture model to the main model (like your user, or profile model)
                            $upload_add->user_id = Yii::app()->user->id;
                            $upload_add->location = $fileLocation;
                            $upload_add->modified_date = self::getSqlCurrentDate();
                            $upload_add->update();
                        }
                    } else {

                        $upload_add->size = $pic->size;
                        $upload_add->name = $pic->name; //it might be $upload_add->name for you, filename is just what I chose to call it in my model
                        $upload_add->destination_id = $destination_id; // this links your picture model to the main model (like your user, or profile model)
                        $upload_add->user_id = Yii::app()->user->id;
                        $upload_add->location = $fileLocation;
                        $upload_add->modified_date = self::getSqlCurrentDate();
                        $upload_add->create_date = $upload_add->modified_date;
                        $upload_add->category_id = $category_id;
                        $upload_add->category_pk_id = $category_pk_id;
                        $upload_add->save();
                    }
                } else {
                    // handle the errors here, if you want
                }
            }
        }

        return true;
    }

    public static function deleteUploadedAttachments($content_type_upload, $attachment_id) {
        $upload_delete = PhotoUploader::model()->findByPk($attachment_id);

        if (!empty($upload_delete)) {
            if (Yii::app()->user->id == $upload_delete->user_id) {


                if ($upload_delete->delete()) {
                    try {
                        unlink(Yii::getPathOfAlias('webroot') . $upload_delete->location . $upload_delete->name);
                    } catch (Exception $ex) {
                        
                    }
                } else {
                    
                }
            } else
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            ;
        }

        return true;
    }

    public function __construct() {
        
    }

}
