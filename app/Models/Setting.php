<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @property int $id
 * @property string $name
 * @property string|null $content
 * @property bool $active
 * @property Collection|News[] $news
 * @package App\Models
 * @property-read int|null $news_count
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
	protected $table = 'settings';
	public $timestamps = false;

	protected $casts = [
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'content',
		'active'
	];

    CONST NEWS = 1;
    CONST TERMS = 2;
    CONST PRIVACY = 3;

	public function news()
	{
		return $this->hasMany(News::class);
	}

    public static function getFillables(){
        return (new Setting())->getFillable();
    }
}
