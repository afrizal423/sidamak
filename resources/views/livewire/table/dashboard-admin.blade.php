<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-data-table-custom-2 :model="$pegawais">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('nama_pegawai')" role="button" href="#">
                    Nama Pegawai
                    @include('components.sort-icon', ['field' => 'nama_pegawai'])
                </a></th>
                <th><a wire:click.prevent="sortBy('progress')" role="button" href="#">
                    Progress
                    @include('components.sort-icon', ['field' => 'progress'])
                </a></th>
                <th><a wire:click.prevent="sortBy('pending')" role="button" href="#">
                    Pending
                    @include('components.sort-icon', ['field' => 'pending'])
                </a></th>
                <th><a wire:click.prevent="sortBy('selesai')" role="button" href="#">
                    Selesai
                    @include('components.sort-icon', ['field' => 'selesai'])
                </a></th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @php
                $no = 1;
            @endphp

            @foreach ($pegawais as $pegawai)
                <tr x-data="window.__controller.dataTableController({{ $pegawai->id }})">
                    <td>{{ $pegawai->nama_pegawai }}</td>
                    <td>{{ $pegawai->progress }}</td>
                    <td>{{ $pegawai->pending }}</td>
                    <td>{{ $pegawai->selesai }}</td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </x-slot>
    </x-data-table-custom-2>
</div>
