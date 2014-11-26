<?php

/**
 * This is the model class for table "active_instrument".
 *
 * The followings are the available columns in table 'active_instrument':
 * @property integer $id
 * @property string $file
 * @property string $state
 * @property string $county
 * @property string $dt_rec
 * @property string $street
 * @property string $city
 * @property string $zip
 * @property string $opr
 * @property string $declarant
 * @property string $efiv
 * @property string $percent
 * @property string $userid
 */
class ActiveInstrument extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'active_instrument';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('file', 'required'),
            array('file', 'length', 'max'=>16),
			array('userid', 'length', 'max'=>55),
			array('state', 'length', 'max'=>65),
			array('county', 'length', 'max'=>53),
			array('dt_rec', 'length', 'max'=>14),
			array('street', 'length', 'max'=>99),
                        array('street, city, zip', 'default', 'value' => '', 'setOnEmpty' => false, 'on' => 'update, insert'),
			array('city', 'length', 'max'=>44),
			array('zip', 'length', 'max'=>72),
			array('opr, declarant', 'length', 'max'=>122),
			array('efiv', 'length', 'max'=>15),
			array('percent', 'length', 'max'=>15),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('file, state, county, dt_rec, street, city, zip, opr, declarant, efiv, percent, userid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'file' => 'File',
            'state' => 'State',
            'county' => 'County',
            'dt_rec' => 'Dt Rec',
            'street' => 'Street',
            'city' => 'City',
            'zip' => 'Zip',
            'opr' => 'Opr',
            'declarant' => 'Declarant',
            'efiv' => 'Efiv',
            'percent' => 'Percent',
            'userid' => 'Userid',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('file', $this->file, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('county', $this->county, true);
        $criteria->compare('dt_rec', $this->dt_rec, true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('zip', $this->zip, true);
        $criteria->compare('opr', $this->opr, true);
        $criteria->compare('declarant', $this->declarant, true);
        $criteria->compare('efiv', $this->efiv, true);
        $criteria->compare('percent', $this->percent, true);
        $criteria->compare('userid', $this->userid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ActiveInstrument the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
