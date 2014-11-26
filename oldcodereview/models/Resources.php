<?php

/**
 * This is the model class for table "ak_resources".
 *
 * The followings are the available columns in table 'ak_resources':
 * @property integer $id
 * @property string $module_name
 * @property string $controller_name
 * @property string $action_name
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property RoleResource[] $roleResources
 */
class Resources extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Resources the static model class
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
		return 'ak_resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_name, controller_name, action_name, create_date', 'required'),
			array('module_name, controller_name, action_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, module_name, controller_name, action_name, create_date', 'safe', 'on'=>'search'),
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
			'roleResources' => array(self::HAS_MANY, 'RoleResource', 'resource_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'module_name' => 'Module Name',
			'controller_name' => 'Controller Name',
			'action_name' => 'Action Name',
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
		$criteria->compare('module_name',$this->module_name,true);
		$criteria->compare('controller_name',$this->controller_name,true);
		$criteria->compare('action_name',$this->action_name,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}