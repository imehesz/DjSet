<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'song-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'artist_name'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name'=> 'Song[artist_name]',
                'value'=> $model->isNewRecord ? '' : $model->artist->name,
                'source'=>$this->createUrl( '/artist/autocomplete'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    ),
                ));
        ?>
		<?php echo $form->error($model,'artist_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name'=> 'Song[title]',
                'value' => $model->title,
                'source'=>$this->createUrl( '/song/autocomplete'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    ),
                ));
        ?>

		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year', array( 'size' => '4', 'maxlength' => 4 ) ); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
        <?php if( $model->bpm == null ){ $model->bpm = 100; } ?>
		<?php echo $form->labelEx($model,'bpm'); ?>
		<?php echo $form->dropDownList($model,'bpm', range( 0, 200 ) ); ?>
		<?php echo $form->error($model,'bpm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'source'); ?>
		<?php echo $form->textArea($model,'source',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'source'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
