<?php

/**
 * This is the model class for table "t_bank".
 *
 * The followings are the available columns in table 't_bank':
 * @property integer $bank_id
 * @property string $points
 * @property string $reference
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Userbank[] $userbanks
 */
class Bank extends XcodeModel
{
public $uid;
public $user_name;
/**
 * @return string the associated database table name
 */
public function tableName()
{
return 't_bank';
}

public function afterSave() {



$criteria = new CDbCriteria(array(
'condition' => "user_id=".$this->uid,
 'order' => 'bank_id DESC',
 'limit' => 1, // if offset less, thah 0 - it starts from the beginning
));


$uBank = new Userbank();
$uBank->total = $this->points;
$uBank->points = $this->points;
$uBank->transaction_type = Controller::$bank_transaction_type;
$uBank->created_date = UtilityManager::getSqlCurrentDate();
$uBank->bank_id = $this->bank_id;
$uBank->user_id = $this->uid;

$ubtotal = Userbank::model()->find($criteria);

if(!empty($ubtotal)){
if(!empty($ubtotal->total)){
$uBank->total += $this->points;
}
}



$uBank->save();

//print_r($uBank);
//exit;

return parent::afterSave();
}

/**
 * @return array validation rules for model attributes.
 */
public function rules()
{
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
return array(
array('points', 'required'),
array('uid,bank_id', 'numerical'),
 array('points, reference', 'length', 'max' => 100),
 // The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('bank_id, points, reference, created_date', 'safe', 'on' => 'search'),
);
}

/**
 * @return array relational rules.
 */
public function relations()
{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
return array(
'userbanks' => array(self::HAS_MANY, 'Userbank', 'bank_id'),
);
}

/**
 * @return array customized attribute labels (name=>label)
 */
public function attributeLabels()
{
return array(
'bank_id' => 'Bank',
 'points' => 'Points',
 'reference' => 'Reference',
 'created_date' => 'Created Date',
);
}

/**
 * Retrieves a list of models based on the current search/filter conditions.
 *
 * Typical usecase:
 * - Initialize the model fields with values from filter form.
 * - Execute this method to get CActiveDataProvider instance which will filter
 * models according to data in model fields.
 * - Pass data provider to CGridView, CListView or any similar widget.
 *
 * @return CActiveDataProvider the data provider that can return the models
 * based on the search/filter conditions.
 */
public function search()
{
// @todo Please modify the following code to remove attributes that should not be searched.

$criteria = new CDbCriteria;

$criteria->compare('bank_id', $this->bank_id);
$criteria->compare('points', $this->points, true);
$criteria->compare('reference', $this->reference, true);
$criteria->compare('created_date', $this->created_date, true);

return new CActiveDataProvider($this, array(
'criteria' => $criteria,
));
}

/**
 * Returns the static model of the specified AR class.
 * Please note that you should have this exact method in all your CActiveRecord descendants!
 * @param string $className active record class name.
 * @return Bank the static model class
 */
public static function model($className = __CLASS__)
{
return parent::model($className);
}
}
