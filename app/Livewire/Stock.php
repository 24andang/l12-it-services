<?php

namespace App\Livewire;

use App\Models\IncomingItem;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Stock extends Component
{
    #[Title('Stock IT')]

    // Items
    public $items;

    public $code, $name, $info;

    // Kedatangan Barang
    public $item_id, $incoming_date, $qty, $pic;

    //review
    public $revs = [], $revcode, $year;

    public function inputItem()
    {
        Item::create([
            'code' => $this->code,
            'name' => $this->name,
            'info' => $this->info,
            'stock' => 0
        ]);

        session()->flash('done', 'Input Ok.');

        $this->reset(['code', 'name', 'info']);
    }

    public function render()
    {
        $this->items = Item::orderBy('name', 'ASC')->get();
        return view('livewire.stock');
    }

    public function inputIncomingItem()
    {
        IncomingItem::create([
            'item_id' => $this->item_id,
            'incoming_date' => $this->incoming_date,
            'qty' => $this->qty,
            'pic' => session('initial')
        ]);

        $curStock = DB::table('items')
            ->where('id', $this->item_id)
            ->value('stock');
        Item::where('id', $this->item_id)->update([
            'stock' => $curStock += $this->qty
        ]);

        session()->flash('done', 'Input Incoming Ok.');

        $this->reset(['qty']);
    }

    public function review()
    {
        $item = Item::where('code', $this->revcode)->first();
        $incoming = IncomingItem::where('item_id', $item->id)
            ->whereYear('incoming_date', $this->year)
            ->orderBy('created_at', 'DESC')
            ->get();
        $this->revs = [
            'code' => $item->code,
            'name' => $item->name,
            'dates' => $incoming
        ];
    }

    public function delete($code, $id, $qty)
    {
        $curStock = Item::where('code', $code)->value('stock');
        Item::where('code', $code)->update([
            'stock' => $curStock -= $qty
        ]);
        IncomingItem::where('id', $id)->delete();

        session()->flash('done', 'Stock dikembalikan.');
    }
}
