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
 * Description of JobPendingList
 *
 * Bachlor : model to display the Jobs pending in list
 */
class JobPendingList extends Job
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
        $query = ($this->query == null) ? Job::find() : $this->query;
        /* @var $query \humhub\modules\user\components\ActiveQueryUser */
        $query->joinWith('company');
        $query->where(['pending' => 1]);

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
}
