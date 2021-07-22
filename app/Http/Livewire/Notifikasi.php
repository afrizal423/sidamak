<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Events\Notifikasi as EventsNotifikasi;
use App\Models\Notifikasi as ModelsNotifikasi;

class Notifikasi extends Component
{
    protected $listeners = ['echo:notifikasiBaru,.Notifikasi' => 'getResponDariSocket'];
    public $beep=false;
    public $textnya, $datanya;
    public $notifAduan;

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
        if (Auth::user()->roles == 1) {
            $cek = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->where('type', '=', 'notifaduan')
                    ->get();
            if ($cek->count() > 0) {
                laratoast()->info('Ada aduan masuk, silahkan menuju halaman <a href="/dashboard/user" rel="noopener noreferrer"> Dashboard</a>',"Aduan Baru","bottom-right",['textAlign'=>'center']);
            }
            $cek = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->where('type', '=', 'notifreminder')
                    ->get();
            if ($cek->count() > 0) {
                laratoast()->info('silahkan ke halaman <a href="/dashboard/user/reminder" rel="noopener noreferrer"> Kalender</a> untuk melihatnya.',"Terdapat agenda pada hari ini","bottom-right",['textAlign'=>'center']);
            }
            $cek = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->where('type', '=', 'notifstatuspending')
                    ->get();
            if ($cek->count() > 0) {
                laratoast()->info('silahkan ke halaman <a href="/dashboard/user/aduan/penanganaduan" rel="noopener noreferrer"> penangan aduan</a> untuk melihatnya.',"Terdapat aduan statusnya pending","bottom-right",['textAlign'=>'center']);
            }


        }
        if (Auth::user()->roles == 0) {
            $cek = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->where('type', '=', 'notifapprov')
                    ->get();
            if ($cek->count() > 0) {
                laratoast()->info('silahkan approv ke halaman <a href="/dashboard/admin/aduan/approvaladuan" rel="noopener noreferrer"> approval</a> untuk mengerjakannya.',"Aduan telah selesai","bottom-right",['textAlign'=>'center']);
            }
            $cek = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->where('type', '=', 'notifreminder')
                    ->get();
            if ($cek->count() > 0) {
                laratoast()->info('silahkan ke halaman <a href="/dashboard/admin/reminder" rel="noopener noreferrer"> Kalender</a> untuk melihatnya.',"Terdapat agenda pada hari ini","bottom-right",['textAlign'=>'center']);
            }
            $cek = ModelsNotifikasi::where('user_id', auth()->user()->id)
                    ->where('is_read', 0)
                    ->where('type', '=', 'notifstatuspending')
                    ->get();
            if ($cek->count() > 0) {
                laratoast()->info('silahkan ke halaman <a href="/dashboard/admin/aduan/manage" rel="noopener noreferrer"> Manage Aduan</a> untuk melihatnya.',"Terdapat aduan statusnya pending","bottom-right",['textAlign'=>'center']);
            }

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

    public function notifAduan(Request $request)
    {
        // Storage::download(Crypt::decryptString($request->query('filenya')));
        // echo $request->query('filenya');
        $id = ModelsNotifikasi::where('text', 'like', '%'.$request->query('url').'%')
        ->first()->id;
        $dt = ModelsNotifikasi::find($id);
        $dt->is_read = true;
        $dt->save();
        // dd(Crypt::decryptString($request->query('filenya')));
        broadcast(new EventsNotifikasi());
        return redirect()->route('dashboard_user');
    }

    public function notifApprov(Request $request)
    {
        // Storage::download(Crypt::decryptString($request->query('filenya')));
        // echo $request->query('filenya');
        $id = ModelsNotifikasi::where('text', 'like', '%'.$request->query('url').'%')
        ->first()->id;
        $dt = ModelsNotifikasi::find($id);
        $dt->is_read = true;
        $dt->save();
        // dd(Crypt::decryptString($request->query('filenya')));
        broadcast(new EventsNotifikasi());
        return redirect()->route('approval_aduan');
    }

    public function notifReminder(Request $request)
    {
        // Storage::download(Crypt::decryptString($request->query('filenya')));
        // echo $request->query('filenya');
        $id = ModelsNotifikasi::where('text', 'like', '%'.$request->query('url').'%')
        ->first()->id;
        $dt = ModelsNotifikasi::find($id);
        $dt->is_read = true;
        $dt->save();
        // dd(Crypt::decryptString($request->query('filenya')));
        broadcast(new EventsNotifikasi());
        if (Auth::user()->roles == 0) {
            return redirect()->route('reminder_index');
        } else {
            return redirect()->route('reminder_index_user');
        }
    }

    public function notifStatusPending(Request $request)
    {
        // Storage::download(Crypt::decryptString($request->query('filenya')));
        // echo $request->query('filenya');
        $id = ModelsNotifikasi::where('text', 'like', '%'.$request->query('url').'%')
        ->first()->id;
        $dt = ModelsNotifikasi::find($id);
        $dt->is_read = true;
        $dt->save();
        // dd(Crypt::decryptString($request->query('filenya')));
        broadcast(new EventsNotifikasi());
        if (Auth::user()->roles == 0) {
            return redirect()->route('manage_aduan');
        } else {
            return redirect()->route('penanganan_aduan_user');
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

    public function exportExcel(Request $request)
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
