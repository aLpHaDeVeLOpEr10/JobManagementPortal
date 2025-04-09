<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Job Management Portal') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center justify-between">
                @auth
                @if (auth()->user()->role != 'admin')
                <a class="text-xl font-bold" href="{{ url('/') }}">Job Search</a>
                @else
                <a class="text-xl font-bold" href="{{ route('admin.dashboard') }}">Job Management</a>
                @endif
                @endauth

                <div class="hidden lg:flex space-x-4">
                    @guest
                        <a class="text-gray-700 hover:text-blue-500" href="{{ url('/') }}">Browse Jobs</a>
                    @endguest
                    @auth
                    @if (auth()->user()->role != 'admin')
                    <a class="text-gray-700 hover:text-blue-500" href="{{ url('/') }}">Browse Jobs</a>
                    @endif
                    @endauth
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <a class="text-gray-700 hover:text-blue-500" href="{{ route('admin.dashboard') }}">Admin
                                Dashboard</a>
                            <a class="text-gray-700 hover:text-blue-500" href="{{ route('admin.jobs.index') }}">Manage
                                Jobs</a>
                            <a class="text-gray-700 hover:text-blue-500"
                                href="{{ route('admin.applications') }}">Applications</a>
                            <a class="text-gray-700 hover:text-blue-500" href="{{ route('admin.users') }}">Users</a>
                        @else
                            <a class="text-gray-700 hover:text-blue-500" href="{{ route('my.applications') }}">My Applications</a>
                        @endif
                    @endauth
                </div>

                <div class="hidden lg:flex items-center space-x-4">
                    @guest
                        <a class="text-gray-700 hover:text-blue-500" href="{{ route('login') }}">Login</a>
                        <a class="text-gray-700 hover:text-blue-500" href="{{ route('register') }}">Register</a>
                    @else
                        <div class="relative inline-block text-left">
                            <button type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                {{ auth()->user()->name }}
                                <svg class="-mr-1 ml-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06 0l3.47 3.47 3.47-3.47a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div
                                class="absolute right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                <div class="py-1">
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-4 p-4">
        <div class="content">
            @yield('content')
        </div>
    </main>

    <footer class="text-center mt-4">
        <p class="text-gray-600">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </footer>
</body>

</html>
