<?php

use yii\db\Migration;

/**
 * Class m180124_014000_alter_auth_assignment
 */
class m180124_014000_alter_auth_assignment extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180124_014000_alter_auth_assignment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180124_014000_alter_auth_assignment cannot be reverted.\n";

        return false;
    }
    */
}
