<?php

/**
 * This is the model class for table "t_redemption".
 *
 * The followings are the available columns in table 't_redemption':
 * @property integer $id
 * @property integer $user_id
 * @property string $points
 * @property string $status
 * @property string $created_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Redemption extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_redemption';
    }
    
     public static function staticTableName() {
        return 't_redemption';
    }
    
    
    public static function getRedemptionTotalForUser($user_id) {

       return Yii::app()->db->createCommand("SELECT SUM(`points`) as `sum` FROM " . self::staticTableName() . " WHERE user_id=$user_id")->queryScalar();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, points, modified_date', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('points, status', 'length', 'max' => 100),
            array('created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, points, status, created_date, modified_date', 'safe', 'on' => 'search'),
        );
    }

    public function getRedemptionTotal() {

        if (!empty($this->user_id))
            return Yii::app()->db->createCommand("SELECT SUM(`points`) as `sum` FROM " . $this->tableName() . " WHERE user_id =" . $this->user_id)->queryScalar();
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
            'id' => 'ID',
            'user_id' => 'User',
            'points' => 'Points',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('points', $this->points, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('modified_date', $this->modified_date, true); 
        $criteria->order = 'id DESC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Redemption the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
