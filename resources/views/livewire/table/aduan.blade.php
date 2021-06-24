<div>
    {{-- Be like water. --}}
    <x-data-table-custom :model="$aduans">
        <x-slot name="inputdata">
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_pelapor')" role="button" href="#">
                    Nama Pelapor
                    @include('components.sort-icon', ['field' => 'nama_pelapor'])
                </a></th>
                {{-- <th><a wire:click.prevent="sortBy('tempat_acara')" role="button" href="#">
                    Nama PIC
                    @include('components.sort-icon', ['field' => 'tempat_acara'])
                </a></th> --}}
                <th>Nama PIC</th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                    Status
                    @include('components.sort-icon', ['field' => 'status'])
                </a></th>
                <th><a wire:click.prevent="sortBy('tgl_dibuat')" role="button" href="#">
                    Waktu Dibuat
                    @include('components.sort-icon', ['field' => 'tgl_dibuat'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($aduans as $aduan)
                <tr x-data="window.__controller.dataTableController({{ $aduan->id }})">
                    <td>{{ $aduan->id }}</td>
                    <td>{{ $aduan->nama_pelapor }}</td>
                    <td>
                        <ul>
                            @foreach ( $aduan->pic as $picnya)
                            <li style="list-style-type: circle;">{{ $picnya->nama_pegawai }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $aduan->status == 0 ? "Belum Dikerjakan" : ($aduan->status == 3 ? "Pending" : "Sudah Dikerjakan") }}</td>
                    <td>{{ Carbon\Carbon::parse($aduan->tgl_dibuat)->isoFormat('LLLL') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="lihat({{ $aduan->id }})" class="mr-3"><i class="fa fa-16px fa-info"></i></a>
                        <a href="{{ route('ubah_aduan', $aduan->id) }}" role="button" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 136, 0);"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table-custom>
</div>
