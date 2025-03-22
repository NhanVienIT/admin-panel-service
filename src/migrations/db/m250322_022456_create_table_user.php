<?php

use yii\db\Migration;

class m250322_022456_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        try{
            $this->createTable('{{%user}}', [
                'id' => $this->primaryKey(),
                'token' => $this->string(),
                'email' => $this->string(),
                'username' => $this->string(),
                'status' => $this->integer(),
                'password_hash' => $this->string(),
                'logged_at' => $this->dateTime(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ], $tableOptions);
            $this->createIndex('idx-user-email', '{{%user}}', 'email');
        }catch (Exception $exception){
            echo date("Y-m-d H:i:s") . " {$exception->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250322_022456_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
