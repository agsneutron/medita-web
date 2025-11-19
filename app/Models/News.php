<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 *
 * @property int $id
 * @property string $title
 * @property string $url_image
 * @property string $content
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $setting_id
 * @property Setting $setting
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSettingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUrlImage($value)
 * @mixin \Eloquent
 */
class News extends Model
{
	protected $table = 'news';

	protected $casts = [
		'active' => 'bool',
		'setting_id' => 'int'
	];

    protected $attributes =[
        'setting_id' => Setting::NEWS,
    ];

	protected $fillable = [
		'title',
		'url_image',
		'content',
		'active',
		'setting_id'
	];

	public function setting()
	{
		return $this->belongsTo(Setting::class);
	}

    public static function getFillables(){
        return (new News())->getFillable();
    }
}
