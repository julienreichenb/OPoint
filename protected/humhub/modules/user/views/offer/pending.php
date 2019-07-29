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
 * Bachelor : list of current Job pending
 */
?>
<div class="panel-body">
    <h4><strong>Offres</strong> en attente de validation</h4>
    <div class="help-block">
        Veuillez accepter ou refuser ces offres. Les offres acceptées seront visibles publiquement.
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
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{accept} {deny} {view}',
                    'buttons' => [
                        'accept' => function($url, $model) {
                            return Html::a('<span class="fa fa-check"/>', $url, ['class' => 'btn btn-sm btn-success']);
                        },
                        'deny' => function($url, $model) {
                            return Html::a('<span class="fa fa-times"/>', $url, ['class' => 'btn btn-sm btn-danger']);
                        },
                        'view' => function($url, $model) {
                            return Html::a('<span class="fa fa-eye"/>', $url, ['class' => 'btn btn-sm btn-info']);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url = 'index.php?r=user%2Foffer/view&id='.$model['id'];
                            return $url;
                        }
                        if ($action === 'accept') {
                            $url = 'index.php?r=user%2Foffer/accept&id='.$model['id'];
                            return $url;
                        }
                        if ($action === 'deny') {
                            $url = 'index.php?r=user%2Foffer/deny&id='.$model['id'];
                            return $url;
                        }
                    }
                ]
            ]
        ]); ?>
    </div>
</div>
