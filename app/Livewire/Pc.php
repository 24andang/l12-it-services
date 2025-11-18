<?php

namespace App\Livewire;

use App\Models\Departement;
use App\Models\PC as ModelsPC;
use App\Models\PCUser;
use Livewire\Component;

class Pc extends Component
{
    public $users = [];

    //input data pc
    public $user_id, $unit, $os, $processor, $ram, $hdd, $ssd, $vga, $monitor, $ip_lan, $ip_wifi;

    // user pc
    public $pcusers = [];
    public $departement_id,  $initial, $name;

    //departement
    public $departements = [];

    public function inputPcData()
    {
        $modelPC = ModelsPC::where('p_c_user_id', $this->user_id)->first();

        if ($modelPC) {
            $modelPC->update([
                'p_c_user_id' => $this->user_id,
                'unit' => $this->unit,
                'os' => $this->os,
                'processor' => $this->processor,
                'ram' => $this->ram,
                'hdd' => $this->hdd,
                'ssd' => $this->ssd,
                'vga' => $this->vga,
                'monitor' => $this->monitor,
            ]);
        } else {
            ModelsPC::create([
                'p_c_user_id' => $this->user_id,
                'unit' => $this->unit,
                'os' => $this->os,
                'processor' => $this->processor,
                'ram' => $this->ram,
                'hdd' => $this->hdd,
                'ssd' => $this->ssd,
                'vga' => $this->vga,
                'monitor' => $this->monitor,
            ]);
        }


        PCUser::where('id', $this->user_id)
            ->update([
                'has_pc' => 'yes',
                'ip_lan' => $this->ip_lan,
                'ip_wifi' => $this->ip_wifi,
            ]);

        $this->reset([
            'os',
            'unit',
            'processor',
            'ram',
            'hdd',
            'ssd',
            'vga',
            'monitor'
        ]);

        session()->flash('done', 'Data pc tersimpan.');
    }

    public function inputPcUser()
    {
        PCUser::create([
            'departement_id' => $this->departement_id,
            'initial' => $this->initial,
            'name' => $this->name,
        ]);

        session()->flash('done', 'User ' . $this->initial . ' pc ditambahkan.');
    }

    public function render()
    {
        $this->users = PCUser::with('departement')
            ->orderBy('initial', 'ASC')
            ->get();

        $this->pcusers = ModelsPC::with('pcuser')->get();

        $this->departements = Departement::orderBy('code', 'ASC')->get();

        // dd($this->pcusers);

        return view('livewire.pc');
    }
}
