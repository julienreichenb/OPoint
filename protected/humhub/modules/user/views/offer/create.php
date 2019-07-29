<?php
/**
 * Bachelor : form to create Offer
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="panel-heading">
    <?php $form = ActiveForm::begin(['method' => 'post']); ?>

    <?= $form->field($model, 'name'); ?>
    <?= $form->field($model, 'description')->textarea(array('rows'=>4)); ?>
    <?= $form->field($model, 'location'); ?>
    <?= $form->field($model, 'idSector')->dropDownList($sectors); ?>
    <?= $form->field($model, 'idType')->dropDownList($types); ?>
    <?= $form->field($model, 'rate')->dropDownList(array(
            100 => '100%',
            90 => '90%',
            80 => '80%',
            70 => '70%',
            60 => '60%',
            50 => '50%',
            40 => '40%',
            30 => '30%',
            20 => '20%',
            10 => '10%',
    )); ?>
    <?= $form->field($model, 'salary'); ?>
    <?= $form->field($model, 'startingDate')->widget(\yii\jui\DatePicker::class, [
            //TODO : condition for date selection
                        ]); ?>
    <?= $form->field($model, 'linkedInURL'); ?>

    <div class="text-center">
        <?= Html::submitButton("Soumettre l'annonce", ['class' => 'btn btn-lg btn-success']); ?>
    </div>
    <br>
    <div class="warning text-center"><strong>Toute modification doit être validée par notre modération, rendant l'annonce indisponible dans l'intervalle.</strong></div>
    <br>
    <?php $form->end(); ?>

</div>
<style>
    .warning{
        font-style: italic;
        border: 1px solid red;
        border-radius: 5px;
    }
</style>

