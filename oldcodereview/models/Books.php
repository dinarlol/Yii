<?php

/**
 * This is the model class for table "ak_books".
 *
 * The followings are the available columns in table 'ak_books':
 * @property string $id
 * @property string $name
 * @property string $author
 * @property string $isbn
 * @property string $small_thumbnail
 * @property string $thumbnail
 * @property string $create_date
 * @property string $modified_date
 */
class Books extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Books the static model class
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
		return 'ak_books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, author, isbn, small_thumbnail, thumbnail, create_date, modified_date', 'required'),
			array('name, author, isbn', 'length', 'max'=>75),
			array('small_thumbnail, thumbnail', 'length', 'max'=>277),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, author, isbn, small_thumbnail, thumbnail, create_date, modified_date', 'safe', 'on'=>'search'),
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
				'userReadBooks' => array(self::HAS_MANY, 'UserReadBooks', 'book_id'),
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
			'author' => 'Author',
			'isbn' => 'Books i read',
			'small_thumbnail' => 'Small Thumbnail',
			'thumbnail' => 'Thumbnail',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('small_thumbnail',$this->small_thumbnail,true);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}