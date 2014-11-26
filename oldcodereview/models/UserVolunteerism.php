<?php

/**
 * This is the model class for table "ak_user_volunteerism".
 *
 * The followings are the available columns in table 'ak_user_volunteerism':
 * @property integer $id
 * @property integer $user_id
 * @property string $cause
 * @property string $start_date
 * @property string $end_date
 * @property string $impact
 * @property string $create_date
 * @property string $modified_date
 * @property integer $non_profit_causes_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property UserVolunteerismDetail[] $userVolunteerismDetails
 */
class UserVolunteerism extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserVolunteerism the static model class
	 */
         
        public $organization;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_user_volunteerism';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('user_id,organization,start_date, end_date, create_date, modified_date, non_profit_causes_id', 'required'),
                    array('user_id, non_profit_causes_id', 'numerical', 'integerOnly'=>true),
                    array('cause, end_date', 'length', 'max'=>255),
                    array('impact', 'length', 'max'=>145),
                    array('mycauses','length','max'=>300),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, user_id, cause, start_date, end_date, impact, create_date, modified_date, mycauses,
                                non_profit_causes_id','safe', 'on'=>'search'),
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
                        'organizations' => array(self::BELONGS_TO, 'NonprofitOrganizations', 'organization_id'),
			'user' => array(self::BELONGS_TO, 'Person', 'user_id'),
			'userVolunteerismDetails' => array(self::HAS_MANY, 'UserVolunteerismDetail', 'volunteerism_id'),
                        
				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'cause' => 'Cause',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'impact' => 'Impact',
                        'mycauses'=>'My Causes',
                        'organization'=>'Organization',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'non_profit_causes_id' => 'Non Profit Causes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('cause',$this->cause,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('impact',$this->impact,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('non_profit_causes_id',$this->non_profit_causes_id);
                $criteria->compare('mycauses',$this->mycauses);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
       
       
}