<?php

namespace humhub\modules\user\models\forms;

use Yii;
use yii\base\Model;
use humhub\modules\user\authclient\BaseFormAuth;

use humhub\modules\user\libs\Ldap;


/**
 * Bachelor : Validation is the model behind the validation form.
 */

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $message
 * @property integer $idUser
 * @property integer $idGroupAsked
 * @property integer $idValidator
 * @property boolean $reviewed
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 *
 **/
class Validation extends \humhub\components\ActiveRecord
{

    public static function tableName()
    {
        return 'validation';
    }

    public function rules()
    {
        return [
          ['message', 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
          'message' => 'Présentez-vous brièvement aux modérateurs du site et indiquez-nous pourquoi vous souhaitez rejoindre la communauté.',
          'idGroupAsked' => 'Représentez-vous une entreprise ou un office de placement ?'
        ];
    }

    public function isAlreadyInQueue()
    {
        $submitted_validation = (new \yii\db\Query())
            ->select(['id'])
            ->from('validation')
            ->where(['idUser' => Yii::$app->user->id, 'reviewed' => 0])
            ->all();

        if(sizeof($submitted_validation) != 0)
            return true;

        return false;
    }
}