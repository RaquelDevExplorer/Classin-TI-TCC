<x-app-layout>
    <x-slot name="header">
        <div class='flex justify-between items-center'>
            Editando Folha

            <div x-data="{ isOpen: false }" class="relative">
                <button @click="isOpen = !isOpen" class="flex items-center justify-center px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Opções
                    <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 12l-6-6h12l-6 6z" />
                    </svg>
                </button>
                <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 py-2 bg-white rounded-md shadow-lg">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Excluir Folha</a>
                </div>
            </div>
        </div>
    </x-slot>
    <div>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mb-3">
                        <h1 class="text-2xl font-bold p-2" contenteditable>{{ $folha_json['title'] }}</h1>
                    </div>
                    <x-view-folha :folha="$folha_json"></x-view-folha>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
