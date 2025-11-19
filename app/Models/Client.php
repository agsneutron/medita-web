<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $second_last_name
 * @property string $email
 * @property string $phone
 * @property string|null $password
 * @property int $age
 * @property bool $active
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $gender_id
 * @property int|null $institution_id
 * @property int|null $program_id
 * @property string|null $api_token
 * @property string|null $url_image
 * @property int|null $educational_level_id
 * @property int|null $degree
 * @property bool $teacher
 * @property EducationalLevel|null $educational_level
 * @property Gender $gender
 * @property Institution|null $institution
 * @property Program|null $program
 * @property string|null $stripe_id
 * @property string|null $third_id
 * @property Collection|Question[] $questions
 * @property Collection|Evaluation[] $evaluations
 * @property Collection|Payment[] $payments
 * @package App\Models
 * @property-read int|null $evaluations_count
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEducationalLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSecondLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTeacher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUrlImage($value)
 * @mixin \Eloquent
 * @property-read mixed $date
 * @property-read string $full_name
 * @property-read int|null $questions_count
 * @property-read Collection|\App\Models\ClientAudio[] $client_audio
 * @property-read int|null $client_audio_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereThirdId($value)
 * @property-read Collection|\App\Models\ClientPhase[] $client_phase
 * @property-read int|null $client_phase_count
 */
class Client extends Model
{
    const freeLifefullnessAudios = [15, 351, 352]; //15 refers to Welcome To My World, 351 and 352 refers to The Synchronicity Experience
    const freeLifefullnessAudiosTeacher = [28, 29, 353, 354]; // 28 and 29 refers to One Heart, 353 refers to Meditation in Motion 1 and 354 refers to Sounds of Source 4 track

    protected $table = 'clients';

    protected $casts = [
        'age' => 'int',
        'active' => 'bool',
        'gender_id' => 'int',
        'institution_id' => 'int',
        'program_id' => 'int',
        'educational_level_id' => 'int',
        'degree' => 'int',
        'teacher' => 'bool'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    protected $fillable = [
        'name',
        'last_name',
        'second_last_name',
        'email',
        'password',
        'age',
        'active',
        'remember_token',
        'gender_id',
        'institution_id',
        'program_id',
        'api_token',
        'url_image',
        'educational_level_id',
        'degree',
        'teacher',
        'stripe_id',
        'third_id',
        'phone'
    ];

    protected $appends = [
        'full_name',
        'date',
    ];

    public function getDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
    public function getFullNameAttribute(): string
    {
        return $this->name." ".$this->last_name." ".$this->second_last_name;
    }

    public function educational_level()
    {
        return $this->belongsTo(EducationalLevel::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)
            ->withPivot('id', 'answer_id', 'deleted_at');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function client_question()
    {
        return $this->hasMany(ClientQuestion::class);
    }

    public function client_audio()
    {
        return $this->hasMany(ClientAudio::class);
    }

    public function client_phase()
    {
        return $this->hasMany(ClientPhase::class);
    }
    public function phases()
    {
        return $this->belongsToMany(ClientPhase::class)
            ->withPivot('id', 'client_id', 'deleted_at');
    }
}
