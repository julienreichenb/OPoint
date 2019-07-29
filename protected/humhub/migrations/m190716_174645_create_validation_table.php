<?php

use yii\db\Migration;

/**
 * Handles the creation of table `validation`.
 */
class m190716_174645_create_validation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('validation', [
            'id' => $this->primaryKey(),
            'idUser' => $this->integer()->notNull(),
            'idValidator' => $this->integer(),
            'idGroupAsked' => $this->integer()->notNull(),
            'message' => $this->string()->notNull(),
            'reviewed' => $this->boolean()->defaultValue(false)
        ]);

        $this->addForeignKey(
            'fk-validation-idUser',
            'validation',
            'idUser',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-validation-idValidator',
            'validation',
            'idValidator',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-validation-idGroupAsked',
            'validation',
            'idGroupAsked',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('validation');
    }
}
