<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link( CHtml::encode($data->name), Yii::app()->controller->createUrl( '/artist/view/', array( 'id' => $data->id ) ) ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo date( 'm/d/Y', CHtml::encode($data->create_date ) ); ?>
	<br />


</div>
