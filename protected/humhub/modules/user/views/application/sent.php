<?php

use humhub\modules\admin\grid\UserActionColumn;
use humhub\modules\admin\models\UserSearch;
use humhub\modules\admin\widgets\ExportButton;
use humhub\modules\user\grid\DisplayNameColumn;
use humhub\modules\user\grid\ImageColumn;
use humhub\widgets\Button;
use humhub\modules\user\grid\JobTypesColumn;
use humhub\widgets\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * Bachelor : list of current Application sent
 */
?>
<div class="panel-body">
    <div class="help-block">
        Les candidatures signalées en orange sont en attente de validation par l'employeur, le rouge indique un refus et le vert un intérêt.
    </div>

    <br/>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'columns' => [
                [
                    'label' => 'Entreprise',
                    'value' => 'company.name'
                ],
                [
                    'label' => 'Offre',
                    'value' => 'job.name'
                ],
                [
                    'format' => 'raw',
                    'label' => 'Statut',
                    'value' => function($model){
                        $color = null;
                        if($model->pending){
                            $color = 'orange';
                        } else {
                            if($model->accepted){
                                $color = 'lime';
                            } else {
                                $color = 'orangered';
                            }
                        }
                        return Html::tag('span', '', ['class' => 'dot', 'style' => 'height: 15px;width: 15px;background-color: '.$color.';border-radius: 50%;display: inline-block;']);
                    }
                ]
            ]
        ]); ?>
    </div>
</div>
