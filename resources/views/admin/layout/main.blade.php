<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Blank - Windmill Dashboard</title>
	<link rel="stylesheet" href="{{ asset('admin/css/tailwind.output.css')}}" />
	<script
	src="{{asset('admin/js/alpine.min.js')}}"
	defer
	></script>
	<script src="{{ asset('admin/js/init-alpine.js')}}"></script>
	<link rel="stylesheet" href="{{ asset('admin/css/Chart.min.css')}}"/>
    <script src="{{ asset('admin/js/Chart.min.js')}}"></script>
	@livewireStyles
</head>
<body>
	<div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
		<!-- Desktop sidebar -->
		@include('admin.layout.sidebar')
      	<!-- Mobile sidebar -->
      	<!-- Backdrop -->
		<div
			x-show="isSideMenuOpen"
			x-transition:enter="transition ease-in-out duration-150"
			x-transition:enter-start="opacity-0"
			x-transition:enter-end="opacity-100"
			x-transition:leave="transition ease-in-out duration-150"
			x-transition:leave-start="opacity-100"
			x-transition:leave-end="opacity-0"
			class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
		></div>
     
      	<div class="flex flex-col flex-1">
        	@include('admin.layout.header')
        	<main class="h-full pb-16 overflow-y-auto">
				{{$slot}}
        	</main>
      	</div>
    </div>

</body>
	@livewireScripts

	@stack('scripts')
</html>
