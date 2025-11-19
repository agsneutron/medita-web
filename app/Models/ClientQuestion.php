<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClientQuestion
 *
 * @property int $id
 * @property int $question_id
 * @property int $client_id
 * @property int $answer_id
 * @property int $attempt
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion query()
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientQuestion whereQuestionId($value)
 */
class ClientQuestion extends Model
{
    protected $table = 'client_question';
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'client_id',
        'answer_id',
        'attempt'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
