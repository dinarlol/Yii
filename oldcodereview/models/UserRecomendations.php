<?php

/**
 * This is the model class for table "ak_user_recomendations".
 *
 * The followings are the available columns in table 'ak_user_recomendations':
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $recomender_id
 * @property string $create_date
 * @property string $modified_date
 * @property string $comments
 * @property integer $category_pk_id
 * @property integer $show
 */
class UserRecomendations extends CActiveRecord
{
	
	public $userRole = 'USER';
	public $companyRole = 'COMPANY';
	public $adminRole = 'ADMIN';
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserRecomendations the static model class
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
		return 'ak_user_recomendations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, category_id, recomender_id, create_date, modified_date, comments, category_pk_id', 'required'),
			array('user_id, category_id, recomender_id, category_pk_id, show', 'numerical', 'integerOnly'=>true),
			array('comments', 'length', 'max'=>99),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, category_id, recomender_id, create_date, modified_date, comments, category_pk_id, show', 'safe', 'on'=>'search'),
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
				'user' => array(self::BELONGS_TO, 'Person', 'user_id','alias'=>'person'),
				'recomender' => array(self::BELONGS_TO, 'Person', 'recomender_id'),
				'category' => array(self::BELONGS_TO, 'Category', 'category_id','alias'=>'cat'),
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
			'category_id' => 'Category',
			'recomender_id' => 'Recomender',
			'create_date' => 'Create Date',
			'modified_date' => 'Modified Date',
			'comments' => 'Comments',
			'category_pk_id' => 'Sub Category',
			'show' => 'Show',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($order ='t.id DESC',$pageSize=3)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		//$criteria->with = array('category', 'workexperience'=>array('condition'=>'cat.id=1'),);
		//$criteria->addCondition("cat.id=2",'OR');// = array('academic'=>array('condition'=>'cat.id=2'),);
		$criteria->group = 't.id';
		$criteria->compare('category.id',$this->category_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('recomender_id',$this->recomender_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('category_pk_id',$this->category_pk_id);
		$criteria->order =$order;
		$criteria->together = false;

		return new CActiveDataProvider($this, array(
				'pagination'=>array(
				//
				// please check how we get the
				// the pageSize from user's state
						'pageSize'=> $pageSize,
				
						//
				// we have previously set defaultPageSize
				// on the params section of our main.php config file
				//Yii::app()->params['defaultPageSize']),
				),
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function getCriteria()
	{
		$criteria=new CDbCriteria;
	
		$criteria->compare('workexperience.category_id',$this->category_id,true,"OR");
		$criteria->compare('category.id',$this->category_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('recomender_id',$this->recomender_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('category_pk_id',$this->category_pk_id);
		$criteria->order ='t.id DESC';
	
		return $criteria;
	}
	
}