<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property int $id
 * @property string $name
 * @property string $url_image
 * @property string $description
 * @property bool $active
 * @property string|null $url_instructive
 * @property string|null $url_manual
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Program[] $programs
 * @property Collection|Phase[] $phases
 * @property Instructive $instructive
 * @property Manual $manual
 * @package App\Models
 * @property int|null $instructive_id
 * @property int|null $manual_id
 * @property-read int|null $phases_count
 * @property-read int|null $programs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereInstructiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereManualId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUrlImage($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUrlInstructive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUrlManual($value)
 * @property string|null $duration
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDuration($value)
 */
class Category extends Model
{
	protected $table = 'categories';

    const RECOGNITIONS_PROGRAM = 1;
    const LIFE_FULLNESS_KINDERGARTEN = 2;
    const LIFE_FULLNESS_PRIMARY = 3;
    const LIFE_FULLNESS_SECONDARY = 4;
    const LIFE_FULLNESS_HIGH_SCHOOL = 5;
    const LIFE_FULLNESS_UNIVERSITY = 6;
    const WWLH = 7;
    const HIGH_TECH_AUDIO = 8;
    const MEDITATIONS_GUIDED = 9;
    const LIFE_FULLNESS_HEALTH = 10;
    const LIFEFULLNESS=[
        self::LIFE_FULLNESS_KINDERGARTEN,
        self::LIFE_FULLNESS_PRIMARY,
        self::LIFE_FULLNESS_SECONDARY,
        self::LIFE_FULLNESS_HIGH_SCHOOL,
        self::LIFE_FULLNESS_UNIVERSITY
    ];

	protected $casts = [
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'url_image',
		'description',
		'active',
        'url_instructive',
        'url_manual',
        'duration'
	];

    public static function getFillables(){
        return (new Category())->getFillable();
    }

	public function programs()
	{
		return $this->belongsToMany(Program::class)
					->withPivot('id');
	}

	public function phases()
	{
		return $this->hasMany(Phase::class);
	}

    public function instructive()
	{
		return $this->belongsTo(Instructive::class);
	}

    public function manual()
	{
		return $this->belongsTo(Manual::class);
	}
}
