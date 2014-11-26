<?php

class ModeltTest extends CDbTestCase
{
	public $fixtures=array(
			'person'=>'Person',
			'search'=>'AkimboSearch',
	);

	
	public function testApprove()
	{
		// insert a person in pending status
		
		// verify the person is in pending status
		$person=Person::model()->findByPk(123);
		$this->assertTrue($person instanceof Person);
		$this->assertEquals(Person::STATUS_PENDING,$person->status);
	
		// call approve() and verify the person is in approved status
		$person->approve();
		$this->assertEquals(Person::STATUS_APPROVED,$person->status);
		$person=Person::model()->findByPk($person->id);
		$this->assertEquals(Person::STATUS_APPROVED,$person->status);
	}
	
	
	protected function setUp()
	{
		parent::setUp();
		$this->testApprove();
	}



}
	
	
	
	

?>