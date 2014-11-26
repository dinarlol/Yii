<?php

/**
 * Change the following URL based on your server configuration
 * Make sure the URL ends with a slash so that we can use relative URLs in test cases
 */
define('TEST_BASE_URL','http://192.168.1.101/akimbo/index.php?r=search');

/**
 * The base class for functional test cases.
 * In this class, we set the base URL for the test application.
 * We also provide some common methods to be used by concrete test classes.
 */
class WebTestCase extends CDbTestCase
{
	/**
	 * Sets up before each test method runs.
	 * This mainly sets the base URL for the test application.
	 */
	protected function setUpOld()
	{
		parent::setUp();
		$this->setBrowserUrl(TEST_BASE_URL);
	}
	
	
	public function testApprove()
	{
		// insert a person in pending status
	
		// verify the person is in pending status
		$person=AkimboSearch::model()->findByPk(123);
		//$person = new AkimboSearch();
		$search = $person->search();
		
		/*
		$dataProvider = $person->search();
		$profile = new EmployeeProfile($person);
		$profile->getProfileProgress();
		
		$recomed = AkimboNuggetManager::getRecomendationCount(123, 1, 5);
	
		$data = $dataProvider->getData();
		*/
		$this->assertTrue($person instanceof Person);
		$this->assertEquals(Person::STATUS_PENDING,$person->status);
		$this->assertTrue($search instanceof CDataProvider);
		// call approve() and verify the person is in approved status
		//$person->approve();
	//	$this->assertEquals(Person::STATUS_APPROVED,$person->status);
	//	$person=Person::model()->findByPk($person->id);
		//$this->assertEquals(Person::STATUS_APPROVED,$person->status);
	}
	
	
	protected function setUp()
	{
		parent::setUp();
		$this->testApprove();
	}
}
