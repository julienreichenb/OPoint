<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\models;

use humhub\modules\user\models\Validation;
use yii\base\InvalidArgumentException;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\user\models\User;

/**
 * Bachelor : Model to validate users
 */
class UserValidation extends User
{
    /**
     * @var \humhub\modules\user\components\ActiveQueryUser
     */
    public $query;

    /**
     * @var string a free text search
     */
    public $freeText;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = ($this->query == null) ? User::find() : $this->query;
        /* @var $query \humhub\modules\user\components\ActiveQueryUser */
        $query->joinWith(['validation', 'profile']);
        $query->where(['validation.reviewed' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'username',
                'validations.message',
                'profile.firstname',
                'profile.lastname',
            ]
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_ASC];

        $this->load($params);

        if (!$this->validate()) {
            $query->emulateExecution();
            return $dataProvider;
        }

        $query->joinWith(['profile', 'validation']);

        $query->andFilterWhere(['validation.reviewed' => 0]);
        $query->andFilterWhere(['id' => $this->id]);

        return $dataProvider;
    }

}