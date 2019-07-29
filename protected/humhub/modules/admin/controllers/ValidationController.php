<?php
/**
 * Bachelor : Validation controller
 */

namespace humhub\modules\admin\controllers;

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
use Yii;
use yii\db\Query;
use yii\web\HttpException;

class ValidationController extends Controller
{
    /**
     * @inheritdoc
     */
    public $adminOnly = false;

    public function init()
    {
        $this->subLayout = '@admin/views/layouts/user';
        $this->appendPageTitle('Validation');

        return parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getAccessRules()
    {
        return [
            ['permissions' => ManageGroups::class],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can([new ManageUsers(), new ManageGroups()])) {
            $searchModel = new UserValidation();
            $searchModel->status = User::STATUS_ENABLED;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
            ]);
        } elseif (Yii::$app->user->can(ManageSettings::class)) {
            return $this->redirect(['/admin/authentication']);
        } else {
            return $this->forbidden();
        }
    }

    public function actionAccept($id){
        $user = User::findOne($id);
        $user->validation->acceptValidation();
        return $this->redirect(['index']);
    }

    public function actionDeny($id){
        $user = User::findOne($id);
        $user->validation->denyValidation();
        return $this->redirect(['index']);
    }
}
