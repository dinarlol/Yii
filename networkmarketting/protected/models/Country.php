<?php

/**
 * This is the model class for table "t_country".
 *
 * The followings are the available columns in table 't_country':
 * @property integer $country_id
 * @property string $country
 *
 * The followings are the available model relations:
 * @property City[] $cities
 * @property Users[] $users
 */
class Country extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_country';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country', 'required'),
            array('country', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('country_id, country', 'safe', 'on' => 'search'),
        );
    }

    public static function getCountryNameById($id) {
        $country = self::model()->findByPk($id);
        if (!empty($country)) {

            return $country->country;
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cities' => array(self::HAS_MANY, 'City', 'country_id'),
            'users' => array(self::HAS_MANY, 'Users', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'country_id' => 'Country',
            'country' => 'Country',
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

        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('country', $this->country, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}