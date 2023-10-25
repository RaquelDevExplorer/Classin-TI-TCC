@props(['post'])

<div x-data="{ post: {{$post}} }" :post-id="post.id" :author-id="post.perfil.id" :author-username="post.perfil.user.username" class='post-div hover:bg-gray-200 cursor-pointer flex gap-5 p-8' @click="postClicked">

    {{-- Imagem do autor --}}
    <div x-data="{}" x-on:click.stop>
        <img :src="post.perfil.foto" alt="" class="w-8 h-8 rounded-full" @click="profileClicked">
    </div>

    <div>
        {{-- Nome do autor --}}
        <div class='flex items-center gap-1' @click="profileClicked">
            <p x-text="post.perfil.user.name"></p>
            <small :for="'post_' + post.id" x-text="'@' + post.perfil.user.username"></small>
        </div>

        {{-- Corpo do post do autor --}}
        <div x-data="{}" class="mb-3">
            <p x-text="post.corpo"></p>
        </div>
        <div class="flex gap-5" x-on:click.stop>
            <div @click="likeClicked">
                <i class="bi bi-heart"></i>
                {{-- <i class="bi bi-heart-fill"></i> --}}
            </div>
            <small x-text="post.created_at_formatted"></small>
        </div>
    </div>

</div>
