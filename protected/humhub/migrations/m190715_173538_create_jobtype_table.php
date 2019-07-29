<?php

use yii\db\Migration;

/**
 * Handles the creation of table `jobtype`.
 */
class m190715_173538_create_jobtype_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('jobtype', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('jobtype');
    }
}
