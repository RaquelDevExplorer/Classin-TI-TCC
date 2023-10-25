<x-app-layout>
    <x-slot name='header'>
        <h1>Comunidade</h1>
    </x-slot>

    <div class="md:py-12">
        <div class="w-full md:max-w-7xl mx-auto sm:px-6 lg:px-8 md:grid grid-cols-5 gap-6">
            {{-- Comunidade esquerda --}}
            <div class="hidden md:block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                teste
            </div>

            {{-- Comunidade centro --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:col-span-3">
                {{-- Menu superior --}}
                <div>
                    <h1>

                    </h1>
                </div>

                {{-- Componente para criação de post para a comunidade --}}
                <x-comunidade-write-post></x-comunidade-write-post>


                {{-- Div principal para mostrar os posts da comunidade --}}
                <div id="posts-div" x-data="{ posts: [], nextPage: false }" x-init="getPosts(nextPage).then(p => { posts = p.posts; nextPage = p.posts.nextPage });" class="md:p-10">
                    <template x-for="post in posts.data">
                        <x-comunidade-post post="post"></x-comunidade-post>
                    </template>

                    <div class="text-center mt-5">
                        <button @click="getPosts(nextPage).then(p => { if(p) {posts.data.push(...p.posts.data); nextPage = p.posts.next_page_url }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="bi bi-arrow-down"></i>
                            Carregar mais posts
                        </button>
                    </div>
                </div>
            </div>

            {{-- Comunidade direita --}}
            <div class="hidden md:block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                teste
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    async function getPosts(nextPage) {
        if(nextPage === null) {
            return false;
        }

        const res = await axios.get(nextPage ? nextPage : '/api/comunidade/posts');
        return res.data
    }

    function postClicked(e) {
        const postId = e.target.closest('.post-div').getAttribute('post-id');
        window.location.href = `/comunidade/post/${postId}`;
    }

    function profileClicked(e) {
        const authorUsername = e.target.closest('.post-div').getAttribute('author-username');
        window.location.href = `/perfil/${authorUsername}`;
    }

    function likeClicked(e) {
        const postId = e.target.closest('.post-div').getAttribute('post-id');
        // TODO
    }
</script>
