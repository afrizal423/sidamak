<div>
    {{-- Do your work, then step back. --}}
    <x-data-table-custom :model="$divisis">
        <x-slot name="inputdata">
            <div style="padding: 20px">
                @if(session()->has('success'))
                <script>
                Swal.fire(
                        'Berhasil!',
                        'Data telah tersimpan di database.',
                        'success'
                    );
                </script>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                      <a href="" class="-ml- btn btn-primary shadow-none" wire:click.prevent="tambah()">
                        <span class="fas fa-plus"></span> Tambah Data
                    </a>
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_divisi')" role="button" href="#">
                    Nama Divisi
                    @include('components.sort-icon', ['field' => 'nama_divisi'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($divisis as $divisi)
                <tr x-data="window.__controller.dataTableController({{ $divisi->id }})">
                    <td>{{ $divisi->id }}</td>
                    <td>{{ $divisi->nama_divisi }}</td>
                    <td>{{ $divisi->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="edit({{ $divisi->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">@if ($jikaUpdate)Ubah @else Tambah @endif Data Divisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Divisi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name Division" wire:model="nama_divisi" required>
                            @error('nama_divisi') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
                    @if ($jikaUpdate)
                        <button type="button" class="btn btn-primary" wire:click.prevent="update()">Ubah Data</button> <br>
                        @else
                        <button class="btn btn-primary text-right" wire:click.prevent="store()">Simpan Data</button>

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
