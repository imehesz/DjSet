<?php
$this->breadcrumbs=array(
	'Songs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'View Song', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Song', 'url'=>array('admin')),
);
?>

<h1>Update Song <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>