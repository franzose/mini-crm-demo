<?php

namespace CrmDemo\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Категория заказчика.
 *
 * @package CrmDemo\Domain\Models
 */
class CustomerCategory extends Model {

	/**
	 * Таблица без колонок даты создания/обновления.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Таблица в БД.
	 *
	 * @var string
	 */
	protected $table = 'customer_categories';

	/**
	 * Заполняемые атрибуты.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * Заказчики в данной категории.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function customers()
	{
		return $this->hasMany(Customer::class);
	}
}