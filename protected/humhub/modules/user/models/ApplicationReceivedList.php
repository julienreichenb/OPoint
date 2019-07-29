<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\models;

use yii\base\InvalidArgumentException;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Application;
use humhub\modules\user\models\Job;

/**
 * Description of ApplicationCurrentList
 *
 * Bachlor : model to display the Application received in list
 */
class ApplicationReceivedList extends Application
{
    /**
     * @var \humhub\modules\user\components\ActiveQueryUser
     */
    public $query;

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $id_company = $this->getCompanyId();
        $query = ($this->query == null) ? Application::find() : $this->query;
        /* @var $query \humhub\modules\user\components\ActiveQueryUser */
        $query->joinWith('user');
        $query->joinWith('job');
        $query->joinWith('company');
        $query->where(['idCompany' => $id_company]);
        $query->andWhere(['application.pending' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id'
            ]
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        $this->load($params);
        $query->joinWith(['user', 'company', 'job']);

        return $dataProvider;
    }

    private function getCompanyId()
    {
        $company = Company::findOne(['idUser' => Yii::$app->user->id]);
        return $company->id;
    }
}
