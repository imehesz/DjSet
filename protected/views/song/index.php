<?php
$this->breadcrumbs=array(
	'Songs',
);

$this->menu=array(
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'Manage Song', 'url'=>array('admin')),
);
?>

<h1>Songs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
