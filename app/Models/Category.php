<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'status'
	];

    public function getStatusLabelAttribute()
    {
        if($this->status ==1){
            return "Active";
        }else{
            return "Inactive";
        }
    }
}
