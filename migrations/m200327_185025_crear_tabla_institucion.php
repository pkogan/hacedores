<?php

use yii\db\Migration;

/**
 * Class m200327_185025_crear_tabla_institucion
 */
class m200327_185025_crear_tabla_institucion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('institucion', [
            'idInstitucion' => $this->primaryKey(),
            'nombre' => $this->string(),
            'logo' => $this->string(),
            'direccion' => $this->string(),
            'tel' => $this->string(),
        ], 'ENGINE InnoDB');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200327_185025_crear_tabla_institucion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200327_185025_crear_tabla_institucion cannot be reverted.\n";

        return false;
    }
    */
}
