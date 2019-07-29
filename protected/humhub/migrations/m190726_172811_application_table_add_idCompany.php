<?php

use yii\db\Migration;

/**
 * Class m190726_172811_application_table_add_idCompany
 */
class m190726_172811_application_table_add_idCompany extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('application', 'idCompany', $this->integer()->notNull());

        $this->addForeignKey(
            'fk-application-idCompany',
            'application',
            'idCompany',
            'company',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('application', 'idCompany');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190726_172811_application_table_add_idCompany cannot be reverted.\n";

        return false;
    }
    */
}
