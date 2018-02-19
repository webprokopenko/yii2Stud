<?php

use yii\db\Migration;

/**
 * Class m180219_172526_init_phones_tables
 */
class m180219_172526_init_phones_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            'phone',
            [
                'id'=>'pk',
                'customer_id'=>'int',
                'number'=>'string',
            ],
            'ENGINE=InnoDB'
        );
        $this->addForeignKey('customer_phone_numbers','phone','customer_id','customer','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('customer_phone_numbers','phone');
        $this->dropTable('phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180219_172526_init_phones_tables cannot be reverted.\n";

        return false;
    }
    */
}
