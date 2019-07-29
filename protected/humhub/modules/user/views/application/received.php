<?php

use humhub\modules\admin\grid\UserActionColumn;
use humhub\modules\admin\models\UserSearch;
use humhub\modules\admin\widgets\ExportButton;
use humhub\modules\user\grid\DisplayNameColumn;
use humhub\modules\user\grid\ImageColumn;
use humhub\widgets\Button;
use humhub\modules\user\grid\JobTypesColumn;
use humhub\modules\user\grid\DisplayNameApplication;
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
        Pour accéder à la candidature, cliquez sur le bouton <span class="fa fa-eye"></span>
    </div>

    <br/>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'columns' => [
                ['class' => DisplayNameApplication::class],
                [
                    'label' => 'Offre',
                    'value' => 'job.name'
                ],
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
                            $url = 'index.php?r=user%2Fapplication/view&id='.$model['id'];
                            return $url;
                        }
                        if ($action === 'accept') {
                            $url = 'index.php?r=user%2Fapplication/accept&id='.$model['id'];
                            return $url;
                        }
                        if ($action === 'deny') {
                            $url = 'index.php?r=user%2Fapplication/deny&id='.$model['id'];
                            return $url;
                        }
                    }
                ]
            ]
        ]); ?>
    </div>
</div>
