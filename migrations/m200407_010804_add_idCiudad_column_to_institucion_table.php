<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%institucion}}`.
 */
class m200407_010804_add_idCiudad_column_to_institucion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%institucion}}', 'idCiudad', $this->biginteger(11));
        $this->addForeignKey(
            'fk-institucion-ciudad',
            'institucion', 'idCiudad',
            'ciudad', 'idCiudad',
            'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-institucion-ciudad', '{{%institucion}}');
        $this->dropColumn('{{%institucion}}', 'idCiudad');
    }
}
