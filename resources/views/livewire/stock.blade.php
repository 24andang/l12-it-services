<div>
    <livewire:navbar />
    <div class="f-layout sm-mt">
        <div class="md-width">
            @if (session('done'))
            <em class="good">{{ session('done') }}</em>
            @endif
            <div class="card-flex-col sm-mb">
                <Input type="text" id="search" placeholder="Cari"></Input>
            </div>
            <form wire:submit="inputItem" class="card-flex-col sm-mb">
                <div>
                    <b>Input Item</b>
                </div>
                <div class="f-between">
                    <label for="code">Kode</label>
                    <input type="text" wire:model="code" id="code">
                </div>
                <div class="f-between">
                    <label for="name">Item</label>
                    <input type="text" wire:model="name" id="name">
                </div>
                <div class="f-between">
                    <label for="info">Keterangan</label>
                    <textarea wire:model="info" id="info"></textarea>
                </div>
                <button type="submit">Input</button>
            </form>
            <!-- --------------------------------------------------------------------------------- -->
            <form wire:submit="inputIncomingItem" class="card-flex-col sm-mb">
                <div>
                    <b>Input Incoming Item</b>
                </div>
                <div class="f-between">
                    <label for="item_id">Item</label>
                    <select wire:model="item_id" id="item_id" class="md-input-width">
                        <option> Pilih </option>
                        @foreach ($items as $item)
                        <option value="{{$item->id}}" title="{{ $item->info }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="f-between">
                    <label for="incoming_date">Tanggal datang</label>
                    <input type="date" wire:model="incoming_date" id="incoming_date" value="2025-01-01" class="md-input-width">
                </div>
                <div class="f-between">
                    <label for="qty">Jumlah</label>
                    <input type="number" wire:model="qty" id="qty" class="sm-input-width" min="1">
                </div>
                <button type="submit">Input</button>
            </form>
            <!-- --------------------------------------------------------------------------------- -->
            <form wire:submit="review" class="card-flex-col sm-mb">
                <div>
                    <b>Incoming Item Reviwew</b>
                </div>
                <div class="f-between">
                    <label for="revcode" class="sm-mr">Kode</label>
                    <div>
                        <input type="text" wire:model="revcode" id="revcode" placeholder="Kode" class="sm-mr md-width">
                        <input type="nummber" wire:model="year" placeholder="th: YYYY" minlength="4" maxlength="4" class="md-width">
                    </div>
                </div>
                <button type="submit">Review</button>
            </form>
            <!-- --------------------------------------------------------------------------------- -->
            @if (!empty($revs))
            <div class="card-box-sm">
                <b>{{$revs['code']}} : {{$revs['name']}}</b>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td>Tgl</td>
                            <td>Qty</td>
                            <td>PIC</td>
                            <td>Del</td>
                        </tr>
                    </thead>
                    @foreach ($revs['dates'] as $date)
                    <tr>
                        <td>{{$date->incoming_date}}</td>
                        <td>{{$date->qty}}</td>
                        <td>{{$date->pic}}</td>
                        <td>
                            <button
                                class="btn-link bad"
                                wire::click="delete({{$revs['code'], $date->id, $date->qty}})"
                                wire::confirm="Hapus ?">
                                <img src="{{asset('svg/trash.svg')}}" alt="delete" class="sm-icon">
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endif

        </div>

        <div class="card-box">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%;">Kode</th>
                        <th>Item</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <center>{{ $loop->iteration }}</center>
                        </td>
                        <td>
                            <button class="btn-link">{{ $item->code }}</button>
                        </td>
                        <td title="{{ $item->info }}">{{ $item->name }}</td>
                        <td>
                            <center>{{ $item->stock }}</center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@script
<script>
    $(document).ready(() => {
        $('#search').on('keyup', function() {
            const value = $(this).val().toLowerCase()
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            })
        })
    })
</script>
@endscript