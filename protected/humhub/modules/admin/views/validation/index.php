<?php

use humhub\modules\admin\grid\UserActionColumn;
use humhub\modules\admin\models\UserSearch;
use humhub\modules\admin\widgets\ExportButton;
use humhub\modules\user\grid\DisplayNameColumn;
use humhub\modules\user\grid\ImageColumn;
use humhub\widgets\Button;
use humhub\widgets\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * Bachelor : list of pending validation
 */
?>
<div class="panel-body">
    <h4>Validations en attente</h4>
    <div class="help-block">
        Les demandes de validation en attente peuvent être traitées ci-dessous.
    </div>

    <br/>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'columns' => [
                ['class' => DisplayNameColumn::class],
                [
                    'label' => 'Groupe utilisateur',
                    'value' => function($model) {
                        return ($model->validation->idGroupAsked == 2)
                                ? 'Membre' : 'Entreprise';
                        }
                ],
                [
                    'label' => 'Message',
                    'value' => 'validation.message',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{accept} {deny}',
                    'buttons' => [
                        'accept' => function($url, $model) {
                                return Html::a('Accepter', $url, ['class' => 'btn btn-sm btn-success']);
                        },
                        'deny' => function($url, $model) {
                                return Html::a('Refuser', $url, ['class' => 'btn btn-sm btn-danger']);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'accept') {
                            $url = 'index.php?r=admin%2Fvalidation/accept&id='.$model['id'];
                            return $url;
                        }
                        if ($action === 'deny') {
                            $url = 'index.php?r=admin%2Fvalidation/deny&id='.$model['id'];
                            return $url;
                        }
                    }
                ]
            ]
        ]); ?>
    </div>
</div>
