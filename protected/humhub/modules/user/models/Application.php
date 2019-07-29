<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\models;

use humhub\modules\user\authclient\AuthClientHelpers;
use humhub\modules\user\models\fieldtype\Date;
use Yii;
use humhub\modules\user\models\Job;
use humhub\modules\user\models\User;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property integer $idUser
 * @property integer $idJob
 * @property integer $idCompany
 * @property string $letter
 * @property boolean $pending
 * @property boolean $accepted
 * @property string $url
 * @property User $applicant
 * @property Job $job
 * @property Company $company
 * @property Profile $profile
 *
 * Bachelor : Application model
 *
 */
class Application extends \humhub\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['letter'], 'required'],
        ];

        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'letter' => 'Lettre de motivation'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'idUser']);
    }

    public function getJob()
    {
        return $this->hasOne(Job::class, ['id' => 'idJob']);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'idCompany']);
    }

    public function getProfile()
    {
        return Profile::findOne(['user_id' => 'idUser']);
    }
    public function acceptApplication() {
        $this->accepted = 1;
        $this->pending = 0;
        $this->save(false);
    }

    public function denyApplication() {
        $this->accepted = 0;
        $this->pending = 0;
        $this->save(false);
    }

    /**
     * Checks if the given column name already exists on the profile table.
     *
     * @param String $name
     * @return Boolean
     */
    public static function columnExists($name)
    {
        Yii::$app->getDb()->getSchema()->refreshTableSchema(self::tableName());
        $table = Yii::$app->getDb()->getSchema()->getTableSchema(self::tableName(), true);
        $columnNames = $table->getColumnNames();

        return (in_array($name, $columnNames));
    }
}
