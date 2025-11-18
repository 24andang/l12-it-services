<div>
    <livewire:navbar />
    <div class="f-layout sm-mt">
        <div class="md-width">
            <div class="f-between sm-mb">
                <button type="button" id="btn-show">Pinjam/Aset</button>
                @if (session('done'))
                <em class="good">{{ session('done') }}</em>
                @endif
            </div>
            <form wire:submit="inputAsset" class="card-flex-col sm-mb" id="form-asset">
                <div>
                    <b>Input Aset</b>
                </div>
                <div class="f-between">
                    <label for="item">Item</label>
                    <input type="text" wire:model="item" id="item">
                </div>
                <div class="f-between">
                    <label for="info">Keterangan</label>
                    <textarea wire:model="info" id="info"></textarea>
                </div>
                <button type="submit">Input</button>
            </form>
            <!-- -------------------------------------------------------------------------------------------- -->
            <form wire:submit="inputLoan" class="card-flex-col sm-mb" id="form-loan">
                <div>
                    <b>Pinjam Aset</b>
                </div>
                <div class="f-between">
                    <label for="asset_id">Item</label>
                    <select wire:model="asset_id" id="asset_id" class="md-input-width">
                        <option> Pilih </option>
                        @foreach ($assets as $item)
                        <option value="{{$item->id}}" title="{{ $item->info }}">{{ $item->item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="f-between">
                    <label for="loaned_at">Dipinjam tgl</label>
                    <input type="date" wire:model="loaned_at" id="loaned_at" class="md-input-width">
                </div>
                <div class="f-between">
                    <label for="loans">Peminjam</label>
                    <input type="text" wire:model="loans" id="loans">
                </div>
                <div class="f-between">
                    <label for="loan_info">Keterangan</label>
                    <textarea wire:model="loan_info" id="loan_info"></textarea>
                </div>
                <button type="submit">Pinjamkan</button>
            </form>
            <!-- -------------------------------------------------------------------------------------------- -->
            <form wire:submit="inputReturn" class="card-flex-col sm-mb" id="form-return">
                <div>
                    <b>Kembalikan Aset</b>
                </div>
                <div class="f-between">
                    <label for="loan_id">Item</label>
                    <select wire:model="loan_id" id="loan_id" class="md-input-width">
                        <option> Pilih </option>
                        @foreach ($returnAssets as $item)
                        <option value="{{$item->id}}">{{ $item->asset->item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="f-between">
                    <label for="return_at">Dikembalikan tgl</label>
                    <input type="date" wire:model="return_at" id="return_at" class="md-input-width">
                </div>
                <button type="submit">Kembalikan</button>
            </form>
        </div>
        <!-- -------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------- -->
        <div class="card-box">
            <table id="table-asset">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Item</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assets as $item)
                    <tr>
                        <td>
                            <center>{{ $loop->iteration }}</center>
                        </td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->info }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- -------------------------------------------------------------------------------------------- -->
            <div id="table-loan">
                <div class="sm-mb">
                    <Input type="checkbox" id="show-loaned">
                    <label for="show-loaned"><em>Belum dikembalikan</em></label>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Item</th>
                            <th>Dipinjam tgl</th>
                            <th>Peminjam</th>
                            <th>Keterangan</th>
                            <th>Dikembalikan tgl</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loanedAssets as $item)
                        <tr>
                            <td>
                                <center>{{ $loop->iteration }}</center>
                            </td>
                            <td>{{ $item->asset->item }} {{ $item->asset->info }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->loaned_at)) }}</td>
                            <td>{{ $item->loans }}</td>
                            <td>{{ $item->info }}</td>
                            <td class="td-status">{{ $item->return_at ? date('d/m/Y', strtotime($item->return_at)) : 'Belum dikembalikan' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(async () => {

        $('.good').fadeOut('slow')

        $('#table-asset').hide()
        $(document).on('click', '#btn-show', () => {
            $('#table-asset').fadeToggle()
            $('#table-loan').fadeToggle()
        })

        $(document).on('submit', '#form-loan, #form-return', () => {
            $('#table-asset').hide()
        })
        $(document).on('submit', '#form-asset', () => {
            $('#table-loan').hide()
        })

        $(document).on('change', '#show-loaned', function() {
            const isChecked = $(this).is(':checked');

            $('#table-loan tbody tr').each(function() {
                const statusText = $(this).find('.td-status').text().trim();

                const isUnreturned = statusText === 'Belum dikembalikan';

                if (isChecked) {
                    if (isUnreturned) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else {
                    $(this).show();
                }
            });
        });
    })
</script>
@endscript