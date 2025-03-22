<?php

use yii\db\Migration;

class m250322_022548_create_table_product_variants extends Migration
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
            $this->createTable('{{%product_variants}}', [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer(),
                'name' => $this->string(),
                'value' => $this->string(),
                'stock' => $this->integer(),
                'price' => $this->double(),
                'status' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ], $tableOptions);
            $this->createIndex('idx-product_variants-name', '{{%product_variants}}', 'name');
            $this->createIndex('idx-product_variants-value', '{{%product_variants}}', 'value');
        }catch (Exception $exception){
            echo date("Y-m-d H:i:s") . " {$exception->getMessage()}" . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_variants}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250322_022548_create_table_product_variants cannot be reverted.\n";

        return false;
    }
    */
}
