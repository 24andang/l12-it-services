<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\Loan as ModelsLoan;
use Livewire\Attributes\Title;
use Livewire\Component;

class Loan extends Component
{

    #[Title('Pinjam Aset')]

    //input aset
    public $assets;
    public $item, $info;

    //loan
    public $loanedAssets;
    public $asset_id, $loaned_at, $loans, $loan_info, $pic;

    //return
    public $returnAssets;
    public $loan_id, $return_at;

    public function inputAsset()
    {
        Asset::create([
            'item' => $this->item,
            'info' => $this->info,
        ]);

        $this->reset(['item', 'info']);
        session()->flash('done', 'Aset ditambahkan.');
    }

    public function inputLoan()
    {
        ModelsLoan::create([
            'asset_id' => $this->asset_id,
            'loaned_at' => $this->loaned_at,
            'loans' => $this->loans,
            'info' => $this->loan_info,
            'pic' => session('initial')
        ]);

        $this->reset(['loaned_at', 'loans', 'loan_info']);
        session()->flash('done', 'Aset dipinjamkan.');
    }

    public function inputReturn()
    {
        $loan = ModelsLoan::findOrFail($this->loan_id);
        $loan->update([
            'return_at' => $this->return_at
        ]);
        session()->flash('done', 'Aset dikembalikan.');
    }

    public function render()
    {
        $this->assets = Asset::orderBy('item', 'ASC')->get();
        $this->loanedAssets = ModelsLoan::with('asset')->orderBy('loaned_at', 'DESC')->get();
        $this->returnAssets = ModelsLoan::with('asset')
            ->where('return_at', null)
            ->orderBy('loaned_at', 'DESC')
            ->get();
        return view('livewire.loan');
    }
}
