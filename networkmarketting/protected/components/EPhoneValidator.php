<?php

/**

 * EPhoneValidator validates that a phone number (of specified region) is in a valid format

 *

 *

 * @author luoshiben

 * @package application.extensions.ephonevalidator

 * @since 1.0

  */

class EPhoneValidator extends CValidator

{

    //public $region          = 'northamerica';

        public $required                = false;                        //if phone is blank, should an error be thrown?

    private $_phoneNumber   = null;

    

        /**

         * Validates the attribute of the object.

         * If there is any error, the error message is added to the object.

         * @param CModel the object being validated

         * @param string the attribute being validated

         */

        protected function validateAttribute($object,$attribute)

        {

        $valid = true;

        if(is_object($object) && isset($object->$attribute))

            $this->_phoneNumber = $object->$attribute;

            

        if(isset($this->_phoneNumber) && strcmp($this->_phoneNumber, '')) {

            $validationRegionMethod = $this->region.'PhoneValidator';

            if(method_exists($this,$validationRegionMethod))

                $valid = $this->$validationRegionMethod();

            else

                $valid = $this->genericPhoneValidator();

        }

        else

        {

                if($this->required)

                        $valid = false;

        }



                if (!$valid) {

            $message = $this->message !== null ? $this->message : Yii::t('yii', $object->getAttributeLabel($attribute).' is invalid.');

                        $this->addError($object, $attribute, $message);

                }

        }

        

        /**

         * validates a non-region specific phone number based on the non-existence of alpha chars

         *

         * @return boolean

         */

        protected function genericPhoneValidator()

        {

        if (preg_replace('/[^a-z]/i', '', $this->_phoneNumber)) return false;

        else return true;

    }

    

    /**

     * provides basic validation of a north-american phone number based on the non-existence of alpha chars

     * and the existence of 10 or 11 digits

     *

     * @return unknown

     */

    protected function northamericaPhoneValidator()

        {

        $valid = true;

        if (preg_replace('/[^a-z]/i', '', $this->_phoneNumber))

        {

            $valid = false;

        }

        else

        {

            $pn = ereg_replace("[^0-9]",'', $this->_phoneNumber);

            if (strlen($pn) <> 10 || strlen($pn) <> 11)

            {

                $valid = false;

            }

        }

        return $valid;

    }

}
