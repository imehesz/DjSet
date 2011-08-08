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

<h1><?php echo $model->name; ?></h1>
<p class="hint" style="color:#777;"><?php echo date( 'M j, Y', $model->create_date ) ?></p>

<?php if( ! empty( $model->songs ) ): ?>
    <h2>Songs</h2>
    <?php Yii::app()->clientScript->registerScript( 'getsongs', 'getSongsForCrate(' . $model->id . ');', CClientScript::POS_END ); ?>
    <div id="songs_for_crate_<?php echo $model->id ?>"></div>
<?php endif; ?>
