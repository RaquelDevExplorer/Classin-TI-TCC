<x-app-layout>
    <div>
        <x-slot name="header">
            <div class='flex md:px-20'>
                {{-- Foto de perfil --}}
                <img src="{{ $profile->getFotoUrl() }}" class='w-1/6 h-1/6 rounded-full' />

                <div class='px-5 md:px-10 w-max'>
                    {{-- Nome do usuário e bio --}}
                    <div>
                        <h1 class='text-bold md:text-2xl text-sm'>{{ $user->name }}</h1>
                        <p class='md:text-sm text-xs'>{{ $profile->bio }}</p>
                    </div>

                    {{-- Informações sobre seguidores e botões de ação --}}
                    <div class='mt-5 md:mt-10'>
                        <div class='flex gap-20'>
                            {{-- TODO: Implementar a lista de seguidores --}}
                            <p>...</p>
                            {{-- TODO: Implementar a lista de seguindo --}}
                            <p>...</p>
                        </div>

                        @auth
                            @if (Auth::user()->id !== $user->id)
                                <x-primary-button>
                                    Seguir
                                </x-primary-button>
                                <x-secondary-button>
                                    Mensagem
                                </x-secondary-button>
                            @else
                                <a href="{{ route('profile.edit') }}">
                                    <x-secondary-button>
                                            Editar
                                    </x-secondary-button>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}">
                                <x-secondary-button>
                                    Faça login para interagir!
                                </x-secondary-button>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </x-slot>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        TODO
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
