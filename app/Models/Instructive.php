<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\instructives
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property Collection|Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive query()
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instructive whereUrl($value)
 * @mixin \Eloquent
 * @property-read int|null $categories_count
 */
class Instructive extends Model
{
    protected $table = 'instructives';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'url',
    ];

    public static function getFillables(){
        return (new Instructive())->getFillable();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
