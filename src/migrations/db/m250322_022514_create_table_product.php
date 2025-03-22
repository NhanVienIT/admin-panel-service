<?php

use yii\db\Migration;

class m250322_022514_create_table_product extends Migration
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
            $this->createTable('{{%product}}', [
                'id' => $this->primaryKey(),
                'category_id' => $this->integer(),
                'brand_id' => $this->integer(),
                'product_name' => $this->string(),
                'slug' => $this->string(),
                'description' => $this->string(),
                'price' => $this->double(),
                'discount' => $this->double(),
                'stock' => $this->integer(),
                'quantity' => $this->integer(),
                'sold_count' => $this->integer(),
                'status' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ], $tableOptions);
            $this->createIndex('idx-product-product_name', '{{%product}}', 'product_name');
        }catch (Exception $exception){
            echo date("Y-m-d H:i:s") . " {$exception->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250322_022514_create_table_product cannot be reverted.\n";

        return false;
    }
    */
}
