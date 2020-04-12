<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contacto}}`.
 */
class m200412_033905_add_email_column_to_contacto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%contacto}}', 'email', $this->string(35));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%contacto}}', 'email');
    }
}
