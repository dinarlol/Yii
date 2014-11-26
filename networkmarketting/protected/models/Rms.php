<?php

/**
 * This is the model class for table "t_rms".
 *
 * The followings are the available columns in table 't_rms':
 * @property integer $id
 * @property integer $user_id
 * @property string $position
 * @property string $created_date
 */
class Rms extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 't_rms';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, position, created_date', 'required'),
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('position', 'length', 'max'=>6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, position, created_date', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
            'position' => 'Position',
            'created_date' => 'Created Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('position',$this->position,true);
        $criteria->compare('created_date',$this->created_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function getRmsCountForStage($position) {

        return Yii::app()->db->createCommand("SELECT count(`id`) as `sum` FROM " . $this->tableName() . " WHERE position='$position' AND  user_id=" . $this->user_id)->queryScalar();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Rms the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}