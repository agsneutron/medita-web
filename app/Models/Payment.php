<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @property int $id
 * @property Carbon $date
 * @property string $payment_method
 * @property string $token
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $audios_id
 * @property int $client_id
 * @property int $card_id
 * @property Audio $audio
 * @property Client $client
 * @property Card $card
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAudiosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float $price
 * @property int|null $programs_id
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereProgramsId($value)
 * @property-read \App\Models\Program $program
 * @property-read mixed $date_format
 * @property int|null $phase_id
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePhaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereToken($value)
 */
class Payment extends Model
{
    protected $table = 'payments';

    protected $casts = [
        'active' => 'bool',
        'audios_id' => 'int',
        'client_id' => 'int',
        'programs_id' => 'int',
        'price' => 'float',
    ];

    protected $dates = [
        'date'
    ];

    protected $fillable = [
        'date',
        'payment_method',
        'price',
        'active',
        'audios_id',
        'client_id',
        'programs_id'
    ];

    protected $appends = [
        'date_format',
    ];

    public function getDateFormatAttribute()
    {
        return $this->date->format('d-m-Y');
    }

    public function audio()
    {
        return $this->belongsTo(Audio::class, 'audios_id');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
