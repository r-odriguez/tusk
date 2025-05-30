<?php declare(strict_types=1);

namespace tusk;

/**
 * Calls the `main.php` controller of a specific `$route`.
 *
 * @param string $route Route
 * @param string $prefix Route's prefix
 *
 * @return void
 */
function controller($route, $prefix)
{
	if (is_file(base_path($prefix . $route))) {
		require_once base_path($prefix . $route);
		return;
	}

	require_once base_path($prefix . $route . '/main.php');
}

/**
 * Calls the `view.php` view of a specific route. This functions is dynamic,
 * it uses the `URL['path']` global variable to determine which `view.php`
 * should be called.
 *
 * @param array $ctx Context variables that should be accessible in the view.
 *
 * @return void
 */
function view($ctx = [])
{
	extract($ctx);
	require_once base_path(\WEB_DIR . URL['path'] . "/view.php");
}

/**
 * Calls an html snippet based on the `URL['path']` global variable. It uses
 * the `COMPONENT_DIR_NAME` global variable to locate the correct folder under
 * the specified route.
 *
 * @param string $name The name of the file without the .php extension
 * @param array $ctx Context variables that should be accessible in the view.
 *
 * @return void
 */
function snip($snip_name, $ctx = [], $components_path = URL['path'])
{
	extract($ctx);
	require base_path(
		\WEB_DIR . $components_path . '/' . \COMPONENTS_DIR_NAME . "/$snip_name.php"
	);
}

/**
 * Calls a specific html snippet that should be used sporadically, like
 * `<head/>` or `<nav/>`. Uses the `GLOBALS_DIR` global variable to locate
 * the files.
 *
 * @param string $name The name of the file without the .php extension.
 * @param array $ctx Context variables that should be accessible in the view.
 */
function globals($name, $ctx = [])
{
	extract($ctx);
	require base_path(\GLOBALS_DIR . "/$name.php");
}

/**
 * Return an error page with an exit(1). Uses the `ERROR_PAGES_DIR` to locate
 * the page.
 *
 * @param string $name Name of the error page without the .php extension.
 */
function error_page($name)
{
	require_once base_path(\ERROR_PAGES_DIR . "/$name.php");
	exit(1);
}

function icon(string $name, string $ext = "svg", array $ctx = []): void
{
	extract($ctx);
	require base_path(\ICONS_DIR . "/$name.$ext");
}

function svg(string $name, array $ctx = []): void
{
	extract($ctx);
	require base_path(\SVG_DIR . "/$name.svg");
}

function csrf()
{
	$csrf_token = session\get_csrf_token();
	return "<input type='hidden' name='csrf-token' value='$csrf_token' />";
}
