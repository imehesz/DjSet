<?php
$this->breadcrumbs=array(
	'Crates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Crate', 'url'=>array('index')),
	array('label'=>'Manage Crate', 'url'=>array('admin')),
);
?>

<h1>Create Crate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>