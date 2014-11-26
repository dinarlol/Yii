<?php

/**
 * This is the model class for table "t_leftrigtbonus".
 *
 * The followings are the available columns in table 't_leftrigtbonus':
 * @property integer $bonus_id
 * @property integer $user_id
 * @property integer $left_id
 * @property integer $right_id
 *
 * The followings are the available model relations:
 * @property Users $right
 * @property Users $left
 * @property Users $user
 */
class Leftrigtbonus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_leftrigtbonus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, left_id, right_id', 'required'),
			array('user_id, left_id, right_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bonus_id, user_id, left_id, right_id', 'safe', 'on'=>'search'),
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
			'right' => array(self::BELONGS_TO, 'Users', 'right_id'),
			'left' => array(self::BELONGS_TO, 'Users', 'left_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bonus_id' => 'Bonus',
			'user_id' => 'User',
			'left_id' => 'Left',
			'right_id' => 'Right',
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

		$criteria=new CDbCriteria;

		$criteria->compare('bonus_id',$this->bonus_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('left_id',$this->left_id);
		$criteria->compare('right_id',$this->right_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Leftrigtbonus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
