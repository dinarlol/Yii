<?php

/**
 * This is the model class for table "ak_roles".
 *
 * The followings are the available columns in table 'ak_roles':
 * @property integer $id
 * @property string $name
 * @property integer $group_id
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property RoleResource[] $roleResources
 * @property Group $group
 * @property User[] $users
 */
class Roles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Sets the default values
	 * @see CActiveRecord::init()
	 */
	public function init(){
		$date = date('Y-m-d H:i:s');
		$this->create_date = $date;
	}
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, group_id', 'required'),
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, group_id, create_date', 'safe', 'on'=>'search'),
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
			'roleResources' => array(self::HAS_MANY, 'RoleResource', 'role_id'),
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'users' => array(self::HAS_MANY, 'User', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'group_id' => 'Group',
			'create_date' => 'Create Date',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}