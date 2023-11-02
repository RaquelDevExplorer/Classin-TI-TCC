@props(['post'])

<div x-data="{ post: {{$post}} }" :post-id="post.id" :author-id="post.perfil.id" :author-username="post.perfil.user.username" class='post-div hover:bg-gray-200 cursor-pointer flex gap-5 p-8 transition' @click="postClicked">

    {{-- Imagem do autor --}}
    <div x-data="{}" x-on:click.stop>
        <img :src="post.perfil.foto" alt="" class="w-8 h-8 rounded-full" @click="profileClicked">
    </div>

    <div x-init="console.log(post)" class="w-full">
        {{-- Nome do autor --}}
        <div class='flex items-center gap-1 hover:text-gray-500 transition' x-on:click.stop @click="profileClicked">
            <p x-text="post.perfil.user.name"></p>
            <small :for="'post_' + post.id" x-text="'@' + post.perfil.user.username"></small>
        </div>

        {{-- Corpo do post do autor --}}
        <div x-data="{}" class="mb-3">
            <p x-text="post.corpo"></p>
        </div>

        <template x-if="post.post_ref">
            <div x-data class="p-3 flex gap-3 border border-gray-300 rounded mb-3 w-full" @click="window.location.href = '/comunidade/post/' + post.post_ref.id">

                <div x-data="{}" x-on:click.stop>
                    <img :src="post.post_ref.perfil.foto" alt="" class="w-8 h-8 rounded-full" @click="profileClicked">
                </div>

                <div class='items-center gap-1 hover:text-gray-500' x-on:click.stop @click="window.location.href = '/comunidade/post/' + post.post_ref.id">
                    <div class="flex items-center gap-1 hover:text-gray-500">
                        <p x-text="post.post_ref.perfil.user.name"></p>
                        <small :for="'post_' + post.post_ref.id" x-text="'@' + post.post_ref.perfil.user.username"></small>
                    </div>

                    {{-- Corpo do post do autor --}}
                    <div x-data="{}" class="mb-3">
                        <p x-text="post.post_ref.corpo"></p>
                    </div>
                </div>

                <template x-if="post.image">
                    <div class="mt-5 flex gap-3 p-3 items-center bg-gray-200 hover:bg-gray-300 rounded w-fit cursor-pointer">
                        <img :src="post.post_ref.image" alt="" srcset="">
                    </div>
                </template>

            </div>
        </template>

        <div class="flex gap-5" x-on:click.stop>
            <div @click="likeClicked">
                <i class="bi bi-heart"></i>
                {{-- <i class="bi bi-heart-fill"></i> --}}
            </div>
            <div>
                <i class="bi bi-shuffle" @click="$el.closest('.post-div').querySelector('.repost-input-div').classList.toggle('hidden')"></i>
            </div>
            <small x-text="post.created_at_formatted"></small>
        </div>

        {{-- Input para re-postar o post --}}
        <div @click.stop class="repost-input-div relative hidden">
            <i class="bi bi-send-arrow-up absolute top-1/2 right-2 translate-y-[-50%]" @click="repostClicked"></i>
            <textarea type="text" name="body" class="w-full rounded-lg pr-6" placeholder="Digite a mensagem para o seu repost" cols="3"></textarea>
        </div>

        {{-- Mostra a folha do post --}}
        <template x-if="post.folha">
            <div class="mt-5 flex gap-3 p-3 items-center bg-gray-200 hover:bg-gray-300 transition rounded-lg w-fit cursor-pointer">
                <i class="bi bi-file-earmark-fill"></i>
                <small x-text="post.folha.folhaJson.title"></small>
            </div>
        </template>

        {{-- Mostra a imagem do post --}}
        <template x-if="post.image">
            <div class="mt-5 flex gap-3 p-3 items-center bg-gray-200 hover:bg-gray-300 transition rounded w-fit cursor-pointer">
                <img :src="post.image" alt="" srcset="">
            </div>
        </template>

    </div>

</div>
