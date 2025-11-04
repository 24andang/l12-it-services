<div>
    <livewire:navbar />
    @if (session('info'))
    <em class="good">
        {{ session('info') }}
    </em>
    @endif

    <div class="f-layout sm-mt">
        <div class="md-width">
            <form wire:submit="handover" class="card-flex-col sm-mb">
                <h3>Serah terima</h3>
                <div class="f-between">
                    <label for="item_id">Item</label>
                    <select wire:model="item_id" id="item_id" class="md-input-width">
                        <option>Pilih</option>
                        @foreach ($items as $item)
                        <option value="{{$item->id}}" title="Stock : {{$item->stock}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="f-between">
                    <label for="qty">Jumlah</label>
                    <input type="number" wire:model="qty" id="qty" class="sm-input-width" min="1">
                </div>
                <div class="f-between">
                    <label for="recipient">Penerima</label>
                    <input type="text" wire:model="recipient" id="recipient" class="md-input-width">
                </div>
                <div class="f-between">
                    <label for="outcoming_date">Tanggal Diserahkan</label>
                    <input type="date" wire:model="outcoming_date" id="outcoming_date" class="md-input-width">
                </div>
                <div class="f-between">
                    <label for="info">Keterangan/Spek</label>
                    <textarea wire:model="info" id="info" class="md-input-width"></textarea>
                </div>
                <div class="f-between">
                    <div>
                        <input type="radio" wire:model="status" id="handover" value="handover">
                        <label for="handover">Serah Terima</label>
                    </div>
                    <div>
                        <input type="radio" wire:model="status" id="loan" value="loan">
                        <label for="loan">Pinjam</label>
                    </div>
                </div>
                <div>
                    <input type="checkbox" wire:model="pdf" id="pdf" class="sm-mr">
                    <label for="pdf">Cetak Pdf</label>
                </div>
                <button type="submit">Simpan</button>
            </form>
            <!-- ------------------------------------------------------------------ -->
            <form wire:submit="history" class="card-flex-col">
                <h3>History</h3>
                <div class="f-between">
                    <label for="code">Kode</label>
                    <input type="text" wire:model="code" id="code" placeholder="Input kode item.">
                </div>
                <div class="f-between">
                    <label for="start_date">Dari</label>
                    <input type="date" wire:model="start_date" id="start_date">
                </div>
                <div class="f-between">
                    <label for="end_date">Sampai</label>
                    <input type="date" wire:model="end_date" id="end_date">
                </div>
                <button type="submit">Show</button>
            </form>
        </div>
        <!-- ------------------------------------------------------------------ -->
        @if(!empty($histories))
        <div class="card-box">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%;">Kode</th>
                        <th>Item</th>
                        <th>Tanggal</th>
                        <th>Penerima</th>
                        <th>Status</th>
                        <th>PIC</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                    <tr>
                        <td>
                            <center>{{ $loop->iteration }}</center>
                        </td>
                        <td> {{ $history->item->code }} </td>
                        <td>{{ $history->item->name }}</td>
                        <td>{{ date('d/m/Y', strtotime($history->outcoming_date)) }}</td>
                        <td>{{ $history->recipient }}</td>
                        <td>{{ $history->status == 'loan' ? 'Pinjam' : 'Serah Terima' }}</td>
                        <td>{{ $history->pic }}</td>
                        <td>{{ $history->info }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>