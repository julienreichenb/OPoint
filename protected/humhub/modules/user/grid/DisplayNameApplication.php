<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\grid;

use Yii;
use yii\bootstrap\Html;

/**
 * Bachelor : display name for the creator of the Application
 */
class DisplayNameApplication extends BaseColumn
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->attribute === null) {
            $this->attribute = 'user.profile.lastname';
        }

        if ($this->label === null) {
            $this->label = 'Nom';
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $user = $this->getUser($model->user);

        return '<div>' . Html::encode($user->displayName) . '<br> ' .
            '<small>' . Html::encode($user->username) . '</small></div>';
    }

}
