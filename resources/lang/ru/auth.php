<?php

return [
	'failed' => 'Вы указали неверный логин или пароль.',
	'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
	'unauthorized' => 'Сессия пребывания в CRM окончена. Вам необходимо ' .
	                  link_to_route('auth.login.form', 'авторизоваться заново') . '.'
];