<?php

/**
 * Возвращает JSON ответ.
 *
 * @param string|array $data
 * @param int $status
 * @return \Symfony\Component\HttpFoundation\Response
 */
function json_response($data, $status = 200)
{
	return response()->json($data, $status);
}

/**
 * Возвращает название ресурса.
 *
 * @return string
 */
function get_current_resource()
{
	return explode('.', Route::getCurrentRoute()->getName())[1];
}

/**
 * Возвращает текущий идентификатор.
 *
 * @return string
 */
function get_current_id()
{
	$route = Route::getCurrentRoute();

	return $route->getParameter($route->parameterNames()[0]);
}

/**
 * Возвращает роут для удаления сущности.
 *
 * @param int $id
 * @return string
 */
function destroy_route($id = null)
{
	$id = ($id ?: get_current_id());

	return route('crm.' . get_current_resource() . '.destroy', compact('id'));
}