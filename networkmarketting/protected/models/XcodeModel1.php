<?php

/*

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of XcodeModel

 *

 * @author jh

 */
class XcodeModel1 extends CActiveRecord {

    //put your code here





    public function beforeValidate() {





        if ($this->isNewRecord) {

            $this->created_date = UtilityManager::getSqlCurrentDate();
        }



        $this->modified_date = UtilityManager::getSqlCurrentDate();




        return parent::beforeValidate();
    }

}

