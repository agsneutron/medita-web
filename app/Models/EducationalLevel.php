<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationalLevel
 *
 * @property int $id
 * @property string $name
 * @property Collection|Client[] $clients
 * @package App\Models
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|EducationalLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationalLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationalLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationalLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducationalLevel whereName($value)
 * @mixin \Eloquent
 * @property-read Collection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 */
class EducationalLevel extends Model
{
	protected $table = 'educational_levels';
	public $timestamps = false;
    CONST KINDERGARTEN = 1;
    CONST PRIMARY = 2;
    CONST SECONDARY = 3;
    CONST HIGH_SCHOOL = 4;
    CONST UNIVERSITY = 5;

	protected $fillable = [
		'name'
	];

	public function clients()
	{
		return $this->hasMany(Client::class);
	}

	public function levels()
	{
		return $this->hasMany(Level::class);
	}
}
