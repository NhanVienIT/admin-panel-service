<?php

use yii\db\Migration;

class m250322_022532_create_table_brands extends Migration
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
            $this->createTable('{{%brands}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'logo' => $this->string(),
                'status' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ], $tableOptions);
            $this->createIndex('idx-brands-name', '{{%brands}}', 'name');
            $this->createIndex('idx-brands-logo', '{{%brands}}', 'logo');
        }catch (Exception $exception){
            echo date("Y-m-d H:i:s") . " {$exception->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%brands}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250322_022532_create_table_brands cannot be reverted.\n";

        return false;
    }
    */
}
