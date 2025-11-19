<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Services\StripeService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Card
 *
 * @property int $id
 * @property string $name_client
 * @property string $num_target
 * @property string $stripe_id
 * @property Carbon $expired_date
 * @property int $client_id
 * @property bool $active
 * @property Client $client
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Card newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card query()
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereExpiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereNameClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereNumTarget($value)
 * @mixin \Eloquent
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read mixed $brand
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereUpdatedAt($value)
 */
class Card extends Model
{
	protected $table = 'cards';
	public $timestamps = false;

	protected $casts = [
		'client_id' => 'int',
        'active' => 'bool'
	];

	protected $dates = [
		'expired_date'
	];

    protected $appends =['brand'];

	protected $fillable = [
		'name_client',
		'num_target',
		'expired_date',
		'client_id',
		'active',
		'stripe_id'
	];

	public function client()
	{
		return $this->belongsTo(Client::class);
	}
    public function getBrandAttribute(){
        if($this->client->stripe_id!=null&&$this->stripe_id){
            try{
                $response=StripeService::getCard($this->stripe_id);
                if(isset($response)){
                    return $response->card->brand;
                }else{
                    return 'Other';
                }
            }catch(\Exception $ex){
                return 'Other';
            }

        }else{
            return 'Other';
        }

    }
}
