<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 */
class m191020_153526_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->comment('Заголовок'),
            'announcement' => $this->text()->comment('Анонс'),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%gallery}}');
    }
}
