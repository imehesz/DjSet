<?php
$this->breadcrumbs=array(
	'Songs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'Update Song', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Song', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Song', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>
<h2>by <?php echo CHtml::link( $model->artist->name, Yii::app()->controller->createUrl( '/artist/view', array( 'id' => $model->artist->id ) ) ); ?> from <?php echo $model->year ?></h2>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bpm',
		'source',
	),
)); ?>
