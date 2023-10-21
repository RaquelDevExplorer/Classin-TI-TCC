<x-app-layout>
    <x-slot name="header">
        <div class='flex justify-between items-center'>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Hi') . ', ' . Auth::user()->name . '!' }}
            </h2>
            <div>
                <x-search-bar />
            </div>
        </div>
    </x-slot>

    <div x-data="{ folhas: {{ $folhas }} }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold p-2">
                        {{ __("Caderno") }}
                    </h1>
                </div>
                <div class='grid grid-cols-2 md:grid-cols-4'>
                    <x-card folha="undefined"></x-card>

                    <template x-for="folha in folhas">
                        <x-card folha="folha"></x-card>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
