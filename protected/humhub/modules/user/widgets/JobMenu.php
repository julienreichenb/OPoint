<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\user\widgets;

use Yii;
use yii\helpers\Url;
use humhub\modules\admin\models\UserApprovalSearch;
use humhub\modules\admin\permissions\ManageUsers;
use humhub\modules\admin\permissions\ManageGroups;
use humhub\modules\admin\permissions\ManageSettings;
use humhub\modules\user\models\Invite;
use humhub\widgets\BaseMenu;

/**
 * Company Job Menu
 *
 * Bachelor : Job left menu
 */
class JobMenu extends \humhub\widgets\BaseMenu
{

    public $template = '@humhub/widgets/views/leftNavigation';
    public $type = "jobNavigation";
    public $id = "job-menu";

    public function init()
    {
        $user = Yii::$app->user;

        $this->addItemGroup([
            'id' => 'job',
            'label' => 'Portail <strong>emploi</strong>',
            'sortOrder' => 100,
        ]);

        if ($user->isCompany()) {
            $this->addItem([
                'label' => 'Mes offres',
                'url' => Url::to(['/user/offer/index']),
                'sortOrder' => 300,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer'),
            ]);
            $this->addItem([
                'label' => 'Candidatures',
                'url' => Url::to(['/user/application/index']),
                'sortOrder' => 400,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'application'),
            ]);
        }
        else {
            $this->addItem([
                'label' => 'Offres',
                'url' => Url::to(['/user/offer/index']),
                'sortOrder' => 300,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer'),
            ]);
            $this->addItem([
                'label' => 'Mes candidatures',
                'url' => Url::to(['/user/application/index']),
                'sortOrder' => 400,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'application'),
            ]);
        }

        parent::init();
    }

    public function addItem($item)
    {
        $item['group'] = 'job';

        parent::addItem($item);
    }

}
