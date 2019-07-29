<?php
/**
 * Bachelor : form to create Application
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="panel-heading">
    <?php $form = ActiveForm::begin(['method' => 'post']); ?>

    <?= $form->field($model, 'letter')->textarea(array('rows'=>8));
    //TODO : Field to upload Resume file
    //TODO : Field to upload .zip file
    ?>
    <br>
    <div class="text-center">
        <?= Html::submitButton("Envoyer la candidature", ['class' => 'btn btn-lg btn-success']); ?>
    </div>
    <?php $form->end(); ?>

</div>

