<?php

use yii\db\Migration;

/**
 * Class m200329_025501_remover_tabla_hacedor
 */
class m200329_025501_remover_tabla_hacedor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Removemos las claves foráneas
        $this->dropForeignKey('asignacion_ibfk_2', 'asignacion');
        $this->dropForeignKey('fk-producto-hacedor', 'producto');
        $this->dropForeignKey('modelo_ibfk_1', 'modelo');
        
        $this->dropTable('hacedor');
        $this->renameTable('registro', 'hacedor');

        // Volvemos a agregrar las claves foráneas
        $this->addForeignKey(
            'fk-asignacion-hacedor',
            'asignacion', 'idHacedor',
            'hacedor', 'idRegistro',
            'CASCADE', 'CASCADE');
        // Sacamos el NOT NULL para que pueda setearse null cuando se borre
        // un hacedor (queremos que la cuenta de productos quede intacta).
        $this->alterColumn('producto',
                          'idHacedor', $this->integer(11));
        $this->addForeignKey(
            'fk-producto-hacedor',
            'producto', 'idHacedor',
            'hacedor', 'idRegistro',
            'SET NULL', 'CASCADE');

        $this->alterColumn('modelo',
                          'idHacedor', $this->integer(11));
        $this->addForeignKey(
            'fk-modelo-hacedor',
            'modelo', 'idHacedor',
            'hacedor', 'idRegistro',
            'SET NULL', 'CASCADE');

        
        $this->renameColumn('hacedor', 'idRegistro', 'idHacedor');
        $this->addColumn('hacedor', 'idUsuario', $this->integer(11));
        $this->addColumn('hacedor',
                        'direccion', $this->string(300));
        $this->addColumn('hacedor',
                        'token', $this->string(32));
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200329_025501_remover_tabla_hacedor cannot be reverted.\n";

        return false;
    }

    /*
       // Use up()/down() to run migration code without a transaction.
       public function up()
       {

       }

       public function down()
       {
       echo "m200329_025501_remover_tabla_hacedor cannot be reverted.\n";

       return false;
       }
     */
}
