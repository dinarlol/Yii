<?php

/**
 * This is the model class for table "t_userbank".
 *
 * The followings are the available columns in table 't_userbank':
 * @property integer $userbank_id
 * @property string $points
 * @property string $transaction_type
 * @property string $created_date
 * @property string $total
 * @property integer $bank_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Bank $bank
 */
class Userbank extends XcodeModel
{

public $user_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_userbank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('points, user_id', 'required'),
			array('bank_id, user_id', 'numerical', 'integerOnly'=>true),
			array('points, transaction_type, total', 'length', 'max'=>100),
			array('user_name', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userbank_id,user_name, points, transaction_type, created_date, total, bank_id, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'bank' => array(self::BELONGS_TO, 'Bank', 'bank_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userbank_id' => 'Userbank',
			'points' => 'Points',
			'transaction_type' => 'Transaction Type',
			'created_date' => 'Created Date',
			'total' => 'Total',
			'bank_id' => 'Bank',
			'user_id' => 'User',
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

		$criteria->compare('userbank_id',$this->userbank_id);
		$criteria->compare('points',$this->points,true);
		$criteria->compare('transaction_type',$this->transaction_type,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('user_id',$this->user_id);
                $criteria->order = 'userbank_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userbank the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
