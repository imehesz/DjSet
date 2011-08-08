<div class="view">
	<?php echo CHtml::link( CHtml::encode($data->name ), Yii::app()->controller->createUrl( '/crate/view', array( 'id' => $data->id ) ) ); ?>
	<br />

    <div style="hint">
        <?php echo date( 'M j, Y', CHtml::encode($data->create_date) ); ?>
    </div>


</div>
