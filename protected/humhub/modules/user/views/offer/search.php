<?php

use humhub\modules\user\grid\JobTypesColumn;
use humhub\modules\user\models\OfferSearch;
use humhub\widgets\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var $searchModel OfferSearch
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
?>

<div class="panel-body">
    <h4><?= 'Rechercher des <strong>offres</strong>'; ?></h4>
    <div class="help-block">
        <?= 'Vous pouvez filtrer la liste des résultats selon vos propres critères.'; ?>
    </div>

    <br />

    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($searchModel, 'freeText')->label('Vos mots-clé')->textInput(['placeholder' => "Vos critères (accessibilité, intérêts, ...)"]) ?>
            <?= $form->field($searchModel, 'locationCriteria')->label('Ville, canton ou région')->textInput(['placeholder' => "Lausanne, Vaud, Riviera, ..."]) ?>
            <?= $form->field($searchModel, 'typeCriteria')->dropDownList($types,array('prompt'=>''))->label("Type de tâches"); ?>
            <?= $form->field($searchModel, 'sectorCriteria')->dropDownList($sectors,array('prompt'=>''))->label("Secteur d'activité"); ?>
            <span>
                <button class="btn btn-info" type="submit">Rechercher</button>
            </span>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <br>

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
            ],
        ]); ?>
    </div>
</div>