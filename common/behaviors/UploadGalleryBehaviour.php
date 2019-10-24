<?php


namespace common\behaviors;


use common\models\PhotoGallery;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * @property mixed $iPObject
 */
class UploadGalleryBehaviour extends Behavior
{
    public $attribute = 'gallery';

    public $galleryIdAttribute = 'gallery_id';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

    public function afterDelete()
    {
        
    }

    /** Устанавливает свойство модели $galleryIdAttribute */
    public function beforeInsert()
    {
        if (empty($this->owner->{$this->galleryIdAttribute})) {
            $this->owner->{$this->galleryIdAttribute} = $this->owner->{$this->attribute}['gallery_id'];
        }
    }

    public function afterFind()
    {
        if (!empty($this->owner->{$this->galleryIdAttribute})) {
            $this->owner->{$this->attribute} = PhotoGallery::galleryImages($this->owner->{$this->galleryIdAttribute});
        } else {
            $this->owner->{$this->attribute} = [];
        }
    }

    public function getIPObject()
    {
        $gallery = [];

        if (!empty($this->owner->{$this->attribute})) {
            foreach ($this->owner->{$this->attribute} as $image) {
                $gallery[] = $image->absolutePath;
            }
        }

        return $gallery;
    }

    public function getIPCaption(string $deleteRoute)
    {
        $caption = [];

        if (!empty($this->owner->{$this->attribute})) {
            foreach ($this->owner->{$this->attribute} as $image) {
                $caption[] =  [
                    'caption' => $image->file_name,
                    'size' => $image->file_size,
                    'url' => $deleteRoute,
                    'filetype' => $image->type,
                    'type' => $image->templateFile,
                    'key' => $image->id,
                    'extra' => [
                        'id' => $image->id,
                        'value' => $image->gallery_id
                    ]
                ];
            }
        }

        return $caption;
    }
}