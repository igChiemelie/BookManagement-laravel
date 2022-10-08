<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title','content','author_id','price','cover','year_published'];

    /**  
    * Defined Accessor.
    **/
    public function getUpdatedAtAttribute($value)
    {
        // return Carbon::parse($value)->diffInMinutes();
        return Carbon::parse($value)->diffForhumans();
    }

    /**  
     * Defined Mutator.
     **/
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::upper($value);
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'author_id';
    // }
}
