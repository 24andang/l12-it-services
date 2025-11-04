<div>
    <div class="full-screen">
        <h3>DFA IT Services</h3>
        <form wire:submit.prevent="login" class="card-flex-col sm-width">
            <div class="f-between">
                <label for="user">Id</label>
                <input type="text" wire:model="user" id="user" autofocus>
            </div>
            <div class="f-between">
                <label for="password">Key</label>
                <input type="password" wire:model="password" id="password">
            </div>
            <div>
                <button class="sm-mr">Login</button>
                @error('auth') <em class="bad">{{ $message }}</em> @enderror
            </div>
        </form>
    </div>
</div>