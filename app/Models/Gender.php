<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 *
 * @property int $id
 * @property string $name
 * @property Collection|Client[] $clients
 * @package App\Models
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gender whereName($value)
 * @mixin \Eloquent
 */
class Gender extends Model
{
	protected $table = 'genders';
	public $timestamps = false;

    const MALE = 1;
    const FEMALE = 2;
    const ANOTHER = 3;

	protected $fillable = [
		'name'
	];

	public function clients()
	{
		return $this->hasMany(Client::class);
	}
}
