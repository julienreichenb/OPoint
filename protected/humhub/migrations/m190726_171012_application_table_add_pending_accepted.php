<?php

use yii\db\Migration;

/**
 * Class m190726_171012_application_table_add_pending_accepted
 */
class m190726_171012_application_table_add_pending_accepted extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('application', 'pending', $this->boolean()->notNull()->defaultValue(true));
        $this->addColumn('application', 'accepted', $this->boolean()->notNull()->defaultValue(false));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('application', 'pending');
        $this->dropColumn('application', 'accepted');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190726_171012_application_table_add_pending_accepted cannot be reverted.\n";

        return false;
    }
    */
}
