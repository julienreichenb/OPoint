<?php

use yii\db\Migration;

/**
 * Handles the creation of table `worksector`.
 */
class m190715_173614_create_worksector_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('worksector', [
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
        $this->dropTable('worksector');
    }
}
