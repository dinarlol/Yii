<?php

/**
 * This is the model class for table "ak_user_design".
 *
 * The followings are the available columns in table 'ak_user_design':
 * @property integer $id
 * @property integer $user_id
 * @property integer $design_technology_id
 * @property string $designer_inspired_by
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $user
 * @property DesignTechnology $designTechnology
 */
class UserDesign extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserDesign the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getCategoryId(){
		return Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_userDesignTechnology)))->id;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_user_design';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, design_technology_id', 'required'),
			array('user_id, design_technology_id', 'numerical', 'integerOnly'=>true),
			array('designer_inspired_by', 'length', 'max'=>45),
			array('create_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, design_technology_id, designer_inspired_by, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'designTechnology' => array(self::BELONGS_TO, 'DesignTechnology', 'design_technology_id'),
				'userRecomendation' => array(self::HAS_ONE, 'UserRecomendations', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
				'document_uploader' => array(self::HAS_MANY, 'DocumentUploader', 'category_pk_id','condition'=>'category_id='.self::getCategoryId()),
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
			'design_technology_id' => 'Design Technology',
			'designer_inspired_by' => 'Designer Inspired By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('design_technology_id',$this->design_technology_id);
		$criteria->compare('designer_inspired_by',$this->designer_inspired_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}