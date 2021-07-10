<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-data-table-custom :model="$aduans">
        <x-slot name="inputdata">
            <div style="padding: 20px">

                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <button class="-ml- btn btn-primary shadow-none" wire:click.prevent="approv()" @if (count($selectedtypes) == 0)
                    disabled
                @endif >
                    <span class="fas fa-check"></span>  Approv Data Aduan
                </button>
                      {{-- <a href="" class="-ml- btn btn-primary shadow-none" wire:click.prevent="tambah()" disable>
                        <span class="fas fa-plus"></span> Approv Data Aduan
                    </a> --}}
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><input type="checkbox" wire:model="selectAll"  class="form-checkbox h-5 w-5 text-blue-700">
                </th>
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
                    <td>
                        <input type="checkbox" value="{{ $aduan->id }}" wire:model="selectedtypes"  class="form-checkbox h-4 w-4 text-blue-500">
                    </td>
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
                        <a role="button" href="{{ route('ubah_aduan', $aduan->id) }}" class="mr-3"><i class="fa fa-16px fa-cog text-gray-500"></i></a>
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
    {{-- end modal --}}
</div>
