<div>
    <livewire:navbar />
    <div class="f-layout sm-mt">
        <div class="md-width">
            @if (session('done'))
            <em class="good">{{ session('done') }}</em>
            @endif
            <form wire:submit="inputPcUser" class="card-flex-col sm-mb" id="inputForm">
                <div>
                    <b>Tambah PC User</b>
                </div>
                <div class="f-between">
                    <label for="departement_id">Departemen</label>
                    <select wire:model="departement_id" id="departement_id" class="lg-width">
                        <option>Pilih</option>
                        @foreach ($departements as $dept)
                        <option value="{{$dept->id}}" title="{{$dept->sub}}">{{$dept->code}} : {{$dept->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="f-between">
                    <label for="initial">Inisial</label>
                    <input type="text" wire:model="initial" id="initial" min="3" max="3">
                </div>
                <div class="f-between">
                    <label for="name">Nama</label>
                    <input type="text" wire:model="name" id="name">
                </div>
                <button type="submit">Tambah</button>
            </form>
            <!-- ---------------------------------------------------------------------------------------------------------------------- -->
            <form wire:submit="inputPcData" class="card-flex-col sm-mb" id="inputForm">
                <div>
                    <b>Input Data PC</b>
                </div>
                <div class="f-between">
                    <label for="user_id">Pengguna</label>
                    <select wire:model="user_id" id="user_id" class="lg-width">
                        <option>Pilih</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->initial}} : {{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="f-between">
                    <label for="unit">Unit</label>
                    <input type="text" wire:model="unit" id="unit" placeholder="PC/Laptop, Merk, Type.">
                </div>
                <div class="f-between">
                    <label for="os">OS</label>
                    <input type="text" wire:model="os" id="os" placeholder="Windows/MACOS/Linux">
                </div>
                <div class="f-between">
                    <label for="processor">Proce</label>
                    <input type="text" wire:model="processor" id="processor">
                </div>
                <div class="f-between">
                    <label for="ram">RAM(GB)</label>
                    <input type="number" wire:model="ram" id="ram" class="md-width">
                </div>
                <div class="f-between">
                    <label for="hdd">HDD(GB)</label>
                    <input type="number" wire:model="hdd" id="hdd" class="md-width">
                </div>
                <div class="f-between">
                    <label for="ssd">SSD(GB)</label>
                    <input type="number" wire:model="ssd" id="ssd" class="md-width">
                </div>
                <div class="f-between">
                    <label for="vga">VGA(GB)</label>
                    <input type="number" wire:model="vga" id="vga" class="md-width">
                </div>
                <div class="f-between">
                    <label for="monitor">Screen(Inch)</label>
                    <input type="number" wire:model="monitor" id="monitor" placeholder="Unit PC wajib isi." class="md-width">
                </div>
                <div class="f-between">
                    <label for="ip_lan">IP LAN</label>
                    <input type="text" wire:model="ip_lan" id="ip_lan">
                </div>
                <div class="f-between">
                    <label for="ip_wifi">IP WiFi</label>
                    <input type="text" wire:model="ip_wifi" id="ip_wifi">
                </div>
                <button type="submit">Input</button>
            </form>
        </div>
        <!-- --------------------------------------- -->
        <div style="width: 100%;">
            <div class="sm-mb">
                <button type="button" id="btn-ip" class="sm-mr">IP/SPECS</button>
                <select id="select-dept">
                    <option id="zero-dept">Pilih Departemen</option>
                    @foreach ($departements as $dept)
                    <option value="{{$dept->id}}" title="{{$dept->sub}}">{{$dept->code}} : {{$dept->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-box">
                <!-- ------------------------------------------ -->
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Pengguna</th>
                            <th style="width: 20%;">Unit</th>
                            <th>Spesifikasi</th>
                        </tr>
                    </thead>
                    <tbody id="tbd-spec">
                        @foreach ($pcusers as $item)
                        <tr>
                            <td>
                                <center>{{ $loop->iteration }}</center>
                            </td>
                            <td title="{{$item->pcuser->name}}">{{$item->pcuser->initial}}</td>
                            <td>{{$item->unit}}</td>
                            <td>
                                OS : {{$item->os}}/
                                Proc : {{$item->processor}}/
                                RAM : {{$item->ram}}GB/
                                HDD : {{$item->hdd ? $item->hdd : '0'}}GB/
                                SSD : {{$item->ssd ? $item->ssd : '0'}}GB/
                                VGA : {{$item->vga ? $item->vga : '0'}}GB/
                                Screen : {{$item->monitor ? $item->monitor : '-'}} inch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- ------------------------------------------ -->
                <table style="display: none;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Pengguna</th>
                            <th>IP LAN</th>
                            <th>IP WiFi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <center>{{ $loop->iteration }}</center>
                            </td>
                            <td>{{$user->initial}}</td>
                            <td>{{$user->ip_lan}}</td>
                            <td>{{$user->ip_wifi}}</td>
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
    let pcusers = <?= json_encode($pcusers)  ?>

    $(document).ready(() => {
        $('#select-dept').on('change', () => {
            $('#zero-dept').hide()
            $('#tbd-spec').empty()

            $.each(pcusers, (index, item) => {
                if ($('#select-dept').val() == item.pcuser.departement_id) {
                    $('#tbd-spec').append(`
                            <tr>
                            <td>${index + 1}</td>
                            <td title="${item.pcuser.name}">${item.pcuser.initial}</td>
                            <td>${item.unit}</td>
                            <td>
                                OS : ${item.os}/ 
                                Proc : ${item.processor}/ 
                                RAM : ${item.ram}GB/ 
                                HDD : ${item.hdd ? item.hdd : '0'}GB/ 
                                SSD : ${item.ssd ? item.ssd : '0'}GB/ 
                                VGA : ${item.vga ? item.vga : '0'}GB/ 
                                Screen : ${item.monitor ? item.monitor : '-'} inch
                            </td>
                            </tr>
                        `)
                }
            })
        })
    })

    $('#btn-ip').on('click', () => {
        $('table').toggle()
    })

    $('#user_id').on('change', () => {
        $('#unit, #processor, #os, #ram, #hdd, #ssd, #vga, #monitor, #ip_lan, #ip_wifi').val('');

        const selectedUserId = $('#user_id').val();
        let found = false;

        $.each(pcusers, (index, item) => {
            if (selectedUserId == item.p_c_user_id) {
                $('#unit').val(item.unit);
                $('#processor').val(item.processor);
                $('#os').val(item.os);
                $('#ram').val(item.ram);
                $('#hdd').val(item.hdd);
                $('#ssd').val(item.ssd);
                $('#vga').val(item.vga);
                $('#monitor').val(item.monitor);

                if (item.pcuser) {
                    $('#ip_lan').val(item.pcuser.ip_lan);
                    $('#ip_wifi').val(item.pcuser.ip_wifi);
                }

                found = true;
                return false;
            }
        });
    });
</script>
@endscript