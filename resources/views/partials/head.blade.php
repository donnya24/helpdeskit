<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Help Desk IT') }}</title>

<!-- Flux Styles -->
@fluxStyles

@livewireStyles

<style>
    [x-cloak] { display: none !important; }
</style>
