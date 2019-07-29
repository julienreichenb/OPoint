<?php
/**
 * Bachelor : form to Validate account
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="panel-heading">
    <?php $form = ActiveForm::begin(['method' => 'post']); ?>

    <?= $form->field($model, 'message'); ?>
    <?= $form->field($model, 'idGroupAsked')->dropDownList(array(2 => 'Non', 3 => 'Oui')); ?>
    <?= Html::submitButton('Demander une validation', ['class' => 'btn btn-lg btn-success']); ?>
    <br>
    <?php $form->end(); ?>
</div>