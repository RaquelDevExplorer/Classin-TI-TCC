<nav id="menu-nav" x-data="{ open: false }" class="bg-white border-r-1 border-gray-100 w-full md:w-min">

    {{-- Botão para abrir menu lateral mobile --}}
    <button data-drawer-target="side-menu" data-drawer-toggle="side-menu" aria-controls="side-menu" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <div class='hidden md:flex p-5 flex-col items-start md:items-center justify-between md:h-screen absolute md:relative bg-white w-full md:w-min'>
        {{-- Upper links --}}
        <div class="flex flex-col md:block items-start md:items-center">
            {{-- Logo --}}
            <x-application-logo class="block mb-10 h-9 w-auto fill-current text-gray-800" />

            {{-- Carderno --}}
            <div class="text-center mb-3">
                <x-nav-link :href="route('caderno.index')" :active="request()->routeIs('caderno.index')" data-tooltip-target="caderno-tooltip" data-tooltip-style="light">
                    <i class="bi bi-journal-bookmark-fill text-2xl"></i>
                </x-nav-link>
                <div id="caderno-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip transition duration-500 ease-in-out">
                    Meu Caderno
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>

            {{-- Agenda --}}
            <div class="text-center mb-3">
                <x-nav-link :href="route('agenda.index')" :active="request()->routeIs('agenda.index')" data-tooltip-target="agenda-tooltip" data-tooltip-style="light">
                    <i class="bi bi-calendar-event-fill text-2xl"></i>
                </x-nav-link>
                <div id="agenda-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip transition duration-500 ease-in-out">
                    Minha Agenda
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>

            {{-- Comunidade --}}
            <div class="text-center mb-3">
                <x-nav-link :href="route('comunidade.index')" :active="request()->routeIs('comunidade.index')" data-tooltip-target="comunidade-tooltip" data-tooltip-style="light">
                    <i class="bi bi-people-fill text-2xl"></i>
                </x-nav-link>
                <div id="comunidade-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip transition duration-500 ease-in-out">
                    Comunidade
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>

        {{-- Bottom links --}}
        <div class="flex flex-col items-start md:items-center md:block">
            @auth
            {{-- Logout --}}
            <div class="mb-3">
                <form method="POST" action="{{ route('logout') }}" class='text-center' data-tooltip-target="logout-tooltip" data-tooltip-style="light">
                    @csrf
                    <x-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right text-2xl"></i>
                    </x-nav-link>
                </form>
                <div id="logout-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip transition duration-500 ease-in-out">
                    Sair
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            {{-- Profile image --}}
            <div class='mt-3 md:mt-0'>
                <x-nav-link :href="route('profile.show', Auth::user()->username)" :active="request()->routeIs('profile.show')" data-tooltip-target="profile-tooltip" data-tooltip-style="light">
                    <img class='rounded-full w-7' src="{{ Auth::user()->perfil->getFotoUrl() }}" alt="">
                </x-nav-link>
                <div id="profile-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip transition duration-500 ease-in-out">
                    Meu Perfil
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            @else
            <x-nav-link :href="route('login')">
                Login
            </x-nav-link>
            @endauth
        </div>
    </div>

{{-- Menu lateral que só aparece para usuários mobile ao clicarem no botão --}}
<aside id="side-menu" class="md:hidden fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('profile.show', Auth::user()->username) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    @auth
                        <img src="{{ Auth::user()->perfil->getFotoUrl() }}" class="w-6 h-6 rounded-full" alt="Foto de {{ Auth::user()->name }}">
                        <span class="ml-3">Meu Perfil</span>
                    @else
                        <span class="ml-3">Usuário da Internet</span>
                    @endauth
                </a>
            </li>
            <li>
                <a href="{{ route('caderno.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="bi bi-journal-bookmark-fill text-2xl text-gray-{{ request()->routeIs('caderno.*') ? '600' : '400' }}"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Meu Caderno</span>
                    {{-- <span class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span> --}}
                </a>
            </li>
            <li>
                <a href="{{ route('agenda.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="bi bi-calendar-event-fill text-2xl text-gray-{{ request()->routeIs('agenda.*') ? '600' : '400' }}"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Minha Agenda</span>
                    {{-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span> --}}
                </a>
            </li>
            <li>
                <a href="{{ route('comunidade.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="bi bi-people-fill text-2xl text-gray-{{ request()->routeIs('comunidade.*') ? '600' : '400' }}"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Comunidade</span>
                </a>
            </li>

            @auth
                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        @click="document.getElementById('logout-form').submit();"
                        >
                        <i class="bi bi-box-arrow-right text-2xl"></i>
                        <span class="flex-1 ml-3 whitespace-nowrap">Sair</span>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class='inline' data-tooltip-target="logout-tooltip" data-tooltip-style="light">
                            @csrf
                        </form>
                    </a>
                </li>
            @else
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Sign In</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                            <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                            <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Sign Up</span>
                    </a>
                </li>
            @endauth

        </ul>
    </div>
</aside>
</nav>
