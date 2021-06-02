<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-data-table-custom-2 :model="$pegawais">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    No.
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_pegawai')" role="button" href="#">
                    Nama Pegawai
                    @include('components.sort-icon', ['field' => 'nama_pegawai'])
                </a></th>
                <th><a wire:click.prevent="sortBy('no_hp')" role="button" href="#">
                    No HP Pegawai
                    @include('components.sort-icon', ['field' => 'no_hp'])
                </a></th>
                <th><a wire:click.prevent="sortBy('alamat_pegawai')" role="button" href="#">
                    Alamat Pegawai
                    @include('components.sort-icon', ['field' => 'alamat_pegawai'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @php
                $no = 1;
            @endphp

            @foreach ($pegawais as $pegawai)
                <tr x-data="window.__controller.dataTableController({{ $pegawai->id }})">
                    <td>{{ $no }}</td>
                    <td>{{ $pegawai->nama_pegawai }}</td>
                    <td>{{ $pegawai->no_hp }}</td>
                    <td>{{ $pegawai->alamat_pegawai }}</td>
                    <td>{{ $pegawai->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="lihat({{ $pegawai->id }})" class="mr-3"><i class="fa fa-16px fa-info"></i></a>
                        <a href="{{ route('ubah_pegawai', $pegawai->id) }}" role="button" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 136, 0);"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </x-slot>
    </x-data-table-custom-2>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lihat Data dengan Nama {{ Str::limit($nama_pegawai, 10) }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Nama : {{ $nama_pegawai }} <br>
                No HP : {{ $no_hp }} <br>
                Alamat : {{ $alamat_pegawai }} <br>
                Divisi : {{ $divisi }} <br>
                Unit Kerja : {{ $unit_kerja }} <br>
                Jenis User : {{ $jenis_user }} <br>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>
</div>


