<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pratiche}}`.
 */
class m211025_075109_create_practices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%practices}}', [
            'id' => $this->primaryKey(),
            'practice_id' => $this->string('255'),
            'creation_date' => $this->dateTime(),
            'practice_status' => "ENUM('Open', 'Close')",
            'note' => $this->text(),
            'customer_id' => $this->integer()
        ]);

        $this->addForeignKey('fk_practices_customers', 'practices', 'customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%practices}}');
    }
}
