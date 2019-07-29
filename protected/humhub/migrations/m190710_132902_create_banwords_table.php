<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banwords`.
 */
class m190710_132902_create_banwords_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('banwords', [
            'id' => $this->primaryKey(),
            'word' => $this->string()->notNull()->unique(),
            'addedBy' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-banwords-addedBy',
            'banwords',
            'addedBy',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('banwords');
    }
}
