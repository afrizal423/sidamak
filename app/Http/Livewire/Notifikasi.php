<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\Notifikasi as EventsNotifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Notifikasi as ModelsNotifikasi;

class Notifikasi extends Component
{
    protected $listeners = ['echo:notifikasiBaru,.Notifikasi' => 'getResponDariSocket'];
    public $beep=false;
    public $textnya, $datanya;

    public function getResponDariSocket()
    {
        $this->datanya = ModelsNotifikasi::where('user_id', auth()->user()->id)
                        ->limit(7)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $cek_beep = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->get();
        if ($cek_beep->count() > 0) {
            $this->beep = true;
        } else {
            $this->beep = false;
        }
    }

    public function test($dt)
    {
        $textnya = json_decode($dt['text']);
        switch ($dt['type']) {
            case 'exportpdf':

                $id = ModelsNotifikasi::where('text', 'like', '%'.$textnya->lokasi_file.'%')
                ->first()->id;
                $dt = ModelsNotifikasi::find($id);
                $dt->is_read = true;
                $dt->save();
                $this->getResponDariSocket();
                Storage::download(Crypt::decryptString($textnya->lokasi_file));
                // redirect()->route('pdf',['filenya' => $textnya->lokasi_file]);
                break;

            default:
                # code...
                break;
        }
    }

    public function exportPDF(Request $request)
    {
        // Storage::download(Crypt::decryptString($request->query('filenya')));
        // echo $request->query('filenya');
        $id = ModelsNotifikasi::where('text', 'like', '%'.$request->query('filenya').'%')
        ->first()->id;
        $dt = ModelsNotifikasi::find($id);
        $dt->is_read = true;
        $dt->save();
        // dd(Crypt::decryptString($request->query('filenya')));
        broadcast(new EventsNotifikasi());
        return Storage::download(Crypt::decryptString($request->query('filenya')));
    }

    public function render()
    {
        $this->getResponDariSocket();
        return view('livewire.notifikasi');
    }
}
