<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Goal
 *
 * @property int $id
 * @property string $name
 * @property int $goal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $format_goal
 * @method static \Illuminate\Database\Eloquent\Builder|Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Goal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Goal extends Model
{
    use HasFactory;

    protected $table = 'goals';

    protected $cast = [
        'name' => 'string',
        'goal' => 'int'
    ];

    protected $fillable = [
        'name',
        'goal'
    ];

    protected $appends = [
        'format_goal',
    ];

    public function getFormatGoalAttribute()
    {
        return "$".number_format($this->goal, 0, '.', ',');
    }
}
