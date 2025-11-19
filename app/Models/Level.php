<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Level
 *
 * @property int $id
 * @property string $name
 * @property int $educational_level_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property EducationalLevel $educational_level
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Query\Builder|Level onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereEducationalLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Level withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Level withoutTrashed()
 * @mixin \Eloquent
 */
class Level extends Model
{
	use SoftDeletes;
	protected $table = 'levels';

	protected $casts = [
		'educational_level_id' => 'int'
	];

	protected $fillable = [
		'name',
		'educational_level_id'
	];

	public function educational_level()
	{
		return $this->belongsTo(EducationalLevel::class);
	}
}
