<?php

/**
 * This is the model class for table "ak_user_mail_box_drafts".
 *
 * The followings are the available columns in table 'ak_user_mail_box_drafts':
 * @property string $id
 * @property string $subject
 * @property string $message
 * @property string $create_date
 * @property integer $senderUserId
 * @property integer $receiverUserId
 * @property integer $isRead
 * @property integer $sender_deleted
 * @property integer $
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $senderUser
 */
class UserMailBoxDrafts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserMailBoxDrafts the static model class
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
		return 'ak_user_mail_box_drafts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, message, create_date, senderUserId,  modified_date', 'required'),
			array('senderUserId, receiverUserId, isRead, sender_deleted, ', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>55),
			array('message', 'length', 'max'=>810),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, message, create_date, senderUserId, receiverUserId, isRead, sender_deleted, , modified_date', 'safe', 'on'=>'search'),
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
			'senderUser' => array(self::BELONGS_TO, 'User', 'senderUserId'),
				'receiverUser' => array(self::BELONGS_TO, 'User', 'receiverUserId'),
		);
	}
	
	public function markAsRead() {
		if (!$this->isRead) {
			$this->isRead = true;
			$this->save();
		}
	}
	
	public function getReceiverName() {
		if (!empty($this->receiverUser)) {
			return $this->receiverUser->getFullName();
		}
	}
	public static function getAdapterForDraft($userId) {
		$c = new CDbCriteria();
		$c->addCondition('t.senderUserId = :senderUserId');
		$c->addCondition('t.sender_deleted = 0');
		$c->order = 't.create_date DESC';
		$c->params = array(
				'senderUserId' => $userId,
	
		);
		$messagesProvider = new CActiveDataProvider('UserMailBoxDrafts', array('criteria' => $c));
		return $messagesProvider;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'message' => 'Message',
			'create_date' => 'Create Date',
			'senderUserId' => 'From',
			'receiverUserId' => 'To',
			'isRead' => 'Is Read',
			'sender_deleted' => 'Deleted',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('senderUserId',$this->senderUserId);
		$criteria->compare('receiverUserId',$this->receiverUserId);
		$criteria->compare('isRead',$this->isRead);
		$criteria->compare('sender_deleted',$this->sender_deleted);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}