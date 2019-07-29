<?php
namespace humhub\modules\user\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\user\models\Company;
use humhub\modules\user\models\JobCurrentList;
use humhub\modules\user\models\JobOldList;
use humhub\modules\user\models\JobPendingList;
use humhub\modules\user\models\OfferSearch;
use humhub\modules\user\models\Job;
use humhub\modules\user\models\JobType;
use humhub\modules\user\models\WorkSector;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Bachelor : controller for Offers
 */

class OfferController extends Controller
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
        $this->appendPageTitle('Emploi - Offres');

        return parent::init();
    }

    public function actionIndex()
    {
        $user = Yii::$app->user;
        if ($user->isAdmin())
        {
            return $this->redirect(['pending']);
        }
        if ($user->isCompany())
        {
            return $this->render('create');
        }
        return $this->redirect(['search']);
    }

    public function actionCreate()
    {
        $model = new Job;

        $types = ArrayHelper::map(JobType::find()->all(), 'id', 'name');
        $sectors = ArrayHelper::map(WorkSector::find()->all(), 'id', 'name');

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $POST_VARIABLE = Yii::$app->request->post('Job');
            $model->idCreator = $this->getCompany()[0]['id'];
            $model->name = $POST_VARIABLE['name'];
            $model->description = $POST_VARIABLE['description'];
            $model->idType = $POST_VARIABLE['idType'];
            $model->idSector = $POST_VARIABLE['idSector'];
            $model->location = $POST_VARIABLE['location'];
            $model->url = str_replace(' ', '', $model->name) . '-' . str_replace(' ', '',$this->getCompany()[0]['name']) . '-' . $model->location;
            $model->salary = $POST_VARIABLE['salary'];
            $model->rate = $POST_VARIABLE['rate'];
            $model->linkedInURL = $POST_VARIABLE['linkedInURL'];
            $model->startingDate = $POST_VARIABLE['startingDate'];
            $model->save(false);

            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model, 'types' => $types, 'sectors' => $sectors]);
    }

    public function actionEdit($id)
    {
        $model = Job::findOne(['id' => $id]);

        $types = ArrayHelper::map(JobType::find()->all(), 'id', 'name');
        $sectors = ArrayHelper::map(WorkSector::find()->all(), 'id', 'name');
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $POST_VARIABLE = Yii::$app->request->post('Job');
            $model->idCreator = $this->getCompany()[0]['id'];
            $model->name = $POST_VARIABLE['name'];
            $model->description = $POST_VARIABLE['description'];
            $model->idType = $POST_VARIABLE['idType'];
            $model->idSector = $POST_VARIABLE['idSector'];
            $model->location = $POST_VARIABLE['location'];
            $model->url = str_replace(' ', '', $model->name) . '-' . str_replace(' ', '',$this->getCompany()[0]['name']) . '-' . $model->location;
            $model->salary = $POST_VARIABLE['salary'];
            $model->rate = $POST_VARIABLE['rate'];
            $model->linkedInURL = $POST_VARIABLE['linkedInURL'];
            $model->startingDate = $POST_VARIABLE['startingDate'];
            $model->pending = true;
            $model->available = false;
            $model->save(false);

            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model, 'types' => $types, 'sectors' => $sectors]);
    }

    public function actionCurrent()
    {
        $user = Yii::$app->user;
        if(!$user->isCompany()){
            return $this->render('search');
        }

        $listModel = new JobCurrentList();
        $dataProvider = $listModel->search(Yii::$app->request->queryParams);

        return $this->render('current', [
            'dataProvider' => $dataProvider,
            'listModel' => $listModel
        ]);
    }

    public function actionOld()
    {
        $user = Yii::$app->user;
        if(!$user->isCompany()){
            return $this->render('search');
        }

        $listModel = new JobOldList();
        $dataProvider = $listModel->search(Yii::$app->request->queryParams);

        return $this->render('old', [
            'dataProvider' => $dataProvider,
            'listModel' => $listModel
        ]);
    }

    public function actionSearch()
    {
        $user = Yii::$app->user;
        if($user->isCompany()){
            return $this->redirect(['index']);
        }

        $types = ArrayHelper::map(JobType::find()->all(), 'id', 'name');
        $sectors = ArrayHelper::map(WorkSector::find()->all(), 'id', 'name');

        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'types' => $types,
            'sectors' => $sectors
        ]);
    }

    public function actionPending()
    {
        $user = Yii::$app->user;
        if(!$user->isAdmin()) {
            if($user->isCompany()){
                return $this->render('create');
            }
            return $this->render('search');
        }

        $listModel = new JobPendingList();
        $dataProvider = $listModel->search(Yii::$app->request->queryParams);

        return $this->render('pending', [
            'dataProvider' => $dataProvider,
            'listModel' => $listModel
        ]);
    }

    public function actionView($id)
    {
        $user = Yii::$app->user;
        $job = Job::findOne(['id' => $id]);

        //If user is not an admin and the offer is not approved : access is denied
        if(!$user->isAdmin() && !$job->isValidated()){
            return $this->render('search');
        }
        //If user is a company but is not the creator : access denied
        if($user->isCompany() && $job->idCreator ==! $user->id){
            return $this->render('create');
        }

        $company = Company::findOne(['id' => $job->idCreator]);
        $type = JobType::findOne(['id' => $job->idType]);
        $sector = WorkSector::findOne(['id' => $job->idSector]);
        return $this->render('view',
            ['job' => $job, 'company' => $company, 'type' => $type, 'sector' => $sector]);
    }

    public function actionAccept($id)
    {
        $job = Job::findOne($id);
        $job->validateJob();
        return $this->redirect(['pending']);
    }

    public function actionDeny($id)
    {
        $job = Job::findOne($id);
        $job->denyJob();

        $user = Yii::$app->user;
        if($user->isAdmin()){
            return $this->redirect(['pending']);
        }
        return $this->redirect(['current']);
    }

    private function getCompany(){
        $user = Yii::$app->user;
        if($user->isCompany()) {
            $company = $query = (new Query())->select(['id', 'name'])
                ->from('company')
                ->where(['idUser' => $user->id])
                ->all();
            return $company;
        }
        return null;
    }
}
