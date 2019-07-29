<?php

use humhub\modules\user\grid\JobTypesColumn;
use humhub\modules\user\models\Job;
use humhub\modules\user\models\Company;
use humhub\modules\user\models\JobType;
use humhub\modules\user\models\WorkSector;
use humhub\widgets\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * Bachelor : view for a Job details
 *
 * @var $job Job
 * @var $company Company
 * @var $type JobType
 * @var $sector WorkSector
 */
?>

<div class="panel-body">
    <div class="pull-right">
        <?php
        $user = Yii::$app->user;
        if($job->idCreator === $user->id || $user->isAdmin()){
            if($job->available) {
                echo Html::a("Annuler l'offre", ['/user/offer/deny', 'id' => $job->id], ['class' => 'btn btn-sm btn-danger']);
                echo ' ';
            }
            echo Html::a("Modifier l'offre", ['/user/offer/edit', 'id' => $job->id], ['class' => 'btn btn-sm btn-info']);
        } else {
            echo Html::a('Déposer une candidature', ['/user/application/create', 'idJob' => $job->id], ['class' => 'btn btn-sm btn-success']);
        }
        ?>
    </div>

    <h2><strong><?= $job->name ?></strong></h2>
    <h6><strong>Taux d'activité</strong> : <?= $job->rate ?>% </h6>
    <br>
    <div>
        <h5><?= $job->description ?></h5>
    </div>
    <br>
    <div class="row">
        <h5 class="col-md-4"><strong>Type d'emploi</strong> : <?= $type->name ?></h5>
        <h5 class="col-md-4"><strong>Secteur d'activité</strong> : <?= $sector->name ?></h5>
    </div>
    <br>
    <?php if($job->startingDate !== null){
        echo
        '<div>
            <h6><strong>Date de début : </strong>' . $job->startingDate . '</h6>
        </div>';
    }
    ?>
    <?php if($job->salary !== null){
        echo
        '<div>
            <h6><strong>Salaire approximatif : </strong>' . $job->salary . ' CHF</h6>
        </div>
        <br>';
    }
    ?>
    <hr>
    <div class="card">
        <h4 class="card-header"><strong><i>Qui sommes-nous ?</i></strong></h4>
        <div class="card-body">
            <h4 class="card-title"><?= $company->name ?></h4>
            <h5 class="card-text"><?= $company->description ?></h5>
        </div>
    </div>
    <br>
    <div class="text-center">
        <?php
        if($job->available && !$user->isCompany() || $user->isAdmin()){
            echo Html::a('<span class="fa fa-pencil-square-o"></span> Déposer une candidature', ['/user/application/create', 'idJob' => $job->id], ['class' => 'btn btn-success btn-lg']);
        }
        ?>
    </div>
</div>