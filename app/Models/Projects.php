<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;

class Projects extends Model
{
    use CrudTrait, Notifiable;

    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected $table = 'projects';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'description',
        'active',
        'end_date',
        'price',
        'image',
        'files',
        'remote'
    ];
    // protected $hidden = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
//    protected $casts = [
//        'image' => 'array',
//        'files' => 'array'
//    ];

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
    public function activateProject()
    {
        $activatebtn = '<a href="'. route('projects.activate', $this->id) .'" class="btn btn-xs btn-success" data-button-type="activate"><i class="fa fa-check"></i> Activate</a>';
        return $activatebtn;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\ProjectCats');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function freelancer()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany('App\Models\Bids', 'project_id');
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

    /**
     * @param $value
     */
    public function setImagesAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "uploads/projects/images/" . date('FY') . "/";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }

    /**
     * @param $value
     */
    public function setFilesAttribute($value)
    {
        $attribute_name = "files";
        $disk = "public";
        $destination_path = "uploads/projects/files/" . date('FY') . "/";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
