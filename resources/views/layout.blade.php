<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google-site-verification" content="aE_3c29Fx2R3WJkzsE1FLGSgIc9yL9zE6j5EOnNJaUA">
	<title>{{ store('meta.title') }} – {{ config('app.name', 'Laravel') }}</title>
	@if (store('meta.description'))
		<meta name="description" content="{{ store('meta.description') }}">
	@endif
	@if (store('meta.canonical'))
		<link rel="canonical" href="{{ store('meta.canonical') }}">
	@endif
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	{!! $resourceHints !!}
	{!! $styles !!}
	<!-- {{ $executionTime }}ms -->
</head>
<body>
	{!! $outlet !!}
	<script>
        window.__INITIAL_STATE__ = {!! json_encode(store('state'), JSON_UNESCAPED_UNICODE) !!};
	</script>
	{!! $scripts !!}
	@include('components.statcounter')
</body>
</html>
