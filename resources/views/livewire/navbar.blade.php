<div>
    <div class="f-between">
        <img src="{{asset('svg/desktop.svg')}}" alt="it" class="xs-width">
        <nav class="navbar">
            <a href="#" wire:click.prevent="stock">Stock</a>
            <a href="#" wire:click.prevent="handover">Serah Terima</a>
            <a href="#" wire:click.prevent="loan">Pinjam Aset</a>
            <a href="#" wire:click.prevent="pc">Data PC</a>
            <a href="#" wire:click.prevent="config">Config</a>
        </nav>
        <button
            title="Log Out"
            class="btn-link"
            wire:click="logout"
            wire:confirm="Mau log out ?">
            <img src="{{asset('svg/log-out.svg')}}" alt="logout" class="xs-width">
        </button>
    </div>
</div>