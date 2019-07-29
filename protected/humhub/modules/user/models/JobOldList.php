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

/**
 * Description of JobOldList
 *
 * Bachlor : model to display the old Jobs offers in list
 */
class JobOldList extends Job
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
        $query = ($this->query == null) ? Job::find() : $this->query;
        /* @var $query \humhub\modules\user\components\ActiveQueryUser */
        $query->joinWith('company');
        $query->where(['idCreator' => $id_company]);
        $query->andWhere(['available' => 0]);
        $query->andWhere(['pending' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'available',
                'company.name',
                'description',
                'worksector.name',
                'jobtype.name'
            ]
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        $this->load($params);
        $query->joinWith(['company', 'workSector', 'jobType']);

        return $dataProvider;
    }

    private function getCompanyId()
    {
        $company = Company::findOne(['idUser' => Yii::$app->user->id]);
        return $company->id;
    }

}
