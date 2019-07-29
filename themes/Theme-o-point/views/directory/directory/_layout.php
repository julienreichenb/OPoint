<?php

use humhub\modules\directory\widgets\Menu;
use humhub\modules\directory\widgets\Sidebar;
use humhub\widgets\FooterMenu;

\humhub\assets\JqueryKnobAsset::register($this);
?>

<div class="container">
    <div class="row">
        <?php
            if(Yii::$app->user->isGuest) {
                ?>
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <p>Vous devez vous connecter pour voir cette page.</p>
                            </div>
                        </div>
                    </div>
                <?php
            } else {
                ?>
                <div class="col-md-3">
                    <?= Menu::widget(); ?>
                </div>
                <div class="col-md-9">
                    <?= $content; ?>
                </div>
                <?php
                /*
                <div class="col-md-3">
                    <?= Sidebar::widget(); ?>
                    <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]); ?>
                </div>
                */
                ?>
                <?php 
            }
        ?>
    </div>
</div>
