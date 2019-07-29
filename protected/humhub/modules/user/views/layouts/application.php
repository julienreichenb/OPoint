<?php $this->beginContent('@user/views/layouts/jobmain.php') ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php
            if (Yii::$app->user->isCompany()){
                echo '<h3>Gestion des <strong>candidatures</strong></h3>';
            }
            else {
                echo '<h3>Mes <strong>candidatures</strong></h3>';
            }
          ?>
        </div>

        <?= $content; ?>
    </div>
<?php $this->endContent(); ?>