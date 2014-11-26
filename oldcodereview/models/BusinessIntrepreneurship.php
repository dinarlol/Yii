<?php

/**
 * This is the model class for table "ak_business_intrepreneurship".
 *
 * The followings are the available columns in table 'ak_business_intrepreneurship':
 * @property string $id
 * @property integer $user_id
 * @property string $name
 * @property string $upload_work
 * @property string $relevant_business_projects
 * @property string $create_date
 * @property string $modified_date
 * @property string $ventures
 * @property string $link
 * @property string $inspiredby
 *
 * The followings are the available model relations:
 * @property User $user
 */
class BusinessIntrepreneurship extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BusinessIntrepreneurship the static model class
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
		return 'ak_business_intrepreneurship';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, create_date, modified_date', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('upload_work, relevant_business_projects', 'length', 'max'=>77),
			array('ventures, inspiredby', 'length', 'max'=>77),
			array('link', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id,  upload_work, relevant_business_projects, create_date, modified_date, ventures, link, inspiredby', 'safe', 'on'=>'search'),
		);
	}

	public static function getCategoryId(){
		return Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_businessIntrepreneurships)))->id;
	}


public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'ventures' => 'Ventures',
				'link' => 'link to website',
				'inspiredby' =>'inspires you?',
				'upload' =>'Upload your work',
				'relevant_business_projects' => 'Relevant Business Projects',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('upload_work',$this->upload_work,true);
		$criteria->compare('relevant_business_projects',$this->relevant_business_projects,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('ventures',$this->ventures,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('inspiredby',$this->inspiredby,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}