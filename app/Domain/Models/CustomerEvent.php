<?php

namespace CrmDemo\Domain\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель встречи менеджера с ТСП.
 *
 * @package CrmDemo\Domain\Models
 */
class CustomerEvent extends Model {

	public $timestamps = false;

	/**
	 * Таблица в БД.
	 *
	 * @var string
	 */
	protected $table = 'customer_events';

	/**
	 * Заполняемые поля.
	 *
	 * @var array
	 */
	protected $fillable = [
		'type_id',
		'customer_id',
		'manager_id',
		'event_date',
		'event_time',
		'description'
	];

	/**
	 * @var array
	 */
	protected $with = [
		'type',
		'customer',
		'manager'
	];

	/**
	 * Тип события.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function type()
	{
		return $this->belongsTo(CustomerEventType::class, 'type_id');
	}

	/**
	 * Заказчик, с которым назначена встреча.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	/**
	 * Менеджер, который участвовал во встрече с заказчиком.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function manager()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Форматирует дату в соответствии с форматом БД.
	 *
	 * @param string $date
	 */
	public function setEventDateAttribute($date)
	{
		$this->attributes['event_date'] = Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
	}

	/**
	 * Форматирует дату для вывода на сайте.
	 *
	 * @return string
	 */
	public function getEventDateAttribute()
	{
		return Carbon::createFromFormat('Y-m-d', $this->attributes['event_date'])->format('d.m.Y');
	}

	/**
	 * Форматирует время для вывода на сайте.
	 *
	 * @return string
	 */
	public function getEventTimeAttribute()
	{
		return Carbon::createFromFormat('H:i:s', $this->attributes['event_time'])->format('H:i');
	}

	/**
	 * Возвращает форматированную дату события.
	 *
	 * @return string
	 */
	public function getDateAttribute()
	{
		return $this->getAttribute('event_date') . ' ' . $this->getAttribute('event_time');
	}
}