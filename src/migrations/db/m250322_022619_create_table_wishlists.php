<?php

use yii\db\Migration;

class m250322_022619_create_table_wishlists extends Migration
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
            $this->createTable('{{%wishlists}}', [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(),
                'product_id' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ], $tableOptions);
        }catch (Exception $exception){
            echo date("Y-m-d H:i:s") . " {$exception->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wishlists}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250322_022619_create_table_wishlists cannot be reverted.\n";

        return false;
    }
    */
}
