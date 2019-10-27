<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photo_gallery}}`.
 */
class m191027_085643_add_sort_column_to_photo_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%photo_gallery}}', 'sort', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%photo_gallery}}', 'sort');
    }
}
