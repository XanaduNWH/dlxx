<?php

use common\component\myMigration;

/**
 * Class m180118_075441_alter_oauth_client_table
 */
class m180118_075441_alter_oauth_client_table extends myMigration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->dropColumn('{{%oauth2_client}}', 'created_at');
		$this->dropColumn('{{%oauth2_client}}', 'updated_at');
		$this->dropColumn('{{%oauth2_client}}', 'updated_by');
		$this->addColumn('{{%oauth2_client}}', 'updated_at', $this->timestamptz());
		$this->addColumn('{{%oauth2_client}}', 'created_at', $this->timestamptz()->notNull()->defaultExpression('NOW()'));
		$this->addColumn('{{%oauth2_client}}', 'updated_by', $this->integer());
		$this->addColumn('{{%oauth2_client}}', 'title', $this->string()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180118_075441_alter_oauth_client_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180118_075441_alter_oauth_client_table cannot be reverted.\n";

        return false;
    }
    */
}
