<?php

namespace CrmDemo\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Тип события.
 *
 * @package CrmDemo\Domain\Models
 */
class CustomerEventType extends Model {

	public $timestamps = false;

	/**
	 * Таблица в БД.
	 *
	 * @var string
	 */
	protected $table = 'customer_eventtypes';

	/**
	 * Заполняемые поля.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * События.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany(CustomerEvent::class);
	}
}