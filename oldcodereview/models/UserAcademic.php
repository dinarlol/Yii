<?php

/**
 * This is the model class for table "ak_user_academic".
 *
 * The followings are the available columns in table 'ak_user_academic':
 * @property integer $id
 * @property integer $user_id
 * @property string $school
 * @property string $graduation_date
 * @property integer $major_subject_id
 * @property integer $minor_subject_id
 * @property integer $concentration
 * @property double $gpa
 * @property string $create_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Subject $minorSubject
 * @property Subject $majorSubject
 * @property User $user
 */
class UserAcademic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserAcademic the static model class
	 */
    
        public $major_other; 
        public $minor_other;
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ak_user_academic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, graduation_date, major_subject_id, minor_subject_id, concentration, create_date, modified_date', 'required'),
			array('user_id, major_subject_id, minor_subject_id','numerical', 'integerOnly'=>true),
			array('gpa', 'numerical'),
			array('school', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, school, graduation_date, major_subject_id, minor_subject_id, concentration, gpa, create_date, modified_date', 'safe', 'on'=>'search'),
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
			'minorSubject' => array(self::BELONGS_TO, 'Subject', 'minor_subject_id'),
			'majorSubject' => array(self::BELONGS_TO, 'Subject', 'major_subject_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'userEducationTitle' => array(self::BELONGS_TO, 'UserEducationTitle', 'concentration'),
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
			'school' => 'University/College',
			'graduation_date' => 'Expected Graduation Date',
			'major_subject_id' => 'Major Subject',
			'minor_subject_id' => 'Minor Subject',
			'concentration' => 'Concentration',
			'gpa' => 'GPA',
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
		$criteria->compare('school',$this->school,true);
		$criteria->compare('graduation_date',$this->graduation_date,true);
		$criteria->compare('major_subject_id',$this->major_subject_id);
		$criteria->compare('minor_subject_id',$this->minor_subject_id);
		$criteria->compare('concentration',$this->concentration);
		$criteria->compare('gpa',$this->gpa);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
            
          $attributes = $_POST["UserAcademic"];
            
            if(!empty($attributes["major_other"]))
            {
                $row = Subject::model()->find("name = '".$attributes["major_other"]."'"); 
                if(!is_null($row))
                {
                    $majorId = $row["id"];
                }else{
                    $Subject = new Subject(); 
                    $Subject->name = $attributes["major_other"];
                    $Subject->create_date = date('Y-m-d H:i:s');
                    $Subject->modified_date = date('Y-m-d H:i:s'); 
                    $Subject->save(); 
                                        
                    $majorId = $Subject->id; 
                }
             
                //$_POST["UserAcademic"]["major_id"] = $majorId;
                $this->major_subject_id = $majorId;
            }
            
            if(!empty($attributes["minor_other"]))
            {
                $row = Subject::model()->find("name = '".$attributes["minor_other"]."'"); 
                if(!is_null($row))
                {
                    $minorId = $row["id"];
                }else{
                    $Subject = new Subject(); 
                    $Subject->name = $attributes["major_other"];
                    $Subject->create_date = date('Y-m-d H:i:s');
                    $Subject->modified_date = date('Y-m-d H:i:s'); 
                    $Subject->save(); 
                                        
                    $minorId = $Subject->id; 
                }
             
                $this->minor_subject_id = $minorId; 
               // $_POST["UserAcademic"]["minor_id"] = $minorId;
            }
            
            if(!empty($attributes["concentration"]))
            {
                $concentration = $attributes["concentration"];
                $row = UserEducationTitle::model()->find("name = '$concentration'");
                
                if(!is_null($row))
                {
                    $concentrationId = $row["id"];
                }else{
                    $EducationTitle = new UserEducationTitle();
                    $EducationTitle->name = $concentration;
                    $EducationTitle->description = $concentration;
                    $EducationTitle->create_date = date("Y-m-d H:i:s");
                    $EducationTitle->modified_date = date("Y-m-d H:i:s");
                    $EducationTitle->save();
                    
                    $concentrationId = $EducationTitle->id; 
                    
                }
                
                $this->concentration = $concentrationId;
            }
                        
            return true;
                        
        }
        
        
        
        
}