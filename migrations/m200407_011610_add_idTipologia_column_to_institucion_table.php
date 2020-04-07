<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%institucion}}`.
 */
class m200407_011610_add_idTipologia_column_to_institucion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%institucion}}', 'idTipologia', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%institucion}}', 'idTipologia');
    }
}
