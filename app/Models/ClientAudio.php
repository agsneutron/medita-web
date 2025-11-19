<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientAudio
 *
 * @property int $id
 * @property int $client_id
 * @property int $audios_id
 * @property bool $completed
 * @property int $duration
 * @property Audio $audio
 * @property Client $client
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio whereAudiosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio whereId($value)
 * @mixin \Eloquent
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientAudio whereUpdatedAt($value)
 */
class ClientAudio extends Model
{
	protected $table = 'client_audio';
	public $timestamps = false;

	protected $casts = [
		'client_id' => 'int',
		'audios_id' => 'int',
		'completed' => 'bool',
        'duration' => 'int'
	];

	protected $fillable = [
		'client_id',
		'audios_id',
		'completed',
        'duration'
	];

    const RECOGNITION = 1;
    const HIGH_TECH = 4;
    const MEDITATIONS = 5;

	public function audio()
	{
		return $this->belongsTo(Audio::class, 'audios_id');
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}
}
