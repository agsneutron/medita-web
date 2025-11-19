<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Questions
 *
 * @property int $id
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|Questions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Questions query()
 * @method static \Illuminate\Database\Eloquent\Builder|Questions whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Questions whereId($value)
 * @mixin \Eloquent
 * @property int|null $educational_level_id
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereEducationalLevelId($value)
 */
class Question extends Model
{
    protected $table = 'questions';
    public $timestamps = false;

    protected $fillable = [
        'description',
    ];

    public static function getFillables(){
        return (new Question())->getFillable();
    }

    public function educational_level()
    {
        return $this->belongsTo(EducationalLevel::class);
    }
}
