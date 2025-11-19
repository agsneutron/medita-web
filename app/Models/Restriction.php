<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Restriction
 *
 * @property int $id
 * @property string $name
 * @property Collection|Audio[] $audio
 * @package App\Models
 * @property-read int|null $audio_count
 * @method static \Illuminate\Database\Eloquent\Builder|Restriction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Restriction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Restriction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Restriction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restriction whereName($value)
 * @mixin \Eloquent
 */
class Restriction extends Model
{
	protected $table = 'restrictions';
	public $timestamps = false;

    const WITH = 1;
    const WITHOUT = 2;

	protected $fillable = [
		'name'
	];

	public function audio()
	{
		return $this->hasMany(Audio::class);
	}
}
