<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $description
 * @property string|null $image
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category $category
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'posts';

	protected $casts = [
		'category_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'title',
		'slug',
		'category_id',
		'description',
		'image',
		'status'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

    public function getStatusLabelAttribute()
    {
        if($this->status ==1){
            return "Active";
        }else{
            return "Inactive";
        }
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ','-',$value);
    }
}
