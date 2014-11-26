<?php

/**
 * This is the model class for table "ak_nonprofit_organizations_causes".
 *
 * The followings are the available columns in table 'ak_nonprofit_organizations_causes':
 * @property integer $id
 * @property integer $non_profit_causes_id
 * @property integer $nonprofit_organizations_id
 */
class NonprofitOrganizationsCauses extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NonprofitOrganizationsCauses the static model class
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
		return 'ak_nonprofit_organizations_causes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('non_profit_causes_id, nonprofit_organizations_id', 'required'),
			array('non_profit_causes_id, nonprofit_organizations_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, non_profit_causes_id, nonprofit_organizations_id', 'safe', 'on'=>'search'),
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
				'userVolunteerismDetail' => array(self::BELONGS_TO, 'UserVolunteerismDetail', 'nonprofit_organizations_causes_id'),
				'nonprofitCauses' => array(self::HAS_ONE, 'NonprofitCauses', 'id'),
				'nonprofitOrganization' => array(self::HAS_ONE, 'NonprofitOrganizations', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'non_profit_causes_id' => 'Non Profit Causes',
			'nonprofit_organizations_id' => 'Nonprofit Organizations',
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
		$criteria->compare('non_profit_causes_id',$this->non_profit_causes_id);
		$criteria->compare('nonprofit_organizations_id',$this->nonprofit_organizations_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}