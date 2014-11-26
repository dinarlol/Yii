<?php

/**
 * This is the model class for table "ak_users_site_matrics".
 *
 * The followings are the available columns in table 'ak_users_site_matrics':
 * @property integer $id
 * @property string $visitor_user_id
 * @property string $owner_user_id
 * @property string $location
 * @property string $create_date
 * @property string $activity_id
 */
class UsersSiteMatrics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UsersSiteMatrics the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_users_site_matrics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('visitor_user_id, owner_user_id, location, create_date, activity_id', 'required'),
				array('visitor_user_id, owner_user_id, activity_id', 'length', 'max'=>14),
				array('location', 'length', 'max'=>77),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, visitor_user_id, owner_user_id, location, create_date, activity_id', 'safe', 'on'=>'search'),
		);
	}



	public function beforeSave(){
		if(Yii::app()->user->isCompany){
			$company = Company::model()->find('user_id=?',array(Yii::app()->user->id));
			if(!empty($company->companyDetails)){
				$this->location = $company->companyDetails->city;
			}
		}
		else if(Yii::app()->user->isUser){
			$user = UserDetails::model()->find('user_id=?',array(Yii::app()->user->id));
			if(!empty($user)){
				$this->location = $user->city;
			}
		}
		else{
			//exit;
		}

		return true;

	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'activity' => array(self::BELONGS_TO, 'UsersActivity', 'activity_id'),
				'owner' => array(self::BELONGS_TO, 'Person', 'owner_user_id'),
				'visitor' => array(self::BELONGS_TO, 'Person', 'visitor_user_id','group'=>'visitor.id'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'visitor_user_id' => 'Visitor User',
				'owner_user_id' => 'Owner User',
				'location' => 'Location',
				'create_date' => 'Create Date',
				'activity_id' => 'Activity',
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
		$criteria->compare('visitor_user_id',$this->visitor_user_id,true);
		$criteria->compare('owner_user_id',$this->owner_user_id,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('activity_id',$this->activity_id,true);

		return new CActiveDataProvider($this, array(
				'pagination'=>array(
						//
						// please check how we get the
						// the pageSize from user's state
						'pageSize'=> '7',

						//
						// we have previously set defaultPageSize
						// on the params section of our main.php config file
						//Yii::app()->params['defaultPageSize']),
				),
				'criteria'=>$criteria,
		));
	}
}