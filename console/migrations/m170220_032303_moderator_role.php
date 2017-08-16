<?php

use yii\db\Migration;

class m170220_032303_moderator_role extends Migration
{
    public function up()
    {
		$auth = Yii::$app->authManager;

		$author = $auth->getRole('author');
		$deletePost = $auth->getPermission('deletePost');

		// add "moderator" role
		$moderator = $auth->createRole('moderator');
		$auth->add($moderator);

		// allow "author" will be used from "moderator"
		$auth->addChild($moderator, $author);

		// allow "deletePost" will be used from "moderator"
		$auth->addChild($moderator, $deletePost);

		$auth->assign($moderator, 2);
    }

    public function down()
    {
		$auth = Yii::$app->authManager;

		$author = $auth->getRole('author');
		$moderator =$auth->getRole('moderator');
		$deletePost = $auth->getPermission('deletePost');

		$auth->removeChild($moderator, $author);
		$auth->removeChild($moderator, $deletePost);

		$auth->remove($moderator);
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
