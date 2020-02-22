<?php
namespace MyFramework\Auth\URLAuth;

use MyFramework\Routing\Router;


class URLAuth{

	public $level1 = 'primaire';
	public $level2 = 'secondaire';





	public static function urlLevelAuthenticate(string $url, Router $router = null)
	{
		if ($url !== 'secondaire' && $url !== 'primaire') {
			header('Location:'.$router->urlPut('AdminClasses'));
		}
	}
}