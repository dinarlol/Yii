<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

$message = $params['message'];
//$var_dump($params);
//echo 'testscript';


$numsent = Yii::app()->mail->send($message);



?>


