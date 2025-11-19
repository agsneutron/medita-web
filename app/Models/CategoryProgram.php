<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryProgram
 *
 * @property int $id
 * @property int $category_id
 * @property int $program_id
 * @property Category $category
 * @property Program $program
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProgram whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProgram whereProgramId($value)
 * @mixin \Eloquent
 */
class CategoryProgram extends Model
{
	protected $table = 'category_program';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int',
		'program_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'program_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function program()
	{
		return $this->belongsTo(Program::class);
	}
}
