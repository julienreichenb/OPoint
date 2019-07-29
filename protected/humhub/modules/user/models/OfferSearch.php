<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\models;

use yii\data\ActiveDataProvider;

/**
 * Description of OfferSearch
 *
 * Bachlor : model to display the Jobs offers in list with filters
 */
class OfferSearch extends JobCurrentList
{
    /**
     * @var string a free text search
     */
    public $freeText;

    /**
     * @var string a free location search
     */
    public $locationCriteria;

    /**
     * @var integer for sector criteria
     */
    public $sectorCriteria;

    /**
     * @var integer for type criteria
     */
    public $typeCriteria;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['freeText', 'locationCriteria', 'typeCriteria', 'sectorCriteria'], 'safe'],
        ];
    }

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
        $query->andWhere(['available' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'available',
                'name',
                'description',
                'company.name',
                'company.description',
                'worksector.name',
                'jobtype.name'
            ]
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        $this->load($params);
        $query->joinWith(['company', 'workSector', 'jobType']);

        if(!empty($this->freeText)) {
            $query->andWhere(['OR',
                ['like', 'job.name', $this->freeText],
                ['like', 'job.description', $this->freeText],
                ['like', 'job.rate', $this->freeText],
                ['like', 'job.salary', $this->freeText],
                ['like', 'company.name', $this->freeText],
                ['like', 'company.description', $this->freeText]
            ]);
        }
        if(!empty($this->locationCriteria)) {
            $query->andWhere(['OR',
                ['like', 'job.location', $this->locationCriteria]
            ]);
        }
        if(!empty($this->sectorCriteria)) {
            $query->andWhere(['OR',
                ['like', 'workSector.id', $this->sectorCriteria]
            ]);
        }
        if(!empty($this->typeCriteria)) {
            $query->andWhere(['OR',
                ['like', 'jobType.id', $this->typeCriteria]
            ]);
        }
            return $dataProvider;
    }
}
