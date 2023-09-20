<nav id="menu-nav" x-data="{ open: false }" class="bg-white border-r-1 border-gray-100 w-full md:w-min">
    <div id="menu-btn" class='p-5 w-full md:hidden d-block' @click="open = !open">
        <i class="bi bi-list text-2xl"></i>
    </div>

    <div
        x-init="!isMenuBtnVisible() ? open = true : open = false"
        x-on:resize.window="!isMenuBtnVisible() ? open = true : open = false"
        x-show="open"
        class='p-5 flex flex-col items-start md:items-center justify-between md:h-screen absolute md:relative bg-white w-full md:w-min'
    >
        {{-- Upper links --}}
        <div class="flex flex-col md:block items-start md:items-center">
            {{-- Logo --}}
            <x-application-logo x-show="!isMenuBtnVisible()" class="block mb-10 h-9 w-auto fill-current text-gray-800" />

            {{-- Carderno --}}
            <div class="text-left md:text-center mb-3">
                <x-nav-link :href="route('caderno.show')" :active="request()->routeIs('caderno.show')">
                    <i class="bi bi-journal-bookmark-fill text-2xl"></i>
                    <p x-show="isMenuBtnVisible()" class='mx-3 text-2xl'>Caderno</p>
                </x-nav-link>
            </div>

            {{-- Agenda --}}
            <div class="text-left md:text-center mb-3">
                <x-nav-link :href="route('agenda.show')" :active="request()->routeIs('agenda.show')">
                    <i class="bi bi-calendar-event-fill text-2xl"></i>
                    <p x-show="isMenuBtnVisible()" class='mx-3 text-2xl'>Agenda</p>
                </x-nav-link>
            </div>

            {{-- Comunidade --}}
            <div class="text-left md:text-center mb-3">
                <x-nav-link :href="route('comunidade.show')" :active="request()->routeIs('comunidade.show')">
                    <i class="bi bi-people-fill text-2xl"></i>
                    <p x-show="isMenuBtnVisible()" class='mx-3 text-2xl'>Comunidade</p>
                </x-nav-link>
            </div>
        </div>

        {{-- Bottom links --}}
        <div class="flex flex-col items-start md:items-center md:block">
            @auth
                {{-- Logout --}}
                <div class="mb-3">
                    <form method="POST" action="{{ route('logout') }}" class='text-center'>
                        @csrf

                        <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="bi bi-box-arrow-right text-2xl"></i>
                            <p x-show="isMenuBtnVisible()" class='mx-3 text-2xl'>Sair</p>
                        </x-nav-link>
                    </form>
                </div>
                {{-- Profile image --}}
                <div class='mt-3 md:mt-0'>
                    <x-nav-link :href="route('profile.show', Auth::user()->username)" :active="request()->routeIs('profile.show')">
                        <img class='rounded-full w-7' src="{{ Auth::user()->perfil->getFotoUrl() }}" alt="">
                        <p x-show="isMenuBtnVisible()" class='mx-3 text-2xl'>Perfil</p>
                    </x-nav-link>
                </div>
            @else
                <x-nav-link :href="route('login')">
                    Login
                </x-nav-link>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Checa se o botão de abrir o menu está visível
    // Se estiver visível, o dispositivo é de tela pequena
    function isMenuBtnVisible() {
        return document.getElementById('menu-btn').clientWidth != 0;
    }
</script>


{{-- <div class="mt-3 space-y-1">
    <x-responsive-nav-link :href="route('profile.show', Auth::user())">
        {{ __('Profile') }}
    </x-responsive-nav-link>

    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>
</div>

<div class="mt-3 space-y-1">
    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
        {{ __('Login') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
        {{ __('Register') }}
    </x-responsive-nav-link>
</div> --}}
