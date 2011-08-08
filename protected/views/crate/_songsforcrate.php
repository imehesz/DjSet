<?php if( !empty( $songs ) ) : ?>
    <table>
    <?php foreach( $songs as  $song ) : ?>
        <tr>
            <td align="center">
                up<br />
                down
            </td>
            <td><?php echo CHtml::link( $song->title, Yii::app()->controller->createUrl( '/song/view', array( 'id' => $song->id ) ) ) ?></td>
            <td><?php echo CHtml::encode( $song->bpm ); ?></td>
            <td><?php echo CHtml::link( $song->artist->name, Yii::app()->controller->createUrl( '/artist/view', array( 'id' => $song->artist->id ) ) ) ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
