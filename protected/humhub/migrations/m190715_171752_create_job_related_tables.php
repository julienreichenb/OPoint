<?php

use yii\db\Migration;

/**
 * Class m190715_171752_create_job_related_tables
 */
class m190715_171752_create_job_related_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->string(),
            'idUser' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-company-idUser',
            'company',
            'idUser',
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
        $this->dropTable('company');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_171752_create_job_related_tables cannot be reverted.\n";

        return false;
    }
    */
}
