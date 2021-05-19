<?php

// Просто один из возможных шаблонов для настройки роутера
\Up\Router::add(
	"GET",
	"/user/profile",
	[\Up\Controller\User::class, "view"]
);