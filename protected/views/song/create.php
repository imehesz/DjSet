<?php
$this->breadcrumbs=array(
	'Songs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Manage Song', 'url'=>array('admin')),
);
?>

<h1>Create Song</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>