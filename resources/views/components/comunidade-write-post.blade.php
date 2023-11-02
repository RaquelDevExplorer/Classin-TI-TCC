@php
    $perfil = isset(Auth::user()->perfil) ? Auth::user()->perfil : null;
@endphp

<div x-data id="create-post" class="max-w-2xl m-auto py-6">
    <h1 class="mb-4">Compartilhe seus pensamentos!</h1>
    <form id="create-post-form" action="{{ route('api.comunidade.posts.store') }}" method="POST" @submit.prevent="sendPost">
        @auth
            <div class="flex gap-5">
                <img class="w-10 h-10 rounded-full" src="{{ $perfil->foto }}" alt="Foto de perfil de {{ $perfil->name }}">
                <textarea name="body" rows="4" class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring-0" placeholder="Comece com um Olá, Mundo!"></textarea>
            </div>
        @else
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

        <div class="mt-5">
            <div @click="unsetFolhaId()" id="selected-folha" class="hidden flex gap-3 p-3 items-center bg-gray-200 hover:bg-gray-300 transition rounded-lg w-fit cursor-pointer">
                <i class="bi bi-file-earmark-fill"></i>
                <small id="selected-folha-text"></small>
                <i class="bi bi-x-lg"></i>
            </div>

            <div id="image-preview-div" class="relative cursor-pointer transition">
                <img id="image-preview" class="hover:brightness-75 ">
            </div>
        </div>

        {{-- TODO: implementar os botões para fazer publicação --}}
        <div class="w-full flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
            <input type="hidden" name="post_ref_id">
            <input type="hidden" name="folha_id">

            <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x dark:divide-gray-600">
                <div class="flex items-center space-x-1 sm:pr-4">

                    <button type="button" class="text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <label for="file" class="p-2 cursor-pointer">
                            <i class="bi bi-paperclip"></i>
                        </label>
                        <input type="file" id="file" name="file" class="hidden">
                        <span class="sr-only">Anexar Arquivo</span>
                    </button>

                    <div x-data="{ folhas: [] }">
                        <x-dropdown align="left">
                            <x-slot name="trigger" >
                                <button @click="folhas = getFolhas()" type="button" class="text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                    <i class="bi bi-book-half p-2"></i>
                                    <span class="sr-only">Anexar Folha</span>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="p-5 h-60 overflow-auto">
                                    <template x-for="folha in folhas">
                                        <div class="cursor-pointer" @click="setFolhaId(folha)">
                                            <p class="py-2" x-text="folha.folhaJson.title"></p>
                                            <hr>
                                        </div>
                                    </template>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <button type="button" class="text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <label for="image" class="p-2 cursor-pointer">
                            <i class="bi bi-image"></i>
                        </label>
                        <input @change="imageHandler" type="file" id="image" name="image" class="hidden">
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
                <button type="submit" class="p-2 text-white rounded cursor-pointer sm:ml-auto bg-green-400 hover:bg-green-500">
                    <span class="">Publicar</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function sendPost(e) {
        const form = e.target
        const formData = new FormData(form);

        axios.post(
            form.action,
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            }
        )
            .then(res => {
                window.location.reload();
            })
            .catch(err => {
                form.innerHTML += `<x-input-error
                        class="mt-2"
                        messages="${err.response.data.message}"
                        x-data="{ show: true }"
                        x-init="setTimeout(() => $el.remove(), 3000)">
                    </x-input-error>`
            })
    }

    async function getFolhas() {
        const res = await axios.get("{{ route('api.folhas') }}");
        return res.data.folhas;
    }

    function setFolhaId(folha) {
        document.querySelector("input[name='folha_id']").value = folha.id;

        document.querySelector("#selected-folha").classList.remove("hidden");
        document.querySelector("#selected-folha-text").innerHTML = folha.folhaJson.title;
    }

    function unsetFolhaId() {
        document.querySelector("input[name='folha_id']").value = "";
        document.querySelector("#selected-folha").classList.add("hidden");
    }

    function imageHandler(e) {
        const fileToUpload = e.target.files.item(0);
        const reader = new FileReader();
        const previewImg = document.querySelector("#image-preview");

        // evento disparado quando o reader terminar de ler
        reader.onload = e => previewImg.src = e.target.result;

        // solicita ao reader que leia o arquivo
        // transformando-o para DataURL.
        // Isso disparará o evento reader.onload.
        reader.readAsDataURL(fileToUpload);
    }
</script>
