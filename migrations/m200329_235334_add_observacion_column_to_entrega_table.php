<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%entrega}}`.
 */
class m200329_235334_add_observacion_column_to_entrega_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'entrega',
            'observacion', $this->string());
	
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
