<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\models;

use humhub\modules\user\authclient\AuthClientHelpers;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * Bachelor : JobType model
 *
 */
class JobType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jobtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
        ];

        return $rules;
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
