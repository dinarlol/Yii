<?php

/**
 * This is the model class for table "ak_user_about_me".
 *
 * The followings are the available columns in table 'ak_user_about_me':
 * @property integer $id
 * @property integer $user_id
 * @property string $objective
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserAboutMe extends AkimboRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserAboutMe the static model class
	 */
    
        public $interest;
        public $industry; 
        
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
            return 'ak_user_about_me';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, objective, create_date, modified_date','required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('objective', 'length', 'max'=>145),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, objective,interest,create_date, modified_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID','user_id' => 'User','objective' => 'Objective','interest' => 'Interest',
                        'industry' => 'Industry','create_date' => 'Create Date','modified_date' => 'Modified Date',
                    
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
		$criteria->compare('objective',$this->objective,true);
                $criteria->compare('interest',$this->interest,true);
                $criteria->compare('industry',$this->industry,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function beforeSave() {
                
            $this->create_date = date('Y-m-d H:i:s');
            $this->modified_date = date('Y-m-d H:i:s');
                
            return true;
            
        }
        
        public function save($runValidation = true, $attributes = null) {
            
            $rowExist = $this->exists("user_id = :user_id ",array(':user_id'=>Yii::app()->user->getId()));
                        
            if($rowExist)
            {
                $this->updateAll(array("objective"=>$this->objective,"modified_date"=>date('Y-m-d H:i:s')),
                                        "user_id = '".Yii::app()->user->getId()."'");
                
            }else{
                parent::save();
                $sql = "insert into ak_user_hobbies (`user_id`,`name`,`create_date`,`modified_date`) 
                                    values (:user_id,:name,:create_date,:modified_date)";
                
                for($i=0; $i<count($_POST['UserAboutMe']['interest']); $i++)
                {
                                
                        $parameters = array(":user_id"=>$this->user_id,":name"=>$_POST["UserAboutMe"]["interest"][$i],
                                            ":create_date"=>date('Y-m-d H:i:s'),":modified_date"=>date('Y-m-d H:i:s'));
                        Yii::app()->db->createCommand($sql)->execute($parameters);
                }
                
            }
            // insert hobbies 
            $sql = "insert into ak_user_hobbies (`user_id`,`name`,`create_date`,`modified_date`) 
                                values (:user_id,:name,:create_date,:modified_date)";

            for($i=0; $i<count($_POST['UserAboutMe']['interest']); $i++)
            {
                    if(!empty($_POST["UserAboutMe"]["interest"][$i])){        
                        
                        $hobbyExist = UserHobbies::model()->exists("user_id = :user_id AND name = :name",
                                array(":user_id"=>$this->user_id, ":name"=>$_POST["UserAboutMe"]["interest"][$i])); 
                        
                        if(!$hobbyExist){
                            $parameters = array(":user_id"=>$this->user_id,":name"=>$_POST["UserAboutMe"]["interest"][$i],
                                                ":create_date"=>date('Y-m-d H:i:s'),":modified_date"=>date('Y-m-d H:i:s'));
                            Yii::app()->db->createCommand($sql)->execute($parameters);
                        }
                        
                    }
            }
            
            // insert industries             
            $Industries = $_POST['UserAboutMe']['industry']; 
            $Industries = explode(",", $Industries);
            
            for($i=0; $i<count($Industries); $i++)
            {
                               
                $industryExist = UserLookingFor::model()->exists("user_id = :user_id AND industry_id = :industry_id", array(
                ":user_id"=>$this->user_id,
                ":industry_id"=>$Industries[$i],
                )); 
                
                if(!$industryExist)
                {
                    if(!empty($Industries[$i])){
                        $sql = "insert into ak_user_looking_for (`user_id`,`industry_id`,`create_date`,`modified_date`) 
                            values (:user_id,:industry_id,:create_date,:modified_date)";
                        $parameters = array(":user_id"=>$this->user_id,":industry_id"=>$Industries[$i], 
                                            ":create_date"=>date('Y-m-d H:i:s'),":modified_date"=>date('Y-m-d H:i:s'));

                        Yii::app()->db->createCommand($sql)->execute($parameters);
                    }
                }
            }
           
        }
              
        protected function beforeDelete() {
            UserLookingFor::model()->deleteAll("user_id = :user_id",array(":user_id"=>$this->user_id));
            UserHobbies::model()->deleteAll("user_id = :user_id",array(":user_id"=>$this->user_id));
            return true;
        }
        
        
        
        
        
}