<?php
namespace humhub\modules\user\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\user\models\Application;
use humhub\modules\user\models\ApplicationCurrentList;
use humhub\modules\user\models\ApplicationReceivedList;
use humhub\modules\user\models\Job;
use Yii;

/**
 * Bachelor : controller for Applications
 */

class ApplicationController extends Controller
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
        $this->subLayout = '@user/views/layouts/application';
        $this->appendPageTitle('Emploi - Candidatures');

        return parent::init();
    }

    public function actionIndex()
    {
        $user = Yii::$app->user;
        if ($user->isCompany())
        {
            return $this->redirect(['received']);
        }
        return $this->redirect(['sent']);
    }

    public function actionCreate($idJob)
    {
        $model = new Application;

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $POST_VARIABLE = Yii::$app->request->post('Application');
            $model->idJob = $idJob;
            $model->idUser = Yii::$app->user->id;
            $model->idCompany = Job::findOne(['id' => $model->idJob])->idCreator;
            $model->letter = $POST_VARIABLE['letter'];

            $model->save(false);

            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionSent()
    {
        $user = Yii::$app->user;
        if($user->isCompany()){
            return $this->redirect(['received']);
        }

        $listModel = new ApplicationCurrentList();
        $dataProvider = $listModel->search(Yii::$app->request->queryParams);

        return $this->render('sent',
            [
                'dataProvider' => $dataProvider,
                'listModel' => $listModel
            ]);
    }

    public function actionReceived()
    {
        $user = Yii::$app->user;
        if(!$user->isCompany()){
            return $this->redirect(['sent']);
        }

        $listModel = new ApplicationReceivedList();
        $dataProvider = $listModel->search(Yii::$app->request->queryParams);

        return $this->render('received',
            [
                'dataProvider' => $dataProvider,
                'listModel' => $listModel
            ]);
    }

    public function actionView($id)
    {
        $application = Application::findOne(['id' => $id]);
        return $this->render('view',
            ['application' => $application]);
    }

    public function actionAccept($id)
    {
        $application = Application::findOne($id);
        $application->acceptApplication();
        return $this->redirect(['received']);
    }

    public function actionDeny($id)
    {
        $application = Application::findOne($id);
        $application->denyApplication();
        return $this->redirect(['received']);
    }

}
