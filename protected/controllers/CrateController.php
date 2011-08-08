<?php

class CrateController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'update', 'view', 'index', 'ajaxgetcratesforsong', 'ajaxaddsongtocrate', 'autocomplete', 'ajaxgetsongsforcrate' ),
				'users'=>array('@'),
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
     * actionAjaxGetCratesForSong  
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function actionAjaxGetCratesForSong( $id )
    {
        $song = Song::model()->findByPk( $id );
        if( $song && ! empty( $song->crates ) )
        {
            foreach( $song->crates as $crate )
            {   
                echo CHtml::link( $crate->name, Yii::app()->controller->createUrl( '/crate/view', array( 'id' => $crate->id ) ) ) . ' ';
            }

            die();
        }

        die( 'fail' );
    }

    public function actionAjaxAddSongToCrate( $sid, $cratename )
    {
        if( $sid && $cratename )
        {
            // first we have to make sure we have this song
            $song = Song::model()->findByPk( $sid );
            if( $song )
            {
                // let's see if we have this crate
                $crate = Crate::model()->find( 'name=:name', array( ':name' => $cratename ) );
                if( ! $crate )
                {
                    $crate = new Crate;
                    $crate->name = $cratename;
                    $crate->save();
                }

                if( $crate )
                {
                    // we double check there might be a connection already
                    $songtocrate = AssocSongCrate::model()->find( 'crate_id=:crate_id AND song_id=:song_id', array( ':crate_id' => $crate->id, ':song_id' => $song->id ) );

                    if( ! $songtocrate )
                    {
                        $songtocrate = new AssocSongCrate;
                        $songtocrate->song_id   = $song->id;
                        $songtocrate->crate_id  = $crate->id;
                        $songtocrate->save();
                    }

                    if( $songtocrate )
                    {
                        die( 'success' );
                    }
                }
            }
        }

        die( 'fail' );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $criteria = new CDbCriteria;
        $criteria->condition    = 't.id=:crate_id';
        $criteria->join         = 'LEFT JOIN assoc_song_crate AS sc ON t.id=sc.crate_id';
        $criteria->order        = 'sc.sort_order';
        $criteria->params       = array( ':crate_id' => $id );

        $model = Crate::model()->find( $criteria );
            
        Yii::app()->clientScript->registerScript( 'crateurl', 'var crateurl="' . Yii::app()->controller->createUrl( '/crate' )  . '";', CClientScript::POS_HEAD );

		$this->render('view',array(
			'model'=> $model,
		));
	}

    public function actionAjaxGetSongsForCrate( $id )
    {
        
        $criteria = new CDbCriteria;
        $criteria->join         = 'LEFT JOIN assoc_song_crate AS sc ON t.id=sc.crate_id';
        $criteria->condition    = 't.id=:crate_id';
        $criteria->order        = 'sc.sort_order';
        $criteria->params       = array( ':crate_id' => $id );

        $model = Crate::model()->find( $criteria );

        if( $model )
        {
            if( ! empty( $model->songs ) )
            {
                $this->renderPartial( '_songsforcrate', array( 'songs' => $model->songs ) );
                die();
            }
            else
            {
                die( '-' );
            }
        }

        die( 'fail' );
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Crate;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Crate']))
		{
			$model->attributes=$_POST['Crate'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Crate']))
		{
			$model->attributes=$_POST['Crate'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Crate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Crate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Crate']))
			$model->attributes=$_GET['Crate'];

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
		$model=Crate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionAutocomplete() {
        $res =array();

        if (isset($_GET['term'])) {
            // http://www.yiiframework.com/doc/guide/database.dao
            $qtxt ="SELECT name FROM crate WHERE name LIKE :name";
            $command =Yii::app()->db->createCommand($qtxt);
            $command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
            $res =$command->queryColumn();
        }

        echo CJSON::encode($res);
        Yii::app()->end();
    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='crate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
