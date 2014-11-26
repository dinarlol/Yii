<?php

class UserWritingLiteratureController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	private $category_id;
	public function init(){
		$this->category_id = Category::model()->find('LOWER(name)=?',array(strtolower(AkimboNuggetManager::$category_userWritingLiterature)))->id;
	
	
	}
	
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','search'),
				'roles'=>array(AkimboNuggetManager::USER_ROLE),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','deleteDoc','deleteReadBook'),
				'roles'=>array(AkimboNuggetManager::USER_ROLE),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserWritingLiterature();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		if(isset($_POST['UserWritingLiterature']))
		{
			
			$model->user_id = Yii::app()->user->id;
			$model->attributes=$_POST['UserWritingLiterature'];
			$model->create_date = AkimboNuggetManager::getSqlCurrentDate();
			$model->modified_date = $model->create_date;
			$this->performAjaxValidation($model);
			if($model->save()){
				if(isset($_POST['Books'])){
				$criteria = new CDbCriteria;
					//$criteria->select='isbn';
					$criteria->addSearchCondition('isbn',$_POST['Books']['isbn'],false);
					$books = Books::model()->find($criteria);
					if(empty($books)){
						$books = $this->addBook($_POST['Books']['isbn']);
					}
					if(!empty($books)){
					$readBook = new UserReadBooks();
					$readBook->book_id = $books->id;
				$readBook->user_id = Yii::app()->user->id;
				$readBook->create_date = AkimboNuggetManager::getSqlCurrentDate();
				$readBook->modified_date = $readBook->create_date;
				$readBook->category_id = $this->category_id;
				$readBook->category_pk_id = $model->id;
				$readBook->save();
					}
			}
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id);
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userWritingLiterature));
			}
				
		}

			else{
			$this->renderPartial('create',array(
					'model'=>$model,
			),false,true);

			}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserWritingLiterature']))
		{
			$model->attributes=$_POST['UserWritingLiterature'];
			$model->user_id = Yii::app()->user->id;
			$model->modified_date = AkimboNuggetManager::getSqlCurrentDate();
			$this->performAjaxValidation($model);
			if($model->update()){
				AkimboNuggetManager::uploadAllAttachments($this->category_id, $model->id);
				if(isset($_POST['Books'])){
					$criteria = new CDbCriteria;
					//$criteria->select='isbn';
					$criteria->addSearchCondition('isbn',$_POST['Books']['isbn'],false);
					$books = Books::model()->find($criteria);
					if(empty($books)){
						$books = $this->addBook($_POST['Books']['isbn']);
					}
					if(!empty($books)){
					$readBook = new UserReadBooks();
					$readBook->book_id = $books->id;
					$readBook->user_id = Yii::app()->user->id;
					$readBook->create_date = AkimboNuggetManager::getSqlCurrentDate();
					$readBook->modified_date = $readBook->create_date;
					$readBook->category_id = $this->category_id;
					$readBook->category_pk_id = $model->id;
					$this->performAjaxValidation($readBook);
					$readBook->save();
					}
				}

				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userWritingLiterature));
			}
		}

		$this->renderPartial('update',array(
			'model'=>$model,
		),false,true);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if(Yii::app()->user->id == $model->user_id){
				
				
			if(AkimboNuggetManager::deleteNuggetWithUploadedAttachments($model))
				$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userWritingLiterature));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	
	/**
	 * Deletes a particular Image Attachements.
	 * If deletion is successful, the browser will be redirected to the 'main' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteDoc($id)
	{
	
		if(AkimboNuggetManager::deleteUploadedAttachments(AkimboNuggetManager::$content_type_document, $id)){
	
	
			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userWritingLiterature));
		}
	}
	
	
	/**
	 * Deletes a particular Read book.
	 * If deletion is successful, the browser will be redirected to the 'main' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteReadBook($id)
	{
		
		$model=UserReadBooks::model()->findByPk($id);
	
		if(Yii::app()->user->id == $model->user_id){
			
			$model->delete();
	
	
			$this->redirect($this->createAbsoluteUrl('nuggetsCreator/index&hash='.AkimboNuggetManager::$category_userWritingLiterature));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new UserWritingLiterature();
		$model->user_id = Yii::app()->user->id;
		$this->renderPartial('index',array(
				'model'=>$model,
		),false,true);
		
	}
	
	
	
	/*
	 * 
	 * If lookup not press
	 * 
	 * 
	 * 
	 */
	
	
	private function addBook($term){
		
		$url = 'https://www.googleapis.com/books/v1/volumes';
		Yii::import('ext.EHttpClient.*');
		$client = new EHttpClient('https://www.googleapis.com/books/v1/volumes?q=isbn+'.$term, array(
				'maxredirects' => 0,
				'timeout'      => 30));
		
		/*
		 $client = new EHttpClient($url, array(
		 		'maxredirects' => 3,
		 		'timeout'      => 30,
		 		'adapter'      => 'EHttpClientAdapterCurl'));
		
		$client->setParameterGet(array('q'=>'isb+9780195331448'));
		*/
		$response = $client->request();
		$isbn = $term;
		
		if($response->isSuccessful()){
		
			$book = new Books();
			$contents =  CJSON::decode($response->getBody());
			if(!empty($contents['items'])){
				foreach ($contents['items'] as $content)
		
				{
					$book->name = $content['volumeInfo']['title'];
					$book->author = $content['volumeInfo']['authors'][0];
					foreach ($content['volumeInfo']['industryIdentifiers'] as $industry){
						$isbn = $industry['identifier'];
					}
		
					$book->thumbnail = $content['volumeInfo']['imageLinks']['thumbnail'];
					$thumbNail = $book->thumbnail;
					$book->small_thumbnail = $content['volumeInfo']['imageLinks']['smallThumbnail'];
		
					$book->isbn = $isbn;
					$book->create_date = AkimboNuggetManager::getSqlCurrentDate();
					$book->modified_date = $book->create_date;
					if($book->save()){
						return $book;
						
					}
					else{
						return ;
					}
					
				}
			}
			else{
				
				return ;
			}
		}
	} 
	
	
	
	/*
	 * 
	 * For Books  autocomple
	 * 
	 */
	
	public function actionSearch()
	{
		
		$thumbNail ='';
		if(Yii::app()->request->isAjaxRequest && isset($_GET['Books']))
		{
			$term = $_GET['Books']['isbn'];
			$variants = array();
			$criteria = new CDbCriteria;
			//$criteria->select='isbn';
			$criteria->addSearchCondition('isbn',$term,false);
			$books = Books::model()->findAll($criteria);
			if(!empty($books))
			{
				foreach($books as $book)
				{
					//print_r($criteria);
					$thumbNail = $book->thumbnail;
				}
			}
			
			else{
				//$contents = file_get_contents('https://www.googleapis.com/books/v1/volumes?isbn=9780195331448');
				$url = 'https://www.googleapis.com/books/v1/volumes';
				Yii::import('ext.EHttpClient.*');
				$client = new EHttpClient('https://www.googleapis.com/books/v1/volumes?q=isbn+'.$term, array(
						'maxredirects' => 0,
						'timeout'      => 30));
				
				/*
				$client = new EHttpClient($url, array(
						'maxredirects' => 3,
						'timeout'      => 30,
						'adapter'      => 'EHttpClientAdapterCurl'));
				
				$client->setParameterGet(array('q'=>'isb+9780195331448'));
				*/
				$response = $client->request();
				$isbn = $term;
				
				if($response->isSuccessful()){
					
					$book = new Books();
					$contents =  CJSON::decode($response->getBody());
					if(!empty($contents['items'])){
					foreach ($contents['items'] as $content)
						
					{
						$book->name = $content['volumeInfo']['title'];
						$book->author = $content['volumeInfo']['authors'][0];
						foreach ($content['volumeInfo']['industryIdentifiers'] as $industry){
							$isbn = $industry['identifier'];
						}
						
						$book->thumbnail = $content['volumeInfo']['imageLinks']['thumbnail'];
						$thumbNail = $book->thumbnail;
						$book->small_thumbnail = $content['volumeInfo']['imageLinks']['smallThumbnail'];
						
						$book->isbn = $isbn;
						$book->create_date = AkimboNuggetManager::getSqlCurrentDate();
						$book->modified_date = $book->create_date;
						if($book->save()){
							
							
						}
						else{
							
						//	print_r($book);	
						}
					
					}
				}
				else{
					
					echo $response->getRawBody();
				}
				}
				else
					$response->getRawBody();
				
				
				//print_r($client);
				
				
			}
			//echo CJSON::encode($variants);
			echo CHtml::image($thumbNail);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserWritingLiterature('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserWritingLiterature']))
			$model->attributes=$_GET['UserWritingLiterature'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=UserWritingLiterature::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-writing-literature-form')
		{
			
			
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
