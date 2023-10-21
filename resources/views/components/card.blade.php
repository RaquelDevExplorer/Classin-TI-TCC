<div x-data="{ folha: {{ $folha }}, showMenuBtn: false, showMenu: false }" class="border border-gray-300 rounded-lg m-2 cursor-pointer hover:bg-gray-100">
    <template x-if="folha">
        <div @click="window.location.href = '/caderno/' + folha.id">
            <div class="relative top-0">
                <img :src="folha.image">
            </div>
            <div class="flex items-center justify-between p-2">
                <h3 class="font-bold text-lg" x-text="folha.json.title"></h3>
            </div>
        </div>
    </template>

    <!-- Aparece quando folha não está definida -->
    <!-- É a opção para criar novas folhas -->
    <template x-if="folha == undefined">
        <div @click="criarFolha()">
            <div class="relative top-0">
                <img src="/storage/folhas/backgrounds/create.png">
            </div>
            <div class="flex items-center justify-between p-2">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <h3 class="font-bold text-lg">Criar nova Folha</h3>
            </div>
        </div>
    </template>
</div>

<script>

function criarFolha() { // VERIFICAR ERRO AQUI!!!
    const url = '{{ route("caderno.store") }}'
    console.log(typeof url, url);
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
        }
    })
        .then((data) => {
            window.location.href = data.url;
        })
        .catch(error => {
            console.log(error);
        })
}

</script>
