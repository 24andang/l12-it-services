<?php

namespace App\Livewire;

use App\Models\Handover as ModelsHandover;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Handover extends Component
{
    #[Title('Serah Terima')]
    public $items;

    public $item_id, $qty, $recipient, $outcoming_date, $info, $status, $pdf;

    //history
    public $code, $start_date, $end_date, $histories = [];

    public function exportPdf($id)
    {
        $item = ModelsHandover::with('item')->findOrFail($id);

        $data = [
            'id' => $item->id,
            'code' => $item->item->code,
            'name' => $item->item->name,
            'qty' => $item->qty,
            'recipient' => $item->recipient,
            'outcoming_date' => $item->outcoming_date,
            'info' => $item->info,
            'pic' => $item->pic
        ];

        $pdf = Pdf::loadView('pdf.serah_terima', $data);

        return $pdf->stream('serah_terima.pdf');
    }

    public function handover()
    {
        $curStock = DB::table('items')->where('id', $this->item_id)->value('stock');

        if ($this->qty > $curStock) {
            session()->flash('info', 'Gagal input, melebihi stock tersedia.');
            return;
        }

        $handover = ModelsHandover::create([
            'item_id' => $this->item_id,
            'qty' => $this->qty,
            'recipient' => $this->recipient,
            'outcoming_date' => $this->outcoming_date,
            'info' => $this->info,
            'status' => $this->status,
            'pic' => session('initial')
        ]);

        if ($this->status == 'handover') {
            Item::where('id', $this->item_id)->update([
                'stock' => $curStock -= $this->qty
            ]);
        }

        session()->flash('info', 'Serah terima telah tercatat.');

        $this->reset(['qty', 'recipient', 'info']);

        if ($this->pdf) {
            return redirect()->route('handover.pdf', ['id' => $handover->id]);
        }
    }

    public function history()
    {
        $item = Item::where('code', $this->code)->first();
        if ($item && $this->start_date && $this->end_date && $this->histories) {
            $histories = ModelsHandover::where('item_id', $item->id)
                ->where('outcoming_date', '>', $this->start_date)
                ->where('outcoming_date', '<', $this->end_date)
                ->with('item')
                ->get();
            $this->histories = $histories;
        } else {
            session()->flash('info', 'Data tidak valid.');
        }
    }

    public function render()
    {
        $this->items = Item::where('stock', '>', 0)->get();
        return view('livewire.handover');
    }
}
