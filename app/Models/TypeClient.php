<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeClient
 *
 * @property int $id
 * @property string $name
 * @property Collection|Institution[] $institutions
 * @package App\Models
 * @property-read int|null $institutions_count
 * @method static \Illuminate\Database\Eloquent\Builder|TypeClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeClient query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeClient whereName($value)
 * @mixin \Eloquent
 */
class TypeClient extends Model
{
	protected $table = 'type_clients';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function institutions()
	{
		return $this->hasMany(Institution::class);
	}
}
