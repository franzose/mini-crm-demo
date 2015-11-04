<?php

namespace CrmDemo\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель заказчика.
 *
 * @package CrmDemo\Domain\Models
 */
class Customer extends Model {

	/**
	 * Заполняемые атрибуты.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_id',
		'status_id',
		'manager_id',
		'name',
		'legal_name',
		'address',
		'contact_person',
		'person_position',
		'phone',
	];

	/**
	 * @var array
	 */
	protected $with = [
		'category',
		'manager',
		'status'
	];

	/**
	 * Категория заказчика.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(CustomerCategory::class, 'category_id');
	}

	/**
	 * Менеджер, ответственный за переговоры с заказчиком.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function manager()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Статус заказчика.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function status()
	{
		return $this->belongsTo(CustomerStatus::class);
	}

	/**
	 * События, связанные с заказчиком.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany(CustomerEvent::class);
	}
}