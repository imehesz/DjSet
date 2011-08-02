<?php
$this->breadcrumbs=array(
	'Crates'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Crate', 'url'=>array('index')),
	array('label'=>'Create Crate', 'url'=>array('create')),
	array('label'=>'View Crate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Crate', 'url'=>array('admin')),
);
?>

<h1>Update Crate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>