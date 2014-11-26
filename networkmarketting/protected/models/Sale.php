<?php

/**
 * This is the model class for table "t_sale".
 *
 * The followings are the available columns in table 't_sale':
 * @property integer $id
 * @property integer $user_id
 * @property integer $stage
 * @property integer $amount
 * @property string $position
 * @property string $created_date
 * @property string $modified_date
 * @property string $joining_id
 */
class Sale extends XcodeModel1 {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sale the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_sale';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id,joining_id, amount, position, created_date, modified_date', 'required'),
            array('user_id, stage, amount', 'numerical', 'integerOnly' => true),
            array('position', 'length', 'max' => 5),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, stage, amount, position, created_date, modified_date', 'safe', 'on' => 'search'),
        );
    }

     public function beforeSave() {
         $user  = Account::model()->findByPk($this->user_id);
         if($user->stage == 1){
             $this->amount = 25;
         }
          return parent::beforeSave();
     }
    
    
    public function afterSave() {

        $data = UtilityManager::getRemainingSale($this->user_id);
        $remaining_sale = min($data['remaining_sale']['left'], $data['remaining_sale']['right']);

        $rightCcount = $this->getSaleCountForStage($this->stage, 'right');
        $leftCcount = $this->getSaleCountForStage($this->stage, 'left');
        
        $rightcount = $this->getSaleForAll('right');
        $leftcount = $this->getSaleForAll('left');
        $count = min($rightCcount, $leftCcount);
        $paid_count = UtilityManager::getUserPaidCommission($this->user_id, $this->stage);

        if ($this->stage != 1) {
        $total_sale = min($rightcount, $leftcount);
        }
        else{
            $total_sale = $count;
        }
       
        if ($this->stage != 3) {

            $limit = UtilityManager::$stages_sale_limit[$this->stage];
            if ($total_sale >= $limit) {
                // lock account
                $user = Account::model()->findByPk($this->user_id);
                $user->lock = 1;
                $user->modified_date = UtilityManager::getSqlCurrentDate();
                $user->update();
                return parent::afterSave();
            }
        }
        
          if ($count > $paid_count && $this->stage == 1) {

            // pay commission
            $commission = new Commission();
            $commission->stage = $this->stage;
            $commission->points = UtilityManager::$stage_one_commission;
            $commission->count = $paid_count + 1;
            $commission->user_id = $this->user_id;
            $commission->remarks = "left right $count sale set completed by joining of " . $this->joining_id;
            $commission->created_date = UtilityManager::getSqlCurrentDate();

            if ($commission->save()) {

                return parent::afterSave();
            }
            else
                return FALSE;
        }
        
        elseif ($this->stage != 1 && $remaining_sale >= UtilityManager::$stages_commission_based[$this->stage]) {

            // pay commission

            $commission = new Commission();
            $commission->stage = $this->stage;
            $commission->points = UtilityManager::$stages_commission_earning[$this->stage];
            $commission->count = $paid_count + 1;
            $commission->user_id = $this->user_id;
            $commission->remarks = "left right sale set completed by joining of " . $this->joining_id;
            $commission->created_date = UtilityManager::getSqlCurrentDate();

            if ($commission->save()) {

                return parent::afterSave();
            } else
                return FALSE;
        }
        
        return parent::afterSave();
    }

    public function getSaleCountForStage($stage, $position) {

        return Yii::app()->db->createCommand("SELECT count(`amount`) as `sum` FROM " . $this->tableName() . " WHERE stage=$stage AND position='$position' AND  user_id=" . $this->user_id)->queryScalar();
    }

    public function getSaleForStage($stage, $position,$date = false) {

        if(empty($date)){
            return Yii::app()->db->createCommand("SELECT SUM(`amount`) as `sum` FROM " . $this->tableName() . " WHERE stage=$stage AND position='$position' AND  user_id=" . $this->user_id)->queryScalar();
    }
    else{
            return Yii::app()->db->createCommand("SELECT SUM(`amount`) as `sum` FROM " . $this->tableName() . " WHERE stage=$stage AND created_date > '$date' AND position='$position' AND  user_id=" . $this->user_id)->queryScalar();
    }
    
    }

    public function getSaleForAll($position) {

        return Yii::app()->db->createCommand("SELECT SUM(`amount`) as `sum` FROM " . $this->tableName() . " WHERE position='$position' AND  user_id=" . $this->user_id)->queryScalar();
    }
    
     public function getSaleForAllAfterFlushoutDate($position,$date) {

        return Yii::app()->db->createCommand("SELECT SUM(`amount`) as `sum` FROM " . $this->tableName() . " WHERE user_id=" . $this->user_id." AND created_date >= '$date' AND position='$position'")->queryScalar();
    }

    public function getAllSale() {

        return Yii::app()->db->createCommand("SELECT SUM(`amount`) as `sum` FROM " . $this->tableName() . " WHERE user_id=" . $this->user_id)->queryScalar();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'stage' => 'Stage',
            'amount' => 'Amount',
            'position' => 'Position',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('stage', $this->stage);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('modified_date', $this->modified_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
