<?php
$this->breadcrumbs=array(
	'Crates',
);

$this->menu=array(
	array('label'=>'Create Crate', 'url'=>array('create')),
	array('label'=>'Manage Crate', 'url'=>array('admin')),
);
?>

<h1>Crates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
