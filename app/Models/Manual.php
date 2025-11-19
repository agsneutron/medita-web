<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manual
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property Collection|Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|Manual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manual query()
 * @method static \Illuminate\Database\Eloquent\Builder|Manual whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manual whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manual whereUrl($value)
 * @mixin \Eloquent
 * @property-read int|null $categories_count
 */
class Manual extends Model
{
    protected $table = 'manuals';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'url',
    ];

    public static function getFillables(){
        return (new Manual())->getFillable();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
