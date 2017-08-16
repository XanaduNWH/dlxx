<?php

use yii\db\Migration;

class m170217_073424_delete_permission extends Migration
{
    public function up()
    {
		$auth = Yii::$app->authManager;

		$admin = $auth->getRole('admin');

		// add "deletePost" permission
		$deletePost = $auth->createPermission('deletePost');
		$deletePost->description = 'Delete post';
		$auth->add($deletePost);

		// add the "deleteOwnPost" permission and associate the rule with it.
		$deleteOwnPost = $auth->createPermission('deleteOwnPost');
		$deleteOwnPost->description = 'Delete own post';
		$auth->add($deleteOwnPost);

		// "deletePost" will be used from "admin"
		$auth->addChild($admin, $deletePost);

		// "deletePost" will be used from "deleteOwnPost"
		$auth->addChild($deleteOwnPost, $deletePost);

		$auth->assign($deletePost, 1);

    }

    public function down()
    {
		$auth = Yii::$app->authManager;

		$admin = $auth->getRole('admin');
		$deletePost = $auth->getPermission('deletePost');
		$deleteOwnPost = $auth->getPermission('deleteOwnPost');

		$auth->removeChild($admin, $deleteOwnPost);
		$auth->removeChild($deleteOwnPost, $deletePost);

		$auth->remove($deleteOwnPost);
		$auth->remove($deletePost);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
