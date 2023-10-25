<x-app-layout>
    <div>
        <x-slot name="header">
            <div class='md:px-20'>
                {{-- Foto de perfil e informações de seguidores --}}
                <div class='flex justify-between items-center pb-3'>
                    <img src="{{ $profile->foto }}" class='w-1/6 h-1/6 rounded-full' />
                    <div class='text-center'>
                        <h3>{{ $profile->getTotalPosts() }}</h3>
                        <p>Publicações</p>
                    </div>
                    <div class='text-center'>
                        <h3>{{ $profile->getTotalSeguidores() }}</h3>
                        <p>Seguidores</p>
                    </div>
                    <div class='text-center'>
                        <h3>{{ $profile->getTotalSeguindo() }}</h3>
                        <p>Seguindo</p>
                    </div>
                </div>
                {{-- Nome do usuário e bio --}}
                <div class='pb-3'>
                    <h1 class='text-bold md:text-2xl text-sm'>{{ $user->name }}</h1>
                    <p class='md:text-sm text-xs'>{{ $profile->bio }}</p>
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
