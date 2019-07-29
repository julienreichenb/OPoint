<?php

use yii\db\Migration;

/**
 * Handles the creation of table `application`.
 */
class m190715_174117_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'idUser' => $this->integer()->notNull(),
            'idJob' => $this->integer()->notNull(),
            'letter' => $this->string(),
            'url' => $this->string()->unique()
        ]);

        $this->addForeignKey(
            'fk-application-idUser',
            'application',
            'idUser',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-application-idJob',
            'application',
            'idJob',
            'job',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('application');
    }
}
