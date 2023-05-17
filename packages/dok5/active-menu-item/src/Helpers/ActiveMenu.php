<?php

/**
 *
 * Возвращает $className, если имя текущего маршрута или текущий URI совпадает с $routeNameOrPath.
 *
 * @param string $routeNameOrPath Имя маршрута или URI
 * @param string $className Css class name, optional
 * @return string            Css class name if it's current URI, otherwise - empty string
 *
 */
function isActive(string $routeNameOrPath, string $className = 'active')
{
    $r = is_null(Route::currentRouteName()) ? Request::path() : Route::currentRouteName();
    return $r === $routeNameOrPath ? $className : '';
}
