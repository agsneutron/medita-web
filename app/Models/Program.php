<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Program
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Category[] $categories
 * @property Collection|Client[] $clients
 * @property Collection|Institution[] $institutions
 * @package App\Models
 * @property-read int|null $categories_count
 * @property-read int|null $clients_count
 * @property-read int|null $institutions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Collection|\App\Models\Payment[] $payment
 * @property-read int|null $payment_count
 */
class Program extends Model
{
    protected $table = 'programs';

    const RECOGNITIONS_PROGRAM = 1;
    const LIFEFULLNESS = 2;
    const WORK_AND_WELLNESS = 3;
    const LIFE_FULLNESS_HEALTH = 4;

    protected $casts = [
        'active' => 'bool'
    ];

    protected $fillable = [
        'name',
        'active'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->withPivot('id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
