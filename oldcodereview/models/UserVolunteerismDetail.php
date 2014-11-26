<?php

/**
 * This is the model class for table "ak_user_volunteerism_detail".
 *
 * The followings are the available columns in table 'ak_user_volunteerism_detail':
 * @property integer $id
 * @property integer $volunteerism_id
 * @property string $photo
 * @property string $link
 * @property string $create_date
 * @property string $modified_date
 * @property integer $nonprofit_organizations_causes_id
 *
 * The followings are the available model relations:
 * @property UserVolunteerism $volunteerism
 */
class UserVolunteerismDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserVolunteerismDetail the static model class
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
		return 'ak_user_volunteerism_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('volunteerism_id, create_date, modified_date, nonprofit_organizations_causes_id', 'required'),
			array('volunteerism_id, nonprofit_organizations_causes_id', 'numerical', 'integerOnly'=>true),
			array('photo, link', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, volunteerism_id, photo, link, create_date, modified_date, nonprofit_organizations_causes_id', 'safe', 'on'=>'search'),
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
			'volunteerism' => array(self::BELONGS_TO, 'UserVolunteerism', 'volunteerism_id'),
				'nonprofitOrganizationCauses' => array(self::HAS_ONE, 'NonprofitOrganizationsCauses', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'volunteerism_id' => 'Volunteerism',
			'photo' => 'Photo',
			'link' => 'Link',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'nonprofit_organizations_causes_id' => 'Nonprofit Organizations Causes',
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
		$criteria->compare('volunteerism_id',$this->volunteerism_id);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('nonprofit_organizations_causes_id',$this->nonprofit_organizations_causes_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}