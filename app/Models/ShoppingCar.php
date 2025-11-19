<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShoppingCar
 *
 * @property int $id
 * @property int $client_id
 * @property int $audio_id
 * @property Audio $audio
 * @property Phase $phase
 * @property Client $client
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar whereAudioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar whereId($value)
 * @mixin \Eloquent
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $phase_id
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar wherePhaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingCar whereUpdatedAt($value)
 */
class ShoppingCar extends Model
{
	protected $table = 'shopping_cars';
	public $timestamps = false;

	protected $casts = [
		'client_id' => 'int',
		'audio_id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'audio_id'
	];

	public function audio()
	{
		return $this->belongsTo(Audio::class);
	}
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

	public function client()
	{
		return $this->belongsTo(Client::class);
	}
}
