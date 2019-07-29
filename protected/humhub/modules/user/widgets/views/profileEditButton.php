<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * Bachelor : display or not the Validation option
 */
if(Yii::$app->user->isValidated()){
    print Html::a(Yii::t("UserModule.widgets_views_profileEditButton", "Edit account"), Url::toRoute('/user/account/edit'), ['class' => 'btn btn-primary edit-account']);
}
else {
    print Html::a(Yii::t("UserModule.widgets_views_profileValidateButton", "Valider mon compte"), Url::toRoute('/user/account/validate'), ['class' => 'btn btn-danger valid-account']);
}