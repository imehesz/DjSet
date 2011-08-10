<div class="view">
    <div style="float:left;width:300px;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link( CHtml::encode($data->title), Yii::app()->controller->createUrl( '/song/view', array( 'id' => $data->id ) ) ); ?>
    <?php echo $data->year ? '(' . CHtml::encode( $data->year ) . ')' : 'n/a'; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('artist_id')); ?>:</b>
	<?php echo CHtml::link( $data->artist->name, Yii::app()->controller->createUrl( '/artist/view', array( 'id' => $data->artist->id ) ) ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bpm')); ?>:</b>
	<?php echo CHtml::encode($data->bpm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
    </div>
    <div>
    <?php if( ! Yii::app()->user->isGuest ) : ?>
        <div>
            <?php echo CHtml::link( 'Add to Crate', 'javascript:void(0);', array( 'onclick' => 'javascript:jQuery( "#add_to_crate_wrapper_' . $data->id . '").toggle();' ) ); ?>
            <span id="add_to_crate_wrapper_<?php echo $data->id?>" style="display:none;">
                <?php
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name'=> 'add_to_crate_' . $data->id,
                        'value'=>'',
                        'source'=>$this->createUrl( '/crate/autocomplete'),
                        // additional javascript options for the autocomplete plugin
                        'options'=>array(
                            'showAnim'=>'fold',
                            ),
                        ));
                ?>

                <?php echo CHtml::button( 'submit', array( 'id' => 'sid_' . $data->id, 'class' => 'add_to_crate_submit' ) ); ?>
            </span>
            <p>
            <div id="crates_for_<?php echo $data->id ?>">
            </p>
            </div>
        </div>
        <?php Yii::app()->clientScript->registerScript( 'getcrates' . $data->id, 'getCratesForSong(' . $data->id . ');', CClientScript::POS_END  ); ?>
    <?php endif; ?>
    </div>
    <div style="clear:both;"></div>
</div>
