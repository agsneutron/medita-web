<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Audio
 *
 * @property int $id
 * @property int $number
 * @property string $name
 * @property string $description
 * @property string $url_image
 * @property string $url_audio
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $restriction_id
 * @property int $phase_id
 * @property Phase $phase
 * @property float $price
 * @property Restriction $restriction
 * @property ClientAudio $clientAudio
 * @property Collection|Payment[] $payments
 * @package App\Models
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Audio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio wherePhaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereRestrictionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUrlAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUrlImage($value)
 * @mixin \Eloquent
 * @property string $duration
 * @property string $url_gif
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUrlGif($value)
 * @property-read Collection|\App\Models\Evaluation[] $evaluations
 * @property-read int|null $evaluations_count
 * @property-read int|null $client_audio_count
 * @method static \Illuminate\Database\Eloquent\Builder|Audio wherePrice($value)
 * @property string|null $url_download
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUrlDownload($value)
 * @property int|null $audio_id
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereAudioId($value)
 */
class Audio extends Model
{
	protected $table = 'audios';

	protected $casts = [
		'number' => 'int',
		'active' => 'bool',
		'isAlbum' => 'bool',
		'restriction_id' => 'int',
		'phase_id' => 'int',
		'free_level' => 'array',
	];

	protected $fillable = [
		'number',
		'price',
		'name',
		'duration',
		'description',
		'url_image',
		'url_audio',
		'url_download',
		'url_gif',
		'active',
		'restriction_id',
		'phase_id',
		'price',
		'is_free',
		'free_level',
	];

    public static function getFillables(){
        return (new Audio())->getFillable();
    }

	public function phase()
	{
		return $this->belongsTo(Phase::class);
	}

	public function restriction()
	{
		return $this->belongsTo(Restriction::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class, 'audios_id');
	}
    public function evaluations()
	{
		return $this->hasMany(Evaluation::class, 'audio_id');
	}

    public function clientAudio()
	{
		return $this->hasMany(ClientAudio::class, 'audios_id');
	}
}
