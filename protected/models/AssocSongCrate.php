<?php

/**
 * This is the model class for table "assoc_song_crate".
 *
 * The followings are the available columns in table 'assoc_song_crate':
 * @property integer $song_id
 * @property integer $crate_id
 * @property double $sort_order
 * @property integer $create_date
 */
class AssocSongCrate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AssocSongCrate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'assoc_song_crate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('song_id, crate_id, create_date', 'numerical', 'integerOnly'=>true),
			array('sort_order', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('song_id, crate_id, sort_order, create_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'song_id' => 'Song',
			'crate_id' => 'Crate',
			'sort_order' => 'Sort Order',
			'create_date' => 'Create Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('song_id',$this->song_id);
		$criteria->compare('crate_id',$this->crate_id);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('create_date',$this->create_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}