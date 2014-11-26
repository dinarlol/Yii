<?php

/**
 * This is the model class for table "ak_user".
 *
 * The followings are the available columns in table 'ak_user':
 * @property integer $id
 * @property integer $group_id
 * @property integer $role_id
 * @property string $email
 * @property string $password
 * @property string $status
 * @property string $lng
 * @property string $lat
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Company[] $companys
 * @property Group $group
 * @property Roles $role
 */
class Employer extends Person
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employer the static model class
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
		return 'ak_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, role_id, email, password, status, create_date, modified_date', 'required'),
			array('group_id, role_id', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>75),
			array('password', 'length', 'max'=>95),
			array('status', 'length', 'max'=>9),
			array('lng, lat', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, role_id, email, password, status, lng, lat, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'company' => array(self::HAS_ONE, 'Company', 'user_id'),
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Group',
			'role_id' => 'Role',
			'email' => 'Email',
			'password' => 'Password',
			'status' => 'Status',
			'lng' => 'Lng',
			'lat' => 'Lat',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
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
		//$criteria->limit = 10;
		$criteria->with = array('role','company','company.companyDetails','company.industry');
		$criteria->group = 'company.id';
		$criteria->compare('role.name',$this->companyRole,true);
		$criteria->compare('company.name',$this->keyword,true,"OR");
		$criteria->compare('companyDetails.country',$this->keyword,true,"OR");
		$criteria->compare('companyDetails.state',$this->keyword,true,"OR");
		$criteria->compare('companyDetails.city',$this->keyword,true,"OR");
		$criteria->compare('industry.name',$this->keyword,true,"OR");
		$criteria->together=true;

		//$criteria->compare('city',$this->address,true,"OR");

		/*
		 $criteria->compare('id',$this->id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		*/		$sort = new CSort;
		$sort->attributes = array(
				'company.name' => array(
						'asc' => 'company.name, email',
						'desc' => 'company.name DESC, email DESC',
				),
				'*',
				'companyDetails.country' => array(
						'asc' => 'companyDetails.country, email',
						'desc' => 'companyDetails.countryC, email DESC',
				),
				'*',
				'companyDetails.cityl' => array(
						'asc' => 'companyDetails.city, email',
						'desc' => 'companyDetails.city DESC, email DESC',
				),
				'*',
		);
		return new CActiveDataProvider(get_class($this), array(
				'pagination'=>array(
				//
				// please check how we get the
				// the pageSize from user's state
						'pageSize'=> '5',
						//
				// we have previously set defaultPageSize
				// on the params section of our main.php config file
								//Yii::app()->params['defaultPageSize']),
				),
				'criteria'=>$criteria,
				'sort'=>$sort,
		));
		
	}
}