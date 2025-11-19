<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class Institution
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $contact_email
 * @property string $contact_phone
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $type_client_id
 * @property int $program_id
 * @property Program $program
 * @property TypeClient $type_client
 * @property Collection|Client[] $clients
 * @property Collection|Income[] $incomes
 * @package App\Models
 * @property-read int|null $clients_count
 * @property-read int|null $incomes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution query()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereTypeClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $code
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereCode($value)
 * @property-read mixed $date
 */
class Institution extends Model
{
	protected $table = 'institutions';

	protected $casts = [
		'active' => 'bool',
		'type_client_id' => 'int',
		'program_id' => 'int'
	];

    protected $attributes =[
        'contact_phone' => " ",
    ];

	protected $fillable = [
		'name',
		'contact',
		'contact_email',
		'contact_phone',
		'active',
		'type_client_id',
		'program_id'
	];

    protected $appends = [
        'date',
    ];

	public function program()
	{
		return $this->belongsTo(Program::class);
	}

	public function type_client()
	{
		return $this->belongsTo(TypeClient::class);
	}

	public function clients()
	{
		return $this->hasMany(Client::class);
	}

	public function incomes()
	{
		return $this->hasMany(Income::class);
	}

    public static function getFillables(){
        return (new Institution())->getFillable();
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

}
