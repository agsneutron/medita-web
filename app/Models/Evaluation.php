<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluation
 *
 * @property int $id
 * @property float $date
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $client_id
 * @property Client $client
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $score
 * @property int $audio_id
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereAudiosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereAudioId($value)
 */
class Evaluation extends Model
{
	protected $table = 'evaluations';

	protected $casts = [
		'score' => 'float',
		'client_id' => 'int',
		'audio_id' => 'int'
	];

	protected $fillable = [
		'score',
		'description',
		'client_id',
        'audio_id'
	];

	public function client()
	{
		return $this->belongsTo(Client::class);
	}
}
