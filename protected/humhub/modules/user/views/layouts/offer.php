<?php $this->beginContent('@user/views/layouts/jobmain.php') ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php
            if (Yii::$app->user->isCompany()){
                echo 'Gestion des <strong>offres</strong>';
            }
            else {
                echo '<strong>Offres</strong> disponibles';
            }
          ?>
        </div>
        <?= humhub\modules\user\widgets\OfferTabMenu::widget(); ?>

        <?= $content; ?>
    </div>
<?php $this->endContent(); ?>