<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-data-table-custom :model="$unit_kerjas">
        <x-slot name="inputdata">
            <div style="padding: 20px">
                {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><span class="fas fa-plus"></span> Tambah data</button> --}}
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
                    {{-- <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Unit Kerja</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" wire:model="nama_unit">
                            @error('nama_unit') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save changes</button> --}}
                    <form>
                        {{-- <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Unit Kerja</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" aria-describedby="namaHelp" placeholder="Masukkan Nama Unit Kerja" wire:model="nama_unit">
                            <small id="namaHelp" class="form-text text-muted">Silahkan isi nama Unit Kerja.</small>
                            @error('nama_unit') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        @if ($jikaUpdate)
                        <button class="btn btn-primary text-right" wire:click.prevent="update()">Ubah Data</button> <br>
                        <small>Anda dalam mode <span style="color:red;">ubah data</span>, jika ingin menambahkan <b>data baru</b> silahkan <a wire:click.prevent="ubahstatus()" style="color: blue;">Klik link ini</a></small>
                        @else
                        <button class="btn btn-primary text-right" wire:click.prevent="store()">Simpan Data</button>

                        @endif
                      </form>
                    {{-- <a href="" target="_blank" class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-plus"></span> {{ $data->href->create_new_text }}
                </a>
                <a href="{{ $data->href->export }}" class="ml-2 btn btn-success shadow-none">
                    <span class="fas fa-file-export"></span> {{ $data->href->export_text }}
                </a> --}}
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_unit')" role="button" href="#">
                    Nama Unit
                    @include('components.sort-icon', ['field' => 'nama_unit'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($unit_kerjas as $unit_kerja)
                <tr x-data="window.__controller.dataTableController({{ $unit_kerja->id }})">
                    <td>{{ $unit_kerja->id }}</td>
                    <td>{{ $unit_kerja->nama_unit }}</td>
                    <td>{{ $unit_kerja->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="edit({{ $unit_kerja->id }})" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table-custom>

    <!-- Modal -->

<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    @php
                        echo $nama_unit;
                    @endphp
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Unit Kerja</label>
                        {{-- <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" wire:model="nama_unit"> --}}
                        @error('nama_unit') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
