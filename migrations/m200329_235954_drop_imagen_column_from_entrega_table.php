<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%entrega}}`.
 */
class m200329_235954_drop_imagen_column_from_entrega_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%entrega}}', 'imagen');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%entrega}}', 'imagen', $this->string());
    }
}
