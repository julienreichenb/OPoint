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
 * @property integer $idUser
 * @property integer $idValidator
 * @property integer $idGroupAsked
 * @property User $user
 * @property Group $group
 * @property string $message
 * @property boolean $reviewed
 */
class Validation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'validation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['id', 'message'], 'required'],
            [['id'], 'integer'],
        ];

        return $rules;
    }

    public function isSystemAdmin($cached = true)
    {
        if ($this->getUser()->_isSystemAdmin === null || !$cached) {
            $this->getUser()->_isSystemAdmin = ($this->getUser()->getGroups()->where(['is_admin_group' => '1'])->count() > 0);
        }

        return $this->getUser()->_isSystemAdmin;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['login'] = ['username', 'password'];
        $scenarios['editAdmin'] = ['username', 'email', 'status'];
        $scenarios['registration_email'] = ['username', 'email'];
        $scenarios['registration'] = ['username'];

        return $scenarios;
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'idUser']);
    }

    public function getValidator()
    {
        return $this->hasOne(User::class, ['id' => 'idValidator']);
    }

    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'idGroupAsked']);
    }

    public function denyValidation(){
        $this->reviewed = 1;
        $this->idValidator = Yii::$app->getUser()->id;
        $this->save(false);
    }

    public function acceptValidation(){
        $this->reviewed = 1;
        $this->idValidator = Yii::$app->getUser()->id;
        $user = User::findOne($this->idUser);
        $targetGroup = Group::findOne($this->idGroupAsked);
        $unregisteredGroup = Group::findOne(4);
        $unregisteredGroup->removeUser($user);
        $targetGroup->addUser($user);
        $user->save(false);
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
