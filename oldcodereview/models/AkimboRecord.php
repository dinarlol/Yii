<?php
class AkimboRecord extends CActiveRecord{


	/**
	 * Sets the default values
	 * @see CActiveRecord::init()
	 */
	public function init(){
		$date = date('Y-m-d H:i:s');
		$this->create_date = $date;
		$this->modified_date = $date;
	
	}

	public $userGroup = 'REGISTERED';
	public $guestGroup = 'PUBLIC';
	public $specialGroup = 'SPECIAL';

	public $userRole = 'USER';
	public $companyRole = 'COMPANY';
	public $adminRole = 'ADMIN';
	private $generatedPassword ;
	public $pendingstatus = 'PENDING';
	public $activestatus = 'ACTIVE';
	public $suspendedstatus = 'SUSPENDED';
	public $deletedstatus = 'DELETED';
	private $plainPassword;
	
	const STATUS_PENDING = 'ACTIVE';
	const STATUS_APPROVED = 'SUSPENDED';



	// statically generating salt for hashes

	public function setGeneratedPassword(){

		$this->plainPassword = uniqid('', true);
		$this->generatedPassword = md5(md5($this->plainPassword.Yii::app()->params["@k!MbO"]));
	//	(md5(md5($this->password).Yii::app()->params["@k!MbO"]))
	}

	private function factoryGeneratedPassword(){
		$this->setGeneratedPassword();
		return $this->getGeneratedPassword();
	}
	
	private function factoryGeneratedPlainPassword(){
		$this->setGeneratedPassword();
		return $this->plainPassword;
	}



	public function getGeneratedPlainPassword(){

		return empty($this->plainPassword)?$this->factoryGeneratedPlainPassword():$this->plainPassword;
	}
	
	public function getGeneratedPassword(){
	
		return empty($this->generatedPassword)?$this->factoryGeneratedPassword():$this->generatedPassword;
	}
	
	
	public function getUserRoleId(){
		
		$criteria = new CDbCriteria();
		$criteria->compare('name', $model->userRole);
		$rolemodel = Roles::model()->find($criteria);
		
		$criteria1 = new CDbCriteria();
		$criteria1->compare('name', $model->userGroup);
		$groupmodel = Group::model()->find($criteria1);
		
		
	}
	
	


}
?>