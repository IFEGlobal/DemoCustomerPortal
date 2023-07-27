<?php

namespace App\Models;

use App\DataResources\NotificationSettingsResource;
use App\Scopes\UserScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use MBarlow\Megaphone\HasMegaphone;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasMegaphone, HasRoles, InteractsWithMedia;

    protected $connection = 'mysql';

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);

        User::created(function ($user) {
            $user->notificationSettings()->create([
                'user_id' => $user->id,
                'email_notifications' => NotificationSettingsResource::DefaultEmailSettings(),
                'push_notifications' => NotificationSettingsResource::DefaultPushSettings()
            ]);
        });
    }

    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'role',
        'password',
        'status',
        'account_owner',
        'last_login_at',
        'last_login_ip_address',
        'avatar',
        'session_id'
    ];

    protected $hidden = [
        'last_login_at',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function access(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Access::class);
    }

    public function userAccess(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccessActivity::class, 'user_id', 'id');
    }

    public function LatestAccessLog(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AccessActivity::class, 'user_id', 'id')->latest();
    }

    public function priorities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Priority::class,'user_id', 'id');
    }

    public function favorites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

    public function notificationSettings()
    {
        return $this->hasOne(UserNotificationSetting::class, 'user_id', 'id');
    }

    public function tableConfigurations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TableConfiguration::class, 'user_id', 'id');
    }

    public function outboundServices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EventRegistration::class, 'user_id', 'id');
    }

    public function getFirstNameAttribute(): string
    {
        return substr($this->name, 0, strpos( $this->name, ' '))."s";
    }

    public function getAvatar()
    {
        if($this->hasMedia('avatar'))
        {
            return $this->getFirstMedia('avatar')->getUrl();
        }

        return URL::to('/icons/man.svg');
    }
}
