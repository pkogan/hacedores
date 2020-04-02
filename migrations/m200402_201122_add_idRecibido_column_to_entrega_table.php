<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%entrega}}`.
 */
class m200402_201122_add_idRecibido_column_to_entrega_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'entrega',
            'idEstado', $this->integer(11)->defaultValue(0));
        $this->addColumn(
            'entrega',
            'idUsuarioValidador', $this->integer(11)->defaultValue(null));
        $this->addColumn(
            'entrega',
            'receptor', $this->string(500)->defaultValue(null));
	
        $this->addForeignKey(
            'fk-entrega-usuario',
            'entrega', 'idUsuarioValidador',
            'usuario', 'idUsuario',
            'RESTRICT', 'CASCADE');
        
	
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-entrega-usuario', 'entrega');
        $this->dropColumn('entrega', 'receptor');
        $this->dropColumn('entrega', 'idUsuarioValidador');
        $this->dropColumn('entrega', 'idEstado');
    }
}
