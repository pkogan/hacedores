<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contacto}}`.
 */
class m200412_025148_add_idCiudad_column_to_contacto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%contacto}}', 'idCiudad', $this->biginteger(20));

        $this->addForeignKey(
            'fk-contacto-ciudad',
            '{{%contacto}}', 'idCiudad',
            'ciudad', 'idCiudad',
            'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-contacto-ciudad', '{{%contacto}}');
        $this->dropColumn('{{%contacto}}', 'idCiudad');
    }
}
