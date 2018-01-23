<?php

use common\component\myMigration;

/**
 * Class m180123_075451_thread_table
 */
class m180123_075451_thread_table extends myMigration
{
	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$tableName = '{{thread}}';
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable($tableName,
				[
					'id' => $this->primaryKey(),
					'author_id' => $this->integer()->comment('创建人ID'),
					'created_at' => $this->timestamptz()->notNull()->defaultExpression("NOW()")->comment('创建时间'),
					'updated_at' => $this->timestamptz()->comment('更新时间'),
					'status' => $this->smallInteger()->comment('状态'),
					'title' => $this->string(64)->notNull()->comment('标题'),
					'content' => $this->text()->notNull()->comment('内容'),
					'comment_count' => $this->integer()->comment('回复数'),
					'updated_by' => $this->integer()->defaultValue(1)->comment('更新人ID'),
					'lastcomment_at' => $this->timestamptz()->comment('最新回复时间')
				],
				$tableOptions);

		$this->addForeignKey('thread_author_id_fkey', $tableName, 'author_id', 'user', 'id');
		$this->addForeignKey('thread_updated_by_fkey', $tableName, 'updated_by', 'user', 'id');
		$this->createIndex('fki_thread_fkey', $tableName, 'author_id');
		$this->createIndex('fki_thread_updated_by_fkey', $tableName, 'author_id');
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropTable('{{thread}}');
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m180123_075451_thread_table cannot be reverted.\n";

		return false;
	}
	*/
}
