<?php

/**
 * This is the model class for table "t_commission".
 *
 * The followings are the available columns in table 't_commission':
 * @property integer $commission_id
 * @property integer $user_id
 * @property double $stage
 * @property integer $points
 * @property string $remarks
 * @property string $created_date
 * @property integer $count
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Commission extends XcodeModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Commission the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_commission';
    }
    
    public static function staticTableName() {
        return 't_commission';
    }

    
    public static function getComissionTotalForUser($user_id,$stage=1,$date=false) {

    if(empty($date)){
        return Yii::app()->db->createCommand("SELECT SUM(`points`)  FROM " . self::staticTableName() . " WHERE remarks NOT LIKE '%RMS%' AND stage=$stage AND user_id=$user_id")->queryScalar();
    }
    else {
        return Yii::app()->db->createCommand("SELECT SUM(`points`)  FROM " . self::staticTableName() . " WHERE remarks NOT LIKE '%RMS%' AND stage=$stage AND created_date > '$date' AND user_id=$user_id")->queryScalar();
    }
    
    }
    
    
    public static function getDailyComissionTotalForUser($user_id,$stage=1) {

        return Yii::app()->db->createCommand("SELECT SUM(`points`) as `sum` FROM " . self::staticTableName() . " WHERE created_date >= '".UtilityManager::getSqlYesterdayDate()."'  AND stage=$stage AND user_id=$user_id")->queryScalar();
    }

    public static function getComissionCountForUser($user_id,$stage=1,$date=false) {

        if(empty($date)){
        return Yii::app()->db->createCommand("SELECT count(`points`)  FROM " . self::staticTableName() . " WHERE remarks NOT LIKE '%RMS%' AND stage=$stage AND user_id=$user_id")->queryScalar();
    }
    else {
        return Yii::app()->db->createCommand("SELECT count(`points`)  FROM " . self::staticTableName() . " WHERE remarks NOT LIKE '%RMS%' AND stage=$stage AND created_date > '$date' AND user_id=$user_id")->queryScalar();
    }
    
    }

    
    public static function getAllComissionCountForUser($user_id) {

        return Yii::app()->db->createCommand("SELECT count(`points`)  FROM " . self::staticTableName() . " WHERE remarks NOT LIKE '%RMS%' AND user_id=$user_id")->queryScalar();
    
    }
    
    public function getComissionTotal() {
        if (!empty($this->user_id))
            return Yii::app()->db->createCommand("SELECT SUM(`points`) as `sum` FROM " . $this->tableName() . " WHERE user_id =" . $this->user_id)->queryScalar()." AND created_date < '".UtilityManager::getSqlTodayDateOnly()."'";
    }
    
    
     public static function getRmsStage($user_id) {

        return Yii::app()->db->createCommand("SELECT stage  FROM " . self::staticTableName() . " WHERE remarks NOT LIKE '%RMS%' AND user_id=$user_id")->queryScalar();
    
    }
    public function getRmsTotal() {
        if (!empty($this->user_id))
            return Yii::app()->db->createCommand("SELECT SUM(`points`) as `sum` FROM " . $this->tableName() . " WHERE remarks LIKE '%RMS%' AND user_id =" . $this->user_id)->queryScalar();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, points, remarks', 'required'),
            array('user_id, stage, count', 'numerical', 'integerOnly' => true),
             array('points', 'numerical'),
            array('created_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('commission_id, user_id, stage, points, remarks, created_date, count', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'commission_id' => 'Commission',
            'user_id' => 'User',
            'stage' => 'Stage',
            'points' => 'Points',
            'remarks' => 'Remarks',
            'created_date' => 'Created Date',
            'count' => 'Count',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('commission_id', $this->commission_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('stage', $this->stage);
        $criteria->compare('points', $this->points);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('count', $this->count);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}