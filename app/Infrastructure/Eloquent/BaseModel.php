<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BaseModel extends Model // implements HasMedia
{
    // use HasMediaTrait;
    // public function registerMediaCollections(): void
    // {
    //     $this
    //     ->addMediaCollection('avatar')
    //     ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
    //     ->singleFile();
    //     $this
    //         ->addMediaCollection('images')
    //         ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    //     $this
    //         ->addMediaCollection('image')
    //         ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
    //         ->singleFile();
    // }
    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(150)
    //         ->height(220)
    //         ->nonQueued()
    //         ->sharpen(10);
    //     $this->addMediaConversion('medium')
    //         ->width(368)
    //         ->height(232)
    //         ->nonQueued()
    //         ->sharpen(10);
    // }
    // public function getImages()
    // {
    //     try {
    //         $medias = $this->getMedia('images');
    //         $mediaResult = array();
    //         $i = 0;
    //         if (count($medias)) {
    //             foreach ($medias as $media) {
    //                 $mediaResult[$i]['id'] = $media->id;
    //                 $mediaResult[$i]['model_type'] = $media->model_type;
    //                 $mediaResult[$i]['url'] = $media->getFullUrl();
    //                 $i++;
    //             }
    //         }
    //         return $mediaResult;
    //     } catch (\Throwable $th) {
    //         return $th->getMessage();
    //     }
    // }
    public function getCreatedAtAttribute($date)
    {
        return $date;
    }
    public function getUpdatedAtAttribute($date)
    {
        return $date;
    }
}
