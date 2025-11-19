<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Phase
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $url_image
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $category_id
 * @property Category $category
 * @property Collection|Audio[] $audio
 * @property Collection|Payment[] $payments
 * @package App\Models
 * @property-read int|null $audio_count
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereUrlImage($value)
 * @mixin \Eloquent
 * @property float|null $price
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase wherePrice($value)
 * @property-read Collection|\App\Models\ClientPhase[] $client_phase
 * @property-read int|null $client_phase_count
 */
class Phase extends Model
{
	protected $table = 'phases';

	protected $casts = [
		'active' => 'bool',
		'category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'price',
		'url_image',
		'active',
		'category_id'
	];


    public static function getFillables(){
        return (new Phase())->getFillable();
    }

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function audio()
	{
		return $this->hasMany(Audio::class);
	}

    public function client_phase()
    {
        return $this->hasMany(ClientPhase::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'phase_id');
    }
}
