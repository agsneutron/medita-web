<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmotionalStatistic
 *
 * @property int $id
 * @property string $name
 * @property int $count
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|EmotionalStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmotionalStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmotionalStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmotionalStatistic whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmotionalStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmotionalStatistic whereName($value)
 * @mixin \Eloquent
 */
class EmotionalStatistic extends Model
{
	protected $table = 'emotional_statistics';
	public $timestamps = false;

    const SLEEP_BETTER = 1;
    const REDUCE_ANXIETY = 2;
    const LEARN_MEDITATE = 3;
    const CERTIFY_MEDITATION = 4;
    const ANOTHER = 5;

	protected $casts = [
		'count' => 'int'
	];

	protected $fillable = [
		'name',
		'count'
	];
}
