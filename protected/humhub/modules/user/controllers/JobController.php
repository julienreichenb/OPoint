<?php
namespace humhub\modules\user\controllers;

use humhub\compat\HForm;
use humhub\components\export\DateTimeColumn;
use humhub\components\export\SpreadsheetExport;
use humhub\modules\admin\components\Controller;
use humhub\modules\admin\models\forms\UserDeleteForm;
use humhub\modules\admin\models\forms\UserEditForm;
use humhub\modules\admin\models\UserSearch;
use humhub\modules\admin\models\UserValidation;
use humhub\modules\admin\permissions\ManageGroups;
use humhub\modules\admin\permissions\ManageSettings;
use humhub\modules\admin\permissions\ManageUsers;
use humhub\modules\user\models\forms\Registration;
use humhub\modules\user\models\Invite;
use humhub\modules\user\models\ProfileField;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Job;
use humhub\modules\user\models\JobType;
use humhub\modules\user\models\WorkSector;
use Yii;
use yii\db\Query;
use yii\web\HttpException;

/**
 * Bachelor : controller for Job part
 */

class JobController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'verbs' => ['POST']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        $this->subLayout = '@user/views/layouts/offer';
        $this->appendPageTitle('Emploi');

        return parent::init();
    }

    public function actionIndex()
    {
        return $this->redirect(['offer/index']);
    }
}
