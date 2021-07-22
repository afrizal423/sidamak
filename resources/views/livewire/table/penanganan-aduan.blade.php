<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-data-table-custom-2 :model="$aduans">

        <x-slot name="head">
            <tr>
                <th>Nama Pelapor</th>
                {{-- <th><a wire:click.prevent="sortBy('tempat_acara')" role="button" href="#">
                    Nama PIC
                    @include('components.sort-icon', ['field' => 'tempat_acara'])
                </a></th> --}}
                <th>Nama PIC</th>
                <th>Status</th>
                <th>Solusi Terisi</th>
                <th>Waktu Dibuat</th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @if(session()->has('success'))
                <script>
                Swal.fire(
                        'Berhasil!',
                        'Data telah tersimpan di database.',
                        'success'
                    );
                </script>
                @endif
            @foreach ($aduans as $aduan)
                <tr x-data="window.__controller.dataTableController({{ $aduan->id }})" style="color: {{$aduan->status == 3 ? "rgb(255, 0, 119)" : ""}}">
                    <td>{{ $aduan->nama_pelapor }}</td>
                    <td>
                        <ul>
                            @foreach ( $aduan->pic as $picnya)
                            <li style="list-style-type: circle;">{{ $picnya->nama_pegawai }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $aduan->status == 2 ? "Sedang Berjalan / Progress" : ($aduan->status == 3 ? "Pending" : "") }}</td>
                    <td>{!! $aduan->is_done_solusi == 1 ? "<i class='fas fa-check-circle' style='color:green;'>" : "<i class='fas fa-times-circle' style='color:red;'>" !!}</td>
                    <td>{{ Carbon\Carbon::parse($aduan->created_at)->isoFormat('LLLL') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="lihat({{ $aduan->id }})" class="mr-3"><i class="fa fa-16px fa-info"></i></a>
                        <a role="button" wire:click.prevent="solusi({{ $aduan->id }})" class="mr-3"><i class="fa fa-16px fa-pen text-yellow-400"></i></a>
                        <a role="button" href="{{ route('ubah_aduan', $aduan->id) }}" class="mr-3"><i class="fa fa-16px fa-cog text-gray-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table-custom-2>
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
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Status</td>
                        <td style="width: 63.1117%; height: 18px;">: {{ $status == 2 ? "Sedang Berjalan / Progress" : ($status == 3 ? "Pending" : "") }}</td>
                        </tr>
                        <tr style="height: 18px;">
                        <td style="width: 36.8883%; height: 18px;">Aduan</td>
                        <td style="width: 63.1117%; height: 18px;">: {{$keterangan}}</td>
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
    {{-- end Modal  --}}
    <!-- Modal solusi-->
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="solusiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Solusi Aduan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-7 card" style="padding: 12px">
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
                            <tr style="height: 18px;">
                            <td style="width: 36.8883%; height: 18px;">Status</td>
                            <td style="width: 63.1117%; height: 18px;">: {{ $status == 2 ? "Sedang Berjalan / Progress" : ($status == 3 ? "Pending" : "") }}</td>
                            </tr>
                            <tr style="height: 18px;">
                            <td style="width: 36.8883%; height: 18px;">Aduan</td>
                            <td style="width: 63.1117%; height: 18px;">: {{$keterangan}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-5 col-5 card" style="padding: 12px">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Solusi</label>
                            <textarea style="min-height: 100%" class="form-control" id="exampleFormControlTextarea1" rows="10"  wire:model="solusi"></textarea>
                            @error('solusi') <span class="text-danger error">{{ $message }}</span>@enderror
                            <small id="exampleFormControlTextarea1" class="form-text text-muted">Minimal 5 karakter.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary close-modal" data-dismiss="modal">Tutup</button>
            <button class="btn btn-success text-right" wire:click.prevent="simpanSolusi()">Simpan Solusi</button>
            </div>
        </div>
        </div>
    </div>
    {{-- end modal --}}
</div>
