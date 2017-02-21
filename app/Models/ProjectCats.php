<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class ProjectCats extends Model
{
    use CrudTrait;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected $table = 'project_cats';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'slug', 'active', 'img'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getImage()
    {
        return '<img src="'.$this->img.'" width="50px" />';
    }

    public function getActive()
    {
        return $this->published()
            ->get();
    }

    public function getBySlug($slug)
    {
        return $this->slug($slug)
            ->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function projects()
    {
        return $this->hasMany('App\Models\Projects');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        $query->where(['active'=>1]);
    }

    public function scopeSlug($query, $slug)
    {
        $query->where(['slug'=>$slug]);
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
