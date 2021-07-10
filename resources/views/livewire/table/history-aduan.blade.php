<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-data-table-custom :model="$progressnya">
        <x-slot name="inputdata">
            <div style="padding: 20px">
                <small>Silahkan Pilih Tanggal untuk menampilkan data.</small>
                <table>
                    <tbody>
                    <tr>
                    <td>Mulai Tanggal&nbsp;: </td>
                    <td><input
                        type="date"
                        wire:model="mulaiTanggal"
                        class="border rounded p-2 block w-full sm:text-sm sm:leading-5"
                        placeholder="Kapan reminder berlangsung?"
                    /></td>
                    </tr>
                    <tr>
                    <td>Sampai Tanggal&nbsp;: </td>
                    <td><input
                        type="date"
                        wire:model="sampaiTanggal"
                        class="border rounded p-2 block w-full sm:text-sm sm:leading-5"
                        placeholder="Kapan reminder berlangsung?"
                    /></td>
                    </tr>
                    <tr>
                    <td>Export File&nbsp;: </td>
                    <td>
                        <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Pilih Ekstensi File
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item has-icon" wire:click="exportPDF"><i class="fas fa-file-pdf" style="color: red"></i> PDF File</a>
                              <a class="dropdown-item has-icon" wire:click="exportExcel"><i class="fas fa-file-excel" style="color: green"></i> Excel File</a>
                            </div>
                          </div>
                    </td>
                    </tr>
                    </tbody>
                    </table>
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th>Nama Pelapor</th>
                {{-- <th><a wire:click.prevent="sortBy('tempat_acara')" role="button" href="#">
                    Nama PIC
                    @include('components.sort-icon', ['field' => 'tempat_acara'])
                </a></th> --}}
                <th>Nama PIC</th>
                <th>Status</th>
                <th>Aduan Masuk</th>
                <th>Aduan Terselesaikan</th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @if(session()->has('waiting'))
            <script>
            Swal.fire(
                    'Berhasil request export PDF!',
                    'Anda harus menunggu hingga proses selesai. <br> Jika proses telah selesai lihat pada notifikasi untuk mendownload file.',
                    'info'
                );
            </script>
            @endif
            @foreach ($progressnya as $aduan)
                <tr x-data="window.__controller.dataTableController({{ $aduan->id }})" style="color: {{$aduan->status == 3 ? "rgb(255, 0, 119)" : ""}}">
                    <td>{{ $aduan->nama_pelapor }}</td>
                    <td>
                        <ul>
                            @foreach ( $aduan->pic as $picnya)
                            <li style="list-style-type: circle;">{{ $picnya->nama_pegawai }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{!! $aduan->status == 2 ? "Sedang Berjalan / Progress" : ($aduan->status == 3 ? "Pending" : "<i class='fas fa-check-circle' style='color:green;'>") !!}</td>
                    <td>{{ Carbon\Carbon::parse($aduan->tgl_dibuat)->isoFormat('LLLL') }}</td>
                    <td>{{ Carbon\Carbon::parse($aduan->tgl_selesai)->isoFormat('LLLL') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="lihat({{ $aduan->id }})" class="mr-3"><i class="fa fa-16px fa-info"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table-custom>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lihat Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <table style="border-collapse: collapse; width: 100%; height: 126px;" border="1">
                        <tbody>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Divisi</td>
                        <td style="width: 63.1117%; height: 18px;">: {{$divisi}}</td>
                        </tr>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Nama Penerima Aduan</td>
                        <td style="width: 63.1117%; height: 18px;">: {{$nama_penerima}}</td>
                        </tr>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Nama Pelapor</td>
                        <td style="width: 63.1117%; height: 18px;">: {{$nama_pelapor}}</td>
                        </tr>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Nama PIC</td>
                        <td style="width: 63.1117%; height: 18px;">@foreach ( $pic as $picnya) <li style="list-style-type: circle;">{{ $picnya->nama_pegawai }}</li>
                            @endforeach

                        </td>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Terlapor pada</td>
                        <td style="width: 63.1117%; height: 18px;">: {{Carbon\Carbon::parse($dibuat_pada)->isoFormat('LLLL')}}</td>
                        </tr>
                        </tr>
                        {{-- <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Status</td>
                        <td style="width: 63.1117%; height: 18px;">: {{ $status == 2 ? "Sedang Berjalan / Progress" : ($status == 3 ? "Pending" : "") }}</td>
                        </tr> --}}
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Aduan</td>
                        <td style="width: 63.1117%; height: 18px;">: {{$keterangan}}</td>
                        </tr>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Solusi</td>
                        <td style="width: 63.1117%; height: 18px;">: {{$solusi}}</td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>
</div>
