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
 * Offer tab menu
 */
class OfferTabMenu extends BaseMenu
{

    public $template = '@humhub/widgets/views/tabMenu';
    public $type = 'offerSubNavigation';

    public function init()
    {
        $user = Yii::$app->user;

        if($user->isAdmin()) {
            $this->addItem([
                'label' => 'À valider',
                'url' => Url::to(['/user/offer/pending']),
                'sortOrder' => 100,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer' && Yii::$app->controller->action->id == 'pending')
            ]);
        }

        if ($user->isCompany()) {
            $this->addItem([
                'label' => 'Nouvelle offre',
                'url' => Url::to(['/user/offer/create']),
                'sortOrder' => 100,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer' && Yii::$app->controller->action->id == 'create')
            ]);

            $this->addItem([
                'label' => 'En cours',
                'url' => Url::to(['/user/offer/current']),
                'sortOrder' => 200,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer' && Yii::$app->controller->action->id == 'current')
            ]);

            $this->addItem([
                'label' => 'Historique',
                'url' => Url::to(['/user/offer/old']),
                'sortOrder' => 300,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer' && Yii::$app->controller->action->id == 'old')
            ]);
        }
        else {
            $this->addItem([
                'label' => 'Recherche',
                'url' => Url::to(['/user/offer/search']),
                'sortOrder' => 400,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'user' && Yii::$app->controller->id == 'offer' && Yii::$app->controller->action->id == 'search')
            ]);
        }

        parent::init();
    }

}
