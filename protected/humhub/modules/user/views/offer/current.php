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
 * Bachelor : list of current Job offers
 */
?>
<div class="panel-body">
    <h4><strong>Offres</strong> en ligne</h4>
    <div class="help-block">
        Les offres signalées en rouge sont en attente de validation par un modérateur.
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
                    'label' => 'Localité',
                    'value' => 'location'
                ],
                [
                    'label' => 'Poste',
                    'value' => 'name',
                ],
                ['class' => JobTypesColumn::class],
                [
                        'format' => 'raw',
                  'label' => 'Statut',
                  'value' => function($model){
                         $color = null;
                        if($model->isValidated()){
                            $color = 'lime';
                        } else {
                            $color = 'orangered';
                        }
                        return Html::tag('span', '', ['class' => 'dot', 'style' => 'height: 15px;width: 15px;background-color: '.$color.';border-radius: 50%;display: inline-block;']);
                  }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a('<span class="fa fa-eye"/>', $url, ['class' => 'btn btn-sm btn-info']);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = 'index.php?r=user%2Foffer/view&id='.$model['id'];
                            return $url;
                        }
                    }
                ]
            ]
        ]); ?>
    </div>
</div>
