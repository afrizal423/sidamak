<?php

namespace App\Exports;

use App\Models\Keluhan;
use App\Models\JenisUsers;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class LaporanAduanExport implements FromCollection, ShouldAutoSize, WithEvents
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
        // $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $header = [
            'tgl_dibuat' => 'Tanggal',
            'nama_divisi' => 'Divisi',
            'nama_pelapor' => 'Nama Pelapor',
            'keterangan' => 'Permasalahan',
            'nama_pegawai' => 'PIC',
            'solusi' => 'Solusi',
            'status' => 'Status'
        ];
        $pegawai = Keluhan::where('status', '=' , 1)
                    ->where('is_done_solusi', '=' , 1)
                    ->where('is_approv', '=' , 1)
                    ->whereBetween('tgl_dibuat', [$this->data->mulaiTanggal, $this->data->sampaiTanggal])
                    // ->orWhereBetween('tgl_dibuat', [$request->query('mulaiTanggal'), $request->query('sampaiTanggal')])
                    ->orderBy('id')->get();
        $list=[];

        foreach ($pegawai as $key => $aduan) {
            $list[0] = $header;
            $pic='';
            $last=count($aduan->pic);
            $no=0;
            foreach ($aduan->pic as $key => $picnya) {
                # code...
                if ($no == 0) {
                    $pic.=sprintf("%s, ",$picnya->nama_pegawai);
                } elseif ($last == $no+1) {
                    $pic.=sprintf("%s ",$picnya->nama_pegawai);
                } else {
                    $pic.=sprintf("%s, ",$picnya->nama_pegawai);
                }
                $no++;
                // $pic[] = $picnya->nama_pegawai;
            }
            $list[]= [
                'tgl_dibuat' => $aduan->tgl_dibuat,
                'nama_divisi' => $aduan->divisi->nama_divisi,
                'nama_pelapor' => $aduan->nama_pelapor,
                'keterangan' => $aduan->keterangan,
                'nama_pegawai' => $pic,
                'solusi' => $aduan->solusi,
                'status' => $aduan->is_approv == 1 ? 'Selesai' : 'Belum'
            ];
        }
        // dd($list);
        return collect($list);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
