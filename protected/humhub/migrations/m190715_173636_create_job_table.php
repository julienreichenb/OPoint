<?php

use yii\db\Migration;

/**
 * Handles the creation of table `job`.
 */
class m190715_173636_create_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('job', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'idCreator' => $this->integer()->notNull(),
            'idValidator' => $this->integer()->notNull(),
            'idType' => $this->integer()->notNull(),
            'idSector' => $this->integer()->notNull(),
            'location' => $this->string()->notNull(),
            'rate' => $this->integer()->notNull(),
            'salary' => $this->float(),
            'startingDate' => $this->date(),
            'linkedInURL' => $this->string(),
            'available' => $this->boolean()->defaultValue(false),
            'url' => $this->string()->notNull()->unique()
        ]);

        $this->addForeignKey(
            'fk-job-idCreator',
            'job',
            'idCreator',
            'company',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-job-idValidator',
            'job',
            'idValidator',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-job-idType',
            'job',
            'idType',
            'jobtype',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-job-idSector',
            'job',
            'idSector',
            'worksector',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('job');
    }
}
