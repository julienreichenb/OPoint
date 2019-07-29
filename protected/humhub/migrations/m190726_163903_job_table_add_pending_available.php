<?php

use yii\db\Migration;

/**
 * Class m190726_163903_job_table_add_pending_available
 */
class m190726_163903_job_table_add_pending_available extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('job', 'pending', $this->boolean()->notNull()->defaultValue(true)->after('available'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('job', 'pending');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190726_163903_job_table_add_pending_available cannot be reverted.\n";

        return false;
    }
    */
}
