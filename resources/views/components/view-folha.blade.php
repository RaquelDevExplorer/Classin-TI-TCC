@props(['folha'])

<div x-data="folha">
    <template x-for="block in folha.blocks" :key="JSON.stringify(block)">
        <div id="block" x-html="block.html" class="p-2" contenteditable @keydown.slash="onSlash" @keydown.enter="onEnter" x-on:blur="lostFocus"></div>
    </template>

    <template id="menu" x-model="showMenu" x-if="showMenu">
        <select>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('folha', () => ({
            showMenu: false,
            folha: {!! str_replace('"', '\'', json_encode($folha)) !!},

            onSlash(e) {
                // TODO: criar o handler para abrir o menu no local correto
                // E criar o handler para fechar o menu
                this.showMenu = true;
                configureTextMenu();
            }
        }))
    })

    function onEnter(e) {
        e.preventDefault();
        e.target.insertAdjacentHTML('afterend', '<div id="block" class="p-2" contenteditable @keydown.slash="onSlash" @keydown.enter="onEnter" x-on:blur="lostFocus"></div>');

        let blocks = document.querySelectorAll('#block');
        blocks[Array.from(blocks).indexOf(e.target)+1].focus();
        console.log(e.target);
        console.log(e.target.closest('#block'))
    }

    function lostFocus(e) {
        console.log('txt: ' + e.target.innerHTML)
        if(e.target.innerHTML == '') {
            e.target.remove();
        }
    }

    function configureTextMenu() {
        let dropdownMenu = document.getElementById('menu');
        let { top, left } = getCaretPosition();
        console.log(top, left,dropdownMenu);
        dropdownMenu.style.display = 'block';
        dropdownMenu.style.position = 'absolute';
        dropdownMenu.style.top = top + 'px';
        dropdownMenu.style.left = left + 'px';
    }

    function getCaretPosition() {
        const sel = window.getSelection();
        const range = sel.getRangeAt(0);
        const rect = range.getBoundingClientRect();
        return {
            top: rect.top,
            left: rect.left,
        };
    }
</script>

