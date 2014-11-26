<?php

class UtilityManager {

    public static $stages_sale_limit = array("1" => 20, "2" => 4000, "3" => 0);
    public static $stages_flushout = array("1" => 50, "2" => 100, "3" => 300);
    public static $stages_fees_based = array("1" => 15, "2" => 35, "3" => 55);
    public static $stages_commission = array("1" => 20, "2" => 100, "3" => 0);
    public static $stages_commission_earning = array("1" => 5, "2" => 10, "3" => 16.50);
    public static $stages_commission_based = array("1" => 15, "2" => 70, "3" => 165);
    public static $stage_one_commission = 5;
    public static $stage_two_commission = 10;
    public static $stage_three_commission = 16.50;

    const LEVEL_UPGRADE = 10;

    public static $pkr = 97;
    public static $stage_one_fees = 15;
    public static $stage_two_fees = 35;
    public static $stage_three_fees = 55;
    public static $stages_fees = array("1" => 15, "2" => 35, "3" => 55);
    public static $instance = false;

    
    const LEVEL_TWO_COMMISSION_BASED = 70;
    const LEVEL_THREE_COMMISSION_BASED = 165;
    const LEVEL_ONE_FLASHOUT = 50;
    const LEVEL_TWO_FLASHOUT = 100;
    const LEVEL_THREE_FLASHOUT = 500;
    
    
    public static function isRmsUser($user,$position){
        if($user->stage != 1 ){
           $paidCom = Commission::getAllComissionCountForUser($user->user_id);
           if($paidCom != 0){
               return false;
           }
            $rms = new Rms();
            $rms->user_id = $user->user_id;
            $rms->position = $position;
            $rms->created_date = self::getSqlCurrentDate();
            if($rms->getRmsCountForStage($position) == 0){
               $rms->save();
             
                if($position == 'left'){
                $pos = 'right';    
                }
                else{
                    $pos = 'left';
                }
                if($rms->getRmsCountForStage($pos) != 0){
                    
                    $comm = new Commission();
                    $comm->created_date = $rms->created_date;
                    $comm->remarks = 'RMS';
                    $comm->user_id = $rms->user_id;
                    $comm->stage = $user->stage;
                    $comm->points = self::$stages_commission_earning[$user->stage];
                    $comm->save();
                }
                
            }
            return true;
        }
        else{
            return false;
        }
        
    }



    public static function int_to_words($x)
       {  
        $nwords = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety' );
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#'; 
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               } 
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10); 
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' hundred'; 
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. self::int_to_words($r);
                   }
               } else if($x < 100000) 
               {
                   $w .= self::int_to_words(floor($x/1000)) .' thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= self::int_to_words($r);
                   } 
               } else {
                   $w .= self::int_to_words(floor($x/100000)) .' lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= self::int_to_words($r);
                   } 
               }
           }
           return $w;
               
       }






public static function numberToWords ($number)
{
$words = array ('zero',
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
      30=> 'thirty',
      40 => 'fourty',
      50 => 'fifty',
      60 => 'sixty',
      70 => 'seventy',
      80 => 'eighty',
      90 => 'ninety',
      100 => 'hundred',
      1000=> 'thousand');
 $number_in_words = '';
  if (is_numeric ($number))
  {
    $number = (int) round($number);
    if ($number < 0)
    {
      $number = -$number;
      $number_in_words = 'minus ';
    }
    if ($number > 1000)
    {
      $number_in_words = $number_in_words . numberToWords(floor($number/1000)) . " " . $words[1000];
      $hundreds = $number % 1000;
      $tens = $hundreds % 100;
      if ($hundreds > 100)
      {
        $number_in_words = $number_in_words . ", " . numberToWords ($hundreds);
      }
      elseif ($tens)
      {
        $number_in_words = $number_in_words . " and " . numberToWords ($tens);
      }
    }
    elseif ($number > 100)
    {
      $number_in_words = $number_in_words . numberToWords(floor ($number / 100)) . " " . $words[100];
      $tens = $number % 100;
      if ($tens)
      {
        $number_in_words = $number_in_words . " and " . numberToWords ($tens);
      }
    }
    elseif ($number > 20)
    {
      $number_in_words = $number_in_words . " " . $words[10 * floor ($number/10)];
      $units = $number % 10;
      if ($units)
      {
        $number_in_words = $number_in_words . numberToWords ($units);
      }
    }
    else
    {
      $number_in_words = $number_in_words . " " . $words[$number];
    }
    return $number_in_words;
  }
  return false;
}


    public static function getRemainingSale($userId) {

        $rms_sale = 0;
        
        $rms_stage = Commission::getRmsStage($userId);
        if(!empty($rms_stage)){
            $rms_sale = self::$stages_fees_based[$rms_stage];
        }
        $user = Users::model()->findbypk($userId);
        $sale = new Sale();
        $sale->user_id = $user->user_id;
         $rightcount = $sale->getSaleForAll('right');
        $leftcount = $sale->getSaleForAll('left');
        $sales = array();
        $commissions = array();
        $remianingsales = array('left' => 0, 'right' => 0);

         $flushout_date = Flushout::getLastFlushOutDate($userId);
        for ($i = 1; $i <= $user->stage; $i++) {
            $commissions[$i]['paid'] = Commission::getComissionTotalForUser($user->user_id, $i,$flushout_date);
            $commissions[$i]['paid_sale'] = Commission::getComissionCountForUser($user->user_id, $i,$flushout_date) * self::$stages_commission_based[$i];
            $sales[$i]['right'] = $sale->getSaleForStage($i, 'right',$flushout_date);
            $sales[$i]['left'] = $sale->getSaleForStage($i, 'left',$flushout_date);
            
            
            $sales[$i]['right_remaining'] = $sales[$i]['right'] - $commissions[$i]['paid_sale'];
            $sales[$i]['left_remaining'] = $sales[$i]['left'] - $commissions[$i]['paid_sale'];
            $remianingsales['left'] += $sales[$i]['left_remaining'];
            $remianingsales['right'] += $sales[$i]['right_remaining']; 
            
        }
if(empty($flushout_date)){
       $remianingsales['left'] = $remianingsales['left'] - $rms_sale;
         $remianingsales['right'] = $remianingsales['right'] - $rms_sale; 
  }          
        return array("username"=>$user->username,"full_name"=>$user->full_name,"remaining_sale"=> $remianingsales,"sales"=>$sales,"commissions"=>$commissions,"total_sales"=>array("left_sales"=>$leftcount,"right_sales"=>$rightcount));
        
    }

    public static function getProductPrice($product_id) {
        return ProductDetail::model()->find("product_detail_id=?", array($product_id))->price;
    }

    public function getLeftAndRightWithCount($user) {

        $result = array();
        $result['count'] = 0;
        $result['user'] = array();

        if (!empty($user->leftchild)) {
            $result['user'][] = $user->leftchild;
            $result['count'] = $result['count'] + 1;
        }

        if (!empty($user->rightchild)) {
            $result['user'][] = $user->rightchild;
            $result['count'] = $result['count'] + 1;
        }
        return $result;
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

    public static function getFlushOut($user) {

        $commission_earned = Commission::getDailyComissionTotalForUser($user->user_id, $user->stage);

        if ($commission_earned >= self::$stages_flushout[$user->stage]) {
            $flushout = new Flushout();
            $flushout->user_id = $user->user_id;
            $flushout->created_date = self::getSqlCurrentDate();
            $flushout->end_date = self::getSqlDayAfterDate();
            if(!$flushout->isFlushOut()){
                $flushout->save();
            }
            return true;
        }
        return false;
    }

    public function getUserChild($root_id, $user_name = null) {

        $user_stat = Users::model()->findByPk($root_id);
        $rlevel = 0;
        $llevel = 0;
        $lefts = array();
        $rights = array();
        $in_lefts = array();
        $in_rights = array();
        $lcount = 0;
        $rcount = 0;
        $leftresults = array();
        $rightresults = array();
        $results = array();
        $results['leftcount'] = 0;
        $results['rightcount'] = 0;

        if (!empty($user_stat->leftchild)) {
            $lefts[] = $user_stat->leftchild;
            $lcount++;
        }


        if (!empty($user_stat->rightchild)) {
            $rights[] = $user_stat->rightchild;
            $rcount++;
        }

        while ($lefts) {
            $llevel++;
            $inner_left = array();

            $lcusers = array();
            $lcusers['user'] = array();
            foreach ($lefts as $luser) {

                if (!empty($user_name)) {
                    if ($luser->username == $user_name) {
                        return array("level" => $llevel);
                    }
                }
                $lcusers = $this->getLeftAndRightWithCount($luser);

                if (!empty($lcusers['user'])) {
                    $lcount += $lcusers['count'];
                    foreach ($lcusers['user'] as $lusr) {
                        $inner_left[] = $lusr;
                    }
                }
            }
            $lefts = $inner_left;
            $leftresults['level'][$llevel] = $lefts;

            // $lefts = $lcusers['user'];
        }
        $results['leftcount'] = $lcount;
        while ($rights) {
            $rlevel++;
            $inner_right = array();
            $rcusers = array();
            $rcusers['user'] = array();
            foreach ($rights as $ruser) {
                if (!empty($user_name)) {
                    if ($ruser->username == $user_name) {
                        return array("level" => $rlevel);
                    }
                }
                $rcusers = $this->getLeftAndRightWithCount($ruser);

                if (!empty($rcusers['user'])) {
                    $rcount += $rcusers['count'];
                    foreach ($rcusers['user'] as $rusr) {
                        $inner_right[] = $rusr;
                    }
                }
            }
            $rights = $inner_right;
            $rightresults['level'][$rlevel] = $rights;
        }


        $results['left'] = $leftresults;
        $results['right'] = $rightresults;
        $results['user_stat'] = $user_stat;
        $results['rightcount'] = $rcount;

        return $results;
    }

    public function calculateCommission($parent) {
        
    }

    public function getLastComissionCalculation($user_id) {
        
    }

    public static function getUserLeftAndRight($user_id) {

        if (!self::$instance) {
            self::$instance = new UtilityManager;
        }

        $res = self::$instance->getUserChild($user_id);
        // print_r($res['leftcount']);
        // print_r($res['rightcount']);
        return array("left" => $res['leftcount'], "right" => $res['rightcount'], 'user' => $res['user_stat']);
    }

    public static function getUserChildLevel($user_id, $child_user_name) {
        if (!self::$instance) {
            self::$instance = new UtilityManager;
        }

        $res = self::$instance->getUserChild($user_id, $child_user_name);

        if (isset($res['level'])) {
            return $res['level'];
        }
        return 0;
    }

    public static function getUserBalance($user_id) {


        $criteria = new CDbCriteria(array(
            'condition' => "user_id=" . $user_id,
            'order' => 'userbank_id DESC',
            'limit' => 1, // if offset less, thah 0 - it starts from the beginning
        ));
        $ubtotal = Userbank::model()->find($criteria);


        if (!empty($ubtotal->total)) {
            return $ubtotal->total;
        } else {

            return 0;
        }
    }

    public static function getUserPaidCommission($user_id, $stage = 1) {


        $criteria = new CDbCriteria(array(
            'condition' => "user_id=" . $user_id . " AND stage=$stage",
            'order' => 'commission_id DESC',
            'limit' => 1, // if offset less, thah 0 - it starts from the beginning
        ));
        $ctotal = Commission::model()->find($criteria);


        if (!empty($ctotal->count)) {
            return $ctotal->count;
        } else {

            return 0;
        }
    }

    public static function getUserRewardsByUserId($user_id) {

        $com = new Commission();
        $com->user_id = $user_id;
        $commission = $com->getComissionTotal();

        $redemption = Redemption::getRedemptionTotalForUser($user_id);

        return array('commission' => $commission, 'redemption' => $redemption);
    }

    public static function getUserCommissionBalance($user_id) {


        $criteria = new CDbCriteria(array(
            'condition' => "user_id=" . $user_id,
            'order' => 'commission_id DESC',
            'limit' => 1, // if offset less, thah 0 - it starts from the beginning
        ));
        $cmtotal = Commission::model()->find($criteria);


        if (!empty($cmtotal->total)) {
            return $cmtotal->total;
        } else {

            return 0;
        }
    }

    public static function number_format_unlimited_precision($number, $decimal = '.') {
        $broken_number = explode($decimal, $number);

        if (!isset($broken_number[1][1]))
            return $number;

        return number_format($broken_number[0]) . $decimal . $broken_number[1][0] . $broken_number[1][1];
    }

    public static function translate($inputStr, $from, $to) {

        // $fromtranslate['text'], $fromtranslate['lang'], strtolower($lang)
        try {


            //Client ID of the application.
            //$clientID     = "e6ecde25-ab08-4ab9-802c-1c55518c8ddf";
            //Client Secret key of the application.
            //$clientSecret = "23W1VOI7ze9fIeVJRZyNn7TZ5Mqno+wHJ7YuzaEI/XM=";
            //Client ID of the application.
            $clientID = "windowhotel";
            //Client Secret key of the application.
            $clientSecret = "KeYOHMFcf/DDIDY9Q8J/Uyfbye45Ts+2+IfaZC7M6IY=";
            //OAuth Url.
            $authUrl = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
            //Application Scope Url
            $scopeUrl = "http://api.microsofttranslator.com";
            //Application grant type
            $grantType = "client_credentials";

            //Create the AccessTokenAuthentication object.
            $authObj = new AccessTokenAuthentication();
            //Get the Access token.
            $accessToken = $authObj->getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
            //Create the authorization Header string.
            $authHeader = "Authorization: Bearer " . $accessToken;

            //Create the Translator Object.
            $translatorObj = new HTTPTranslator();

            //Input String.

            /*
              //HTTP Detect Method URL.
              $detectMethodUrl = "http://api.microsofttranslator.com/V2/Http.svc/Detect?text=".urlencode($inputStr);
              //Call the curlRequest.
              $strResponse = $translatorObj->curlRequest($detectMethodUrl, $authHeader);
              //Interprets a string of XML into an object.
              $xmlObj = simplexml_load_string($strResponse);

              print_r($xmlObj);


              foreach((array)$xmlObj[0] as $val){
              $languageCode = $val;
              }

              /*
             * Get the language Names from languageCodes.
             */
            $getLanguageNamesurl = "http://api.microsofttranslator.com/V2/Http.svc/Translate?from=$from&to=$to&text=" . urlencode($inputStr);

            //Create the Request XML format.
            // $requestXml = $translatorObj->createReqXML($languageCode);
            //Call the curlRequest.
            $curlResponse = $translatorObj->curlRequest($getLanguageNamesurl, $authHeader);

            //Interprets a string of XML into an object.
            $xmlObj = self::toArray(simplexml_load_string($curlResponse));

            if (!empty($xmlObj[0]))
                return $xmlObj[0];
            else
                return '';
            /*
              echo "<table border=2px>";
              echo "<tr>";
              echo "<td><b>LanguageCodes</b></td><td><b>Language Names</b></td>";
              echo "</tr>";
              foreach($xmlObj as $text){
              echo "<tr><td>  ".$inputStr."</td><td>". $to."(".$text.")"."</td></tr>";
              }
              echo "</table>";
             */
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . PHP_EOL;
        }
    }

    public static function sendEmail($email, $fullname, $subject, $message_body, $unlink = false) {
        //ini_set('max_execution_time', 600);

        if (Yii::app()->params['debug']) {
            $email = Yii::app()->params['adminEmail'];
            $fullname = Yii::app()->params['adminName'];
        }

        $contentType = 'text/html';
        $charset = 'utf-8';
        $message = new YiiMailMessage();
        $message->setTo(array($email => $fullname));
        $message->setFrom(array(Yii::app()->params['adminEmail'] => Yii::app()->params['adminName']));
        $message->setSubject($subject);

        $message->setBody($message_body, $contentType, $charset);
        Yii::log('sending email to ' . $email);

        try {
            Yii::app()->mail->send($message);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
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

    public static function getDiscountSavingCalculation($value, $discount_type, $discount) {

        /* TEST CASE:
         * value = 64
         * discount_type = percentage
         * discount = 55
         * result = 33
         */

        $discount_result = '';


        switch ($discount_type) {

            case self::COUPON_PERCENTAGE:
                $discount_result = $value * ($discount / 100);
                //$discount_result = sprintf("%01.2f",$discount_result);
                break;

            case self::COUPON_FIXED:
                $discount_result = $value - $discount;
                break;

            case self::COUPON_BONUS:
                $discount_result = $discount;
                break;
            default:break;
        }

        return $discount_result;
    }

    public static function getUploadDirectory($user_id, $category) {


        // make the directory to store the pic:
        if (!is_dir(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/" . $category)) {

            if (!is_dir(Yii::getPathOfAlias('webroot') . "/hotelimages/")) {
                mkdir(Yii::getPathOfAlias('webroot') . "/hotelimages/");
                chmod(Yii::getPathOfAlias('webroot') . "/hotelimages/", 0755);

                // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
            }
            if (!is_dir(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/")) {
                mkdir(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/");
                chmod(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/", 0755);
                // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
            }
            if (!is_dir(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/" . $category)) {
                mkdir(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/" . $category);
                chmod(Yii::getPathOfAlias('webroot') . "/hotelimages/$user_id/" . $category, 0755);
                // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
            }
        }
        return "/hotelimages/$user_id/" . $category;
    }

    public static function getSqlCurrentDate() {
        return date('Y-m-d H:i:s');
    }

    public static function getSqlAfterYearDate() {
        $date = date('Y-m-d H:i:s');
        return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($date)) . " +1 year"));
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
