<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photo_gallery}}`.
 */
class m191023_123207_add_file_name_column_to_photo_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%photo_gallery}}', 'file_name', $this->text());
        $this->addColumn('{{%photo_gallery}}', 'file_size', $this->bigInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%photo_gallery}}', 'file_name');
        $this->dropColumn('{{%photo_gallery}}', 'file_size');
    }
}
