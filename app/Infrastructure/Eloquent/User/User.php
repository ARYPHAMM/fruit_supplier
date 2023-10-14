<?php

namespace App\Infrastructure\Eloquent\User;

use App\Infrastructure\Eloquent\CapacityProfile\CapacityProfile;
use App\Infrastructure\Eloquent\WorkProfile\WorkProfile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
// use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use Notifiable;
    use HasMediaTrait;
    // use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
        'phone_number',
        'email_verified_at',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function info()
    {
        return  $this->morphTo('info_account');
    }
    public function getAccountType()
    {
        // if ($this->info_account_type == Teacher::class) {
        //     return 'teacher';
        // }
        // if ($this->info_account_type == Student::class) {
        //     return 'student';
        // }
        if ($this->info_account_type == Academy::class) {
            return 'academy';
        }
        // if ($this->info_account_type == Member::class) {
        //     if ($this->hasRole('admin')) {
        //         return 'admin';
        //     }
        //     return 'member';
        // }
        if ($this->info_account_type == Customer::class) {
            return 'customer';
        }
    }
    // public function registerMediaCollections(): void
    // {
    //     $this
    //         ->addMediaCollection('avatar')
    //         ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg'])
    //         ->singleFile();
    // }
    // public function registerMediaConversions(Media $media = null)
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(config('image.thumb.width'))
    //         ->height(config('image.thumb.height'))
    //         ->nonQueued()
    //         ->sharpen(10);
    //     $this->addMediaConversion('medium')
    //         ->width(config('image.medium.width'))
    //         ->height(config('image.medium.height'))
    //         ->nonQueued()
    //         ->sharpen(10);
    // }
    // public function getAvatar()
    // {
    //     $medias = $this->getMedia('avatar');
    //     $avatar = '';
    //     foreach ($medias as $media) {
    //         $avatar = $media->getFullUrl();
    //     }
    //     return $avatar;
    // }
    // public function workProfile()
    // {
    //     return $this->belongsTo(WorkProfile::class, 'id', 'user_id');
    // }
    // public function getWorkProfile()
    // {
    //     if (is_null($this->workProfile)) {
    //         $workProfile = WorkProfile::create(
    //             ['user_id' => $this->id]
    //         );
    //     }
    //     return $this->workProfile;
    // }
    // public function capacityProfile()
    // {
    //     return $this->belongsTo(CapacityProfile::class, 'id', 'user_id');
    // }
    // public function getCapacityProfile()
    // {
    //     if (is_null($this->capacityProfile)) {
    //         $capacityProfile = CapacityProfile::create(
    //             ['user_id' => $this->id]
    //         );
    //     }
    //     return $this->capacityProfile;
    // }
}
