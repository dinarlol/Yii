<?php

/**
 * This is the model class for table "ak_job_recommendations".
 *
 * The followings are the available columns in table 'ak_job_recommendations':
 * @property integer $id
 * @property integer $user_group_id
 * @property integer $job_id
 * @property integer $recommender_id
 * @property integer $user_id
 * @property string $comments
 * @property integer $show
 * @property string $recommender_name
 * @property string $recommender_current_position
 * @property string $recommender_email
 * @property string $known_recommender_as
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property PostJob $job
 * @property User $recommender
 * @property Group $userGroup
 * @property User $user
 */
class JobRecommendations extends CActiveRecord
{
	public $externalRecommendedUser; 
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobRecommendations the static model class
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
		return 'ak_job_recommendations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_group_id, job_id, user_id, comments, recommender_name, recommender_current_position, known_recommender_as, create_date, modified_date', 'required'),
			array('user_group_id, job_id, recommender_id, user_id, show', 'numerical', 'integerOnly'=>true),
			array('comments', 'length', 'max'=>99),
			array('recommender_name, recommender_current_position', 'length', 'max'=>77),
			array('recommender_email', 'length', 'max'=>75),
			array('known_recommender_as', 'length', 'max'=>55),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_group_id, job_id, recommender_id, user_id, comments, show, recommender_name, recommender_current_position, recommender_email, known_recommender_as, create_date, modified_date', 'safe', 'on'=>'search'),
		);
	}
	
	
	
	public function afterSave(){
	
		$subject = "Job Recommendation - Akimbo";
		$body = '
		<html>
		<head>
		<title>Job Recommendation</title>
		<style>
		body {
		color: #8BB3DA;
		]
		</style>
		</head>
		<body style="background-color: #161616;">
		<div style="margin-left: 10%; margin-top: 5%; background-color: #191919; color: #8BB3DA; width: 600px; overflow: none;">
		<h1>Hello '. $this->recommender_name.',</h1><br/><br/>
	
		Akimbo had recieved a request from '.$this->user->getFullName().' ('.$this->comments.') for '.$this->job->jobCategory->name.' job .
	
		Please check job <a href="'. $this->job->id.'"> '.$this->job->job_title.' </a>
		if you want to apply. <br/><br/>
	
		If the above link doesnt work please copy and past the url in browser
		'. $this->job->job_description .'<br/><br/>
	
		Best regards,<br/>
		AKIMBO TEAM
		Web Administration
		</div>
		</body>
		</html>
		';
		$contentType = 'text/html';
		$charset='iso-8859-1';
		$message = new YiiMailMessage();
	
		$message->setTo(
				array($this->recommender_email=>$this->recommender_name));
		$message->setFrom(array(Yii::app()->params['adminEmail']=>Yii::app()->params['company']));
		$message->setSubject($subject);
		$message->setBody($body,$contentType,$charset);
		Yii::log(' Mail sending now for job recommendation to '.$this->recommender_name);
		ERunActions::runScript('jobrecommendationscript',array('message'=>$message)) ;
		Yii::log(' Mail sented for job recommendation to '.$this->recommender_name);
	
		return true;
	}
	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'job' => array(self::BELONGS_TO, 'PostJob', 'job_id'),
			'recommender' => array(self::BELONGS_TO, 'User', 'recommender_id'),
			'userGroup' => array(self::BELONGS_TO, 'Group', 'user_group_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'user_group_id' => 'User Group',
				'job_id' => 'Job',
				'recommender_id' => 'Recommender',
				'user_id' => 'User',
				'comments' => 'Comments',
				'show' => 'Show',
				'recommender_name' => 'Candidate name',
				'recommender_current_position' => 'Candidate Current Position',
				'recommender_email' => 'Recommender Email',
				'known_recommender_as' => 'How do you know candidate?',
				'create_date' => 'Create Date',
				'modified_date' => 'Modified Date',
				'externalRecommendedUser' => 'Candidate full name',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_group_id',$this->user_group_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('recommender_id',$this->recommender_id);
		//$criteria->compare('user_id',$this->user_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('t.show',$this->show);
		$criteria->compare('recommender_name',$this->recommender_name,true);
		$criteria->compare('recommender_current_position',$this->recommender_current_position,true);
		$criteria->compare('recommender_email',$this->recommender_email,true);
		$criteria->compare('known_recommender_as',$this->known_recommender_as,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
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
	
	public function getCriteria()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('recommender_id',$this->recommender_id);
		//$criteria->compare('user_id',$this->user_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('t.show',$this->show);
		$criteria->compare('recommender_name',$this->recommender_name,true);
		$criteria->compare('recommender_current_position',$this->recommender_current_position,true);
		$criteria->compare('recommender_email',$this->recommender_email,true);
	
		return $criteria;
	}
	
}