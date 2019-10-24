<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gallery}}`.
 */
class m191021_173204_add_gallery_id_column_to_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('gallery', 'gallery_id', $this->bigInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('gallery', 'gallery_id');
    }
}
