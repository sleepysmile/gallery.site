<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gallery}}`.
 */
class m191102_102721_add_text_column_to_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gallery}}', 'text', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%gallery}}', 'text');
    }
}
