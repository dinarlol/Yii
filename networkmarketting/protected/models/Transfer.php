<?php

/**
 * This is the model class for table "t_transfer".
 *
 * The followings are the available columns in table 't_transfer':
 * @property integer $id
 * @property integer $transfer_user_id
 * @property integer $reciever_user_id
 * @property string $points
 * @property string $reference
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Users $recieverUser
 * @property Users $transferUser
 */
class Transfer extends XcodeModel
{
    public $user_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_transfer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transfer_user_id, reciever_user_id, points, reference', 'required'),
			array('transfer_user_id, reciever_user_id', 'numerical', 'integerOnly'=>true),
			array('points', 'length', 'max'=>100),
			array('reference', 'length', 'max'=>200),
			array('created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, transfer_user_id, reciever_user_id, points, reference, created_date', 'safe', 'on'=>'search'),
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
			'recieverUser' => array(self::BELONGS_TO, 'Users', 'reciever_user_id'),
			'transferUser' => array(self::BELONGS_TO, 'Users', 'transfer_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transfer_user_id' => 'Transfer User',
			'reciever_user_id' => 'Reciever User',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('transfer_user_id',$this->transfer_user_id);
		$criteria->compare('reciever_user_id',$this->reciever_user_id);
		$criteria->compare('points',$this->points,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transfer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
