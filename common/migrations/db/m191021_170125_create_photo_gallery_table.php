<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photo_gallery}}`.
 */
class m191021_170125_create_photo_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photo_gallery}}', [
            'id' => $this->primaryKey(),
            'base_path' => $this->string(),
            'path' => $this->string(),
            'type' => $this->string(),
            'gallery_id' => $this->bigInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%photo_gallery}}');
    }
}
