<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%entrega}}`.
 */
class m200407_010544_add_idCiudad_column_to_entrega_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%entrega}}', 'idCiudad', $this->biginteger(11));
        $this->addForeignKey(
            'fk-entrega-ciudad',
            'entrega', 'idCiudad',
            'ciudad', 'idCiudad',
            'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-entrega-ciudad', '{{%entrega}}');
        $this->dropColumn('{{%entrega}}', 'idCiudad');
    }
}
