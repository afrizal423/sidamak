<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-data-table-custom :model="$reminders">
        <x-slot name="inputdata">
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_kegiatan')" role="button" href="#">
                    Nama Kegiatan
                    @include('components.sort-icon', ['field' => 'nama_kegiatan'])
                </a></th>
                <th><a wire:click.prevent="sortBy('tempat_acara')" role="button" href="#">
                    Tempat Kegiatan
                    @include('components.sort-icon', ['field' => 'tempat_acara'])
                </a></th>
                <th><a wire:click.prevent="sortBy('waktu_kegiatan')" role="button" href="#">
                    Waktu Kegiatan
                    @include('components.sort-icon', ['field' => 'waktu_kegiatan'])
                </a></th>
                <th><a wire:click.prevent="sortBy('days')" role="button" href="#">
                    Status
                    @include('components.sort-icon', ['field' => 'days'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($reminders as $reminder)
                <tr x-data="window.__controller.dataTableController({{ $reminder->id }})">
                    <td>{{ $reminder->id }}</td>
                    <td>{{ $reminder->nama_kegiatan }}</td>
                    <td>{{ $reminder->tempat_acara }}</td>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $reminder->tgl_kegiatan." ".$reminder->waktu_kegiatan.":00", 'Asia/Jakarta') }} WIB</td>
                    <td>{{ $reminder->days == 0 ? "Hari ini" : ($reminder->days >= 0 ? "Kurang ".$reminder->days." Hari Lagi" : "Telah Berlalu") }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="edit({{ $reminder->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table-custom>
</div>
