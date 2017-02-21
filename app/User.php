<?php

namespace App;

use App\Models\Bids;
use App\Models\Product;
use App\Models\Projects;
use App\Models\UserCats;
use Backpack\PermissionManager\app\Models\Role;
use CreateSites\IMVK\Models\IMVK;
use CreateSites\IMVK\Models\IMVKMessages;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Backpack\CRUD\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one

class User extends Authenticatable
{
    use Notifiable, CrudTrait, HasRoles;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Projects::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(UserCats::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function dialogs()
    {
        return $this->belongsToMany(IMVK::class);
    }

    public function messages()
    {
        return $this->hasMany(IMVKMessages::class);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->id($id)
            ->firstOrFail();
    }

    /**
     * @param $query
     * @param $id
     */
    public function scopeId($query, $id)
    {
        $query->where(['id'=>$id]);
    }

    /**
     * @return int
     */
    public function authorId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getViewForActivity()
    {
        return 'activity.user';
    }
}
