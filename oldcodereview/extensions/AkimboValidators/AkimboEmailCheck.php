<?php

/**
 * Validates the supplied attributes to determine if there already
 * exists a matching record.  If so gives the user the option to create the
 * new record (in case its a mistaked duplicate)
 * by the CheckDuplicateValidator 
 * @author Ross McCaughrain
 */
class AkimboEmailCheck extends CValidator
{

	/**
	 * (non-PHPdoc)
	 * @see CValidator::validateAttribute()
	 */
	protected function validateAttribute($object,$attribute) {
	}
	
	/**
	 * Validates the specified object.
	 * @param CModel $object the data object being validated
	 * @param array $attributes the list of attributes to be validated. Defaults to null,
	 * meaning every attribute listed in {@link attributes} will be validated.
	 */
	public function validate($object,$attributes=null)
	{
		if(is_array($attributes))
			$attributes=array_intersect($this->attributes,$attributes);
		else
			$attributes=$this->attributes;
			
		$this->validateAttributes($object,$attributes);
	}
	
	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel $object the object being validated
	 * @param string $attribute the attribute being validated
	 */
	protected function validateAttributes($object, $attributes = array())
	{
		$className=$this->className===null?get_class($object):Yii::import($this->className);
		$finder=CActiveRecord::model($className);
		$table=$finder->getTableSchema();
		$mainCriteria=new CDbCriteria();
		$messageReplaces = array();
		foreach($attributes as $attribute)
		{
			$value=$object->$attribute;
			if($this->allowEmpty && $this->isEmpty($value))
				return;

			$attributeName=$this->attributeName===null?$attribute:$this->attributeName;

			if(($column=$table->getColumn($attributeName))===null)
				throw new CException(Yii::t('yii','Table "{table}" does not have a column named "{column}".',
					array('{column}'=>$attributeName,'{table}'=>$table->name)));
	
			$criteria=array('condition'=>$column->rawName.'=:'.$attribute,'params'=>array(':'.$attribute=>$value));
			$mainCriteria->mergeWith($criteria);
			$messageReplaces['{'.$attributeName.'}'] = $value;
		}
		
		if($finder->exists($mainCriteria))
		{
			$message=$this->message!==null?$this->message:Yii::t('yii','{attribute} "{value}" is invalid.');
			$this->addError($object,$this->errorAttribute,$message,$messageReplaces);
		}
	}
	
	/**
	 * @var string the ActiveRecord class name that should be used to
	 * look for the attribute value being validated. Defaults to null,
	 * meaning using the ActiveRecord class of the attribute being validated.
	 * You may use path alias to reference a class name here.
	 * @see attributeName
	 */
	public $className;
	
	/**
	 * @var boolean whether the attribute value can be null or empty. Defaults to true,
	 * meaning that if the attribute is empty, it is considered valid.
	 */
	public $allowEmpty=true;
	
	/**
	 * @var string the ActiveRecord class attribute name that should be
	 * used to look for the attribute value being validated. Defaults to null,
	 * meaning using the name of the attribute being validated.
	 * @see className
	 */
	public $attributeName;
	
	/**
	 * The attribute to display the error on.  If null it will just display in the
	 * errors at the head of the form
	 * @var String
	 */
	public $errorAttribute = null;
	
	/**
	 * The Session (User) State id to use
	 * @var String
	 */
	public static $sessionState = 'checkDuplicateValidator';
}

