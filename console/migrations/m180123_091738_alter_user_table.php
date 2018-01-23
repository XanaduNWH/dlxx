<?php

use common\component\myMigration;

/**
 * Class m180123_091738_alter_user_table
 */
class m180123_091738_alter_user_table extends myMigration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$userTable = '{{%user}}';
		$this->dropColumn($userTable, 'created_at');
		$this->dropColumn($userTable, 'updated_at');
		$this->addColumn($userTable, 'created_at', $this->timestamptz()->notNull()->defaultExpression("NOW()"));
		$this->addColumn($userTable, 'updated_at', $this->timestamptz());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_091738_alter_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_091738_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
