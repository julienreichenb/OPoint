<?php

use yii\helpers\Url;
use yii\helpers\Html;
use humhub\modules\custom_pages\models\Page;
use humhub\modules\custom_pages\components\Container;

/* @var $pages array */
/* @var $label string */
/* @var $subNav string */

// Todo: use new ContentContainerHelper class prior to 1.3
$sguid = Yii::$app->request->get('sguid') ? Yii::$app->request->get('sguid') : Yii::$app->request->get('cguid');

?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('CustomPagesModule.base', '<strong>Custom</strong> Pages'); ?></div>
    <?= $subNav ?>
    <div class="panel-body">
        <div class="clearfix">
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('CustomPagesModule.views_common_list', 'Create new {label}', ['label' => $label]), Url::to(['add', 'sguid' => $sguid]), ['data-ui-loader' => '', 'class' => 'pull-right btn btn-success']); ?>
            <h4><?= Yii::t('CustomPagesModule.base', 'Overview') ?></h4>
            <div class="help-block">
                <?= Yii::t('CustomPagesModule.views_common_list', 'This page lists all available {label} entries.', ['label' => $label]); ?>
            </div>
        </div>
        <br>
        <?php if (is_array($pages) && count($pages)) : ?>
            <?php $classes = Page::getNavigationClasses(); ?>
            <?php $isMainPage = $pages[0] instanceof Page; ?>
           
            <table class="table">
                <tr>
                    <th><?= Yii::t('CustomPagesModule.base', 'Title'); ?></th>
                    <?php if ($isMainPage) : ?>
                        <th><?= Yii::t('CustomPagesModule.base', 'Navigation'); ?></th>
                    <?php endif; ?>
                    <th><?= Yii::t('CustomPagesModule.base', 'Type'); ?></th>
                    <th><?= Yii::t('CustomPagesModule.base', 'Sort Order'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($pages as $page) : ?>
                <?php $editUrl = Url::to(['edit', 'id' => $page->id, 'sguid' => $sguid]); ?>
                    <tr>
                        <td><i class="fa <?= Html::encode($page->icon); ?>"></i> <?= Html::a(Html::encode($page->title), $editUrl); ?></td>
                        <?php if ($isMainPage) : ?>
                            <td><?= $classes[$page->navigation_class]; ?></td>
                        <?php endif; ?>
                        <td><?= Container::getLabel($page->type); ?></td>
                        <td><?= $page->sort_order; ?></td>
                        <td><?= Html::a('<i class="fa fa-pencil"></i>', $editUrl, ['class' => 'btn btn-primary btn-xs pull-right']); ?></td>
                    </tr>

                <?php endforeach; ?>
            </table>

        <?php else: ?>
            <div class="alert alert-info" role="alert" style="margin-bottom:0px;">
                <?= Yii::t('CustomPagesModule.views_common_list', 'No {label} entry created yet!', ['label' => $label]); ?>
            </div>
        <?php endif; ?>

    </div>
</div>
