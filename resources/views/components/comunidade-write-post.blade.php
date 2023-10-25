@php
    $perfil = isset(Auth::user()->perfil) ? Auth::user()->perfil : null;
@endphp

<div id="create-post" class="max-w-2xl m-auto py-6">
    @auth
        <h1 class="mb-4">Compartilhe seus pensamentos!</h1>
        <div class="flex gap-5">
            <img class="w-10 h-10 rounded-full" src="{{ $perfil->foto }}" alt="Foto de perfil de {{ $perfil->name }}">
            <textarea name="post-body" rows="4" class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring-0" placeholder="Comece com um Olá, Mundo!"></textarea>
        </div>
    @else
        <h1 class="mb-4">Junte-se a nós para compartilhar seus pensamentos!</h1>
        <div class="flex gap-5">
            <img class="w-10 h-10 rounded-full" src="{{ \Storage::url('profiles/default.png') }}" alt="Foto de perfil de {{ \Storage::url('Visitante') }}">
            <textarea
                disabled
                rows="4"
                class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring-0"
                placeholder="Cadastre-se para publicar!"
            ></textarea>
        </div>
    @endauth

    {{-- TODO: implementar os botões para fazer publicação --}}
    <div class="w-full flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
        <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x dark:divide-gray-600">
            <div class="flex items-center space-x-1 sm:pr-4">
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <i class="bi bi-paperclip"></i>
                    <span class="sr-only">Anexar Arquivo</span>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <i class="bi bi-book-half"></i>
                    <span class="sr-only">Anexar Folha</span>
                </button>
                <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <i class="bi bi-image"></i>
                    <span class="sr-only">Anexar Imagem</span>
                </button>
            </div>
        </div>
        <div>
            <button type="button" class="p-2 text-gray-500 rounded cursor-pointer sm:ml-auto hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                </svg>
                <span class="sr-only">Cofigurações</span>
            </button>
            <button type="button" class="p-2 text-white rounded cursor-pointer sm:ml-auto bg-green-400 hover:bg-green-500">
                <span class="">Publicar</span>
            </button>
        </div>
    </div>
</div>
