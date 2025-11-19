<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientPhase
 *
 * @property int $id
 * @property int $client_id
 * @property int $phase_id
 * @property Client $client
 * @property Phase $phase
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ClientPhase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientPhase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientPhase query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientPhase whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientPhase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientPhase wherePhaseId($value)
 * @mixin \Eloquent
 */
class ClientPhase extends Model
{
	protected $table = 'client_phase';
	public $timestamps = false;

	protected $casts = [
		'client_id' => 'int',
		'phase_id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'phase_id'
	];

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function phase()
	{
		return $this->belongsTo(Phase::class);
	}
}
