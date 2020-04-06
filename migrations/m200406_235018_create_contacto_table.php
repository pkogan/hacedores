<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacto}}`.
 */
class m200406_235018_create_contacto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacto}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(32),
            'tel' => $this->string(200),
            'idInstitucion' => $this->integer(11),
            'con_caso' => $this->boolean(),
            'mas_info' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-contacto-institucion',
            'contacto', 'idInstitucion',
            'institucion', 'idInstitucion',
            'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contacto}}');
    }
}
