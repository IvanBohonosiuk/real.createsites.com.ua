<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use CrudTrait, Notifiable;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected $table = 'products';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'description',
        'price',
        'sale_price',
        'qty',
        'img',
        'images',
        'files',
        'user_id',
        'active',
        'favorites',
        'colored'
    ];
    // protected $hidden = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->published()
            ->order()
            ->get();
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
     * @return string
     */
    public function activateProduct()
    {
        $activatebtn = '<a href="'. route('products.activate', $this->id) .'" class="btn btn-xs btn-success" data-button-type="activate"><i class="fa fa-check"></i> Activate</a>';
        return $activatebtn;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCat::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where(['active'=>1]);
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
     * @param $query
     */
    public function scopeOrder($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
