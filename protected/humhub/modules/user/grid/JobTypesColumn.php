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
 * DisplayNameColumn
 *
 * Bachelor : custom column for Job display
 */
class JobTypesColumn extends BaseColumn
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->attribute === null) {
            $this->attribute = 'workSector.name';
        }

        if ($this->label === null) {
            $this->label = "Secteur d'activité";
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $job = $this->getUser($model);

        return '<div>' . Html::encode($job->jobType->name). '<br> ' .
            '<small>' . Html::encode($job->workSector->name) . '</small></div>';
    }

}
