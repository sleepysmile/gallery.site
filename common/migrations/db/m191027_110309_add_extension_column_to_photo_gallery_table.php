<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photo_gallery}}`.
 */
class m191027_110309_add_extension_column_to_photo_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%photo_gallery}}', 'extension', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%photo_gallery}}', 'extension');
    }
}
