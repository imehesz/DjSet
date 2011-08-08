<?php
$this->breadcrumbs=array(
	'Artists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Artist', 'url'=>array('index')),
	array('label'=>'Create Artist', 'url'=>array('create')),
	array('label'=>'Update Artist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Artist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artist', 'url'=>array('admin')),
);
?>

<h1>Artist: <?php echo $model->name; ?></h1>
<?php if( ! empty( $songs ) ) : ?>
    <h2>Songs</h2>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'song-grid',
        'dataProvider'=>$songs,
        'filter'=>new Song,
        'columns'=>array(
            array(
                'name'      => 'title',
                'type'      => 'raw',
                'header'    => 'Title',
                'value'     => 'CHtml::link($data->title, Yii::app()->controller->createUrl( "/song/view", array( "id" => $data->id ) ))'
            ),
            'year',
            'bpm',
            //'source',
            /*
            'create_date',
            */
            /*
            array(
                'class'=>'CButtonColumn',
            ),
            */
        ),
    )); ?>
<?php endif; ?>
<?php /*
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'create_date',
	),
)); ?>
*/ ?>
