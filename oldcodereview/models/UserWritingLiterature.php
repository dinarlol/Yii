<?php

/**
 * This is the model class for table "ak_user_writing_literature".
 *
 * The followings are the available columns in table 'ak_user_writing_literature':
 * @property integer $id
 * @property integer $user_id
 * @property string $writer_inspired_by
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserWritingLiterature extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserWritingLiterature the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getCategoryId(){
		return Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_userWritingLiterature)))->id;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_user_writing_literature';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,writer_inspired_by', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('writer_inspired_by', 'length', 'max'=>99),
			array('create_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, writer_inspired_by, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Person', 'user_id'),
			'userReadBooks' => array(self::HAS_MANY, 'UserReadBooks', 'category_pk_id'),
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
			'writer_inspired_by' => 'What writer inspire you?',
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
		$criteria->compare('writer_inspired_by',$this->writer_inspired_by,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}