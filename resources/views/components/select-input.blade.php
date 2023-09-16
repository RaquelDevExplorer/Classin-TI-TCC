@props(['options', 'selected', 'name', 'id'])

<div x-data='{ options: {!! json_encode($options) !!}, selected: {{ $selected }} }'>
    <select {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', 'name' => $name, 'id' => $id]) }}>
        <template x-for='(option, value) in options' key='option'>
            <option
                x-bind:selected="value == selected"
                {{-- x-bind:selected="true" --}}
                x-bind:value="value"
                x-text='option'
            ></option>
        </template>
    </select>
</div>
