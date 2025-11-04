<div>
    <livewire:navbar />
    <form wire:submit.prevent="updatePassword" class="card-flex-col md-width sm-mt">
        <div class="f-col box-16">
            <div class="f-between">
                <span>{{ $initial }}</span>
                @if (session('done'))
                <em class="good">{{ session('done') }}</em>
                @endif
            </div>
            <div class="f-between">
                <label for="newPassword">Password baru</label>
                <input type="password" wire:model="newPassword" id="newPassword">
            </div>
            <button>Ganti</button>
        </div>
    </form>
</div>