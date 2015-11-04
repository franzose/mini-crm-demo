<?php

namespace CrmDemo\Services\Pagination;


use Illuminate\Pagination\BootstrapThreePresenter;

/**
 * Класс шаблона для вывода пагинации.
 *
 * @package CrmDemo\Services\Pagination
 */
class UiKitPresenter extends BootstrapThreePresenter {

	/**
	 * Выводит данные пагинатора.
	 *
	 * @return string
	 */
	public function render()
	{
		if ($this->hasPages()) {
			return sprintf(
				'<ul class="uk-pagination">%s %s %s</ul>',
				$this->getPreviousButton('<i class="uk-icon-angle-double-left"></i>'),
				$this->getLinks(),
				$this->getNextButton('<i class="uk-icon-angle-double-right"></i>')
			);
		}

		return '';
	}

	/**
	 * Возвращает обертку для неактивного элемента пагинации.
	 *
	 * @param string $text
	 * @return string
	 */
	protected function getDisabledTextWrapper($text)
	{
		return '<li class="uk-disabled"><span>'.$text.'</span></li>';
	}

	/**
	 * Возвращает обертку для активного элемента пагинации.
	 *
	 * @param string $text
	 * @return string
	 */
	protected function getActivePageWrapper($text)
	{
		return '<li class="uk-active"><span>'.$text.'</span></li>';
	}
}