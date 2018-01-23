<?php

use common\component\myMigration;

/**
 * Class m180123_075508_comments_table
 */
class m180123_075508_comments_table extends myMigration
{
	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$tableName = '{{comments}}';
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable($tableName,
				[
					'id' => $this->primaryKey(),
					'thread_id' => $this->integer()->notNull()->comment('主题ID'),
					'author_id' => $this->integer()->notNull()->comment('回复者者ID'),
					'author_email' => $this->string()->notNull()->comment('回复者邮箱'),
					'author_ip' => $this->string(50)->comment('回复者IP地址'),
					'created_at' => $this->timestamptz()->notNull()->defaultExpression("NOW()")->comment('回复时间'),
					'updated_at' => $this->timestamptz()->comment('更新时间'),
					'approve_status' => $this->smallInteger()->comment('审核状态'),
					'reply_to' => $this->integer()->comment('回复给'),
					'content' => $this->text()->notNull()->comment('内容')
				], $tableOptions);

		$this->addForeignKey('comments_author_id_fkey', $tableName, 'author_id', 'user', 'id');
		$this->addForeignKey('comments_thread_id_fkey', $tableName, 'thread_id', 'thread', 'id');
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropTable('{{comments}}');
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180123_075508_comments_table cannot be reverted.\n";

		return false;
	}
	*/
}
