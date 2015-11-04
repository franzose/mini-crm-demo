<?php

namespace CrmDemo\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель статуса заказчика.
 *
 * @package CrmDemo\Domain\Models
 */
class CustomerStatus extends Model {

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
	protected $table = 'customer_statuses';

	/**
	 * Заполняемые поля.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'color'];
}