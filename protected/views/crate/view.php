<?php
$this->breadcrumbs=array(
	'Crates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Crate', 'url'=>array('index')),
	array('label'=>'Create Crate', 'url'=>array('create')),
	array('label'=>'Update Crate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Crate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Crate', 'url'=>array('admin')),
);
?>

<h1>View Crate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'create_date',
	),
)); ?>
