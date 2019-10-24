<?php

use yii\db\Migration;

/**
 * Class m191023_134708_add_fk_gallery_to_gallery_table
 */
class m191023_134708_add_fk_gallery_to_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //$this->addForeignKey('gallery-fk', 'gallery', 'gallery_id', 'photo_gallery', 'gallery_id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropForeignKey('gallery-fk', 'gallery');
    }

}
