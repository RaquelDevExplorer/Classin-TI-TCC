@props(['apiUrl', 'nomeLista'])

<div
    x-cloak
    x-data="{ lista: [], isLoading: true }"
    x-init="let data = await (await fetch('{{ $apiUrl }}')).json();
        lista = data['{{ $nomeLista }}']; isLoading = false;"
>
    {{ $slot }}
    <datalist id="{{ $nomeLista }}">
        <template x-for="item in lista" :key="JSON.stringify(item)">
            <option x-text="item"></option>
        </template>
    </datalist>
</div>
