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
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "job".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $idCreator
 * @property integer $idValidator
 * @property integer $idType
 * @property integer $idSector
 * @property string $location
 * @property integer $rate
 * @property float $salary
 * @property Date $startingDate
 * @property string $linkedInURL
 * @property string $url
 * @property Company $creator
 * @property Company $company
 * @property User $validator
 * @property JobType $jobType
 * @property WorkSector $workSector
 *
 * Bachelor : Job model
 *
 */
class Job extends \humhub\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['name', 'description', 'location', 'rate'], 'required'],
            [['salary'], 'double'],
            [['startingDate'], 'date']
        ];

        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Libellé du poste',
            'description' => 'Description du poste (accessibilité, contact, ...)',
            'idType' => 'Type de tâches',
            'idSector' => "Secteur d'activité",
            'location' => 'Ville',
            'rate' => "Taux d'activité",
            'salary' => 'Salaire approximatif',
            'startingDate' => 'Début',
            'linkedInURL' => 'Lien vers LinkedIn',
        ];
    }

    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'idCreator']);
    }

    public function getValidator()
    {
        return $this->hasOne(User::class, ['id' => 'idValidator']);
    }

    public function getJobType()
    {
        return $this->hasOne(JobType::class, ['id' => 'idType']);
    }

    public function getWorkSector()
    {
        return $this->hasOne(WorkSector::class, ['id' => 'idSector']);
    }

    public function validateJob() {
        $this->idValidator = Yii::$app->getUser()->id;
        $this->available = 1;
        $this->pending = 0;
        $this->save(false);
    }

    public function denyJob() {
        $this->idValidator = Yii::$app->getUser()->id;
        $this->available = 0;
        $this->pending = 0;
        $this->save(false);
    }

    public function isValidated() {
        return $this->idValidator !== null;
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
