<?php
namespace Illuminate\Contracts\Routing {
    class ResponseFactory
	{
        public static function error($error = 'Internal Error', $status = 500, $extra = [])
		{
			return null;
        }
        
        public static function resource($resource = null, $extra = [], $statusCode = 200)
		{
			return null;
        }
    }
}

namespace Illuminate\Http {
	class Request
	{
		public static function api($routeName, $routeParams = [], $queryParams = [])
		{
			return null;
		}
		
		public static function validate($rules = [], $messages = [])
		{
			return null;
		}
		
		public static function included($relations)
		{
			return null;
		}
	}
}

namespace Illuminate\Routing {
	class Router
	{
		public static function jumpToRoute(string $routeName)
		{
			return null;
		}
	}
}
