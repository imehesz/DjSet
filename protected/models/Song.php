<?php

/**
 * This is the model class for table "song".
 *
 * The followings are the available columns in table 'song':
 * @property integer $id
 * @property integer $artist_id
 * @property string $title
 * @property integer $year
 * @property integer $bpm
 * @property string $source
 * @property integer $create_date
 */
class Song extends CActiveRecord
{
    /**
     * artist_name  
     * 
     * @var mixed
     * @access public
     */
    public $artist_name;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Song the static model class
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
		return 'song';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array( 'artist_id,artist_name', 'required' ),
			array('artist_id, year, bpm, create_date', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('source', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, artist_id, title, year, bpm, source, create_date', 'safe', 'on'=>'search'),
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
            'artist' => array( self::BELONGS_TO, 'Artist', 'artist_id' ),
            'crates'=>array(self::MANY_MANY, 'Crate', 'assoc_song_crate(song_id, crate_id)'),
		);
	}

    public function beforeValidate()
    {
        // get artist by name
        $artist = Artist::model()->findByAttributes( array( 'name' => $this->artist_name ) );

        // if we don't have it, we create it ...
        if( empty( $artist ) )
        {
            $artist = new Artist;
            $artist->name = $this->artist_name;
            $artist->save();
        }

        // at this point we should have an artist, if we don't throw an errir
        if( ! $artist )
        {
            throw new CHttpException( '404', 'Could not save artist, please try again!' );
        }

        $this->artist_id = $artist->id;

        if( $this->isNewRecord )
        {
            $this->create_date = time();
        }

        return parent::beforeValidate();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'artist_id' => 'Artist',
			'title' => 'Title',
			'year' => 'Year',
			'bpm' => 'Bpm',
			'source' => 'Source',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('artist_id',$this->artist_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('bpm',$this->bpm);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('create_date',$this->create_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
