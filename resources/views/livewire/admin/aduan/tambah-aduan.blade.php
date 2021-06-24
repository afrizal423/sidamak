<div>
    {{-- Do your work, then step back. --}}
    @if(session()->has('success'))
            <script>
            Swal.fire(
                    'Berhasil!',
                    'Data telah tersimpan di database.',
                    'success'
                ).then(function (result) {
                if (true) {
                    window.location = "{{ route('manage_aduan') }}";
                }
                });
            </script>
    @endif

    <div class="card" style="padding: 20px">
        {{-- {{ $hitungData }} --}}
        {{-- {{ $inputs->pic[0]->keluhan_pic->id_pegawai }} --}}
        <form>
            <div class="form-group" wire:ignore>
                <label for="select2-dropdown">Divisi</label> <br>
                <select class="form-control" id="select2-dropdown" wire:model.defer="divisi" >
                    <option value="">Silahkan Pilih</option>
                    @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" wire:key="{{ $divisi->id }}" @if ($divisi->id == $divisiss) selected @endif>{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
                @error('divisi') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
              <label for="nampeg">Nama Pelapor</label>
              <input type="text" class="form-control" id="nampeg" aria-describedby="nampeg" wire:model.defer="nama_pelapor">
              <small id="nampeg" class="form-text text-muted">Silahkan isi nama pelapor.</small>
              @error('nama_pelapor') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="altpeg">Laporan</label>
                <textarea
                        rows="5"
                        class="border rounded p-2 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                        id="altpeg" aria-describedby="altpeg" wire:model.defer="keterangan"
                ></textarea>
                {{-- <input type="text" > --}}
                <small id="altpeg" class="form-text text-muted">Silahkan isi Permasalahan yang dihadapi.</small>
                @error('keterangan') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            @if ($action == "ubahAduan")
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10" wire:ignore>
                        <label for="select2-dropdown">PIC</label> <br>
                        <select class="form-control" id="select2-dropdown-0" wire:model.defer="pic.0" >
                            <option value="">Silahkan Pilih</option>
                            @foreach($pegawais as $pegawai)
                            <option value="{{ $pegawai->id }}" wire:key="{{ $pegawai->id }}">{{ $pegawai->nama_pegawai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Tambah PIC Baru</button>
                    </div>
                </div>
                @error('pic.0') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            @foreach ($datanya as $key => $value)
                {{-- id pegawai {{$value->keluhan_pic->id_pegawai}} --}}
                @if ($key > 0)
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-10" wire:ignore>
                            <label for="select2-dropdown">PIC {{$key+1}}</label> <br>
                            <select class="form-control" id="select2-dropdown-{{$key}}" wire:model.defer="pic.{{$key}}" >
                                <option value="">Silahkan Pilih</option>
                                @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" wire:key="{{ $pegawai->id }}">{{ $pegawai->nama_pegawai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Hapus PIC</button>                        </div>
                    </div>
                    @error('pic.{{$key}}') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                @endif
            @endforeach
            {{-- NEW DATA  --}}
            @php
                $no = count($datanya)+1;
            @endphp
            @foreach ($dataBaru as $keys => $values)
                {{-- id pegawai {{$value->keluhan_pic->id_pegawai}} --}}
                {{-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-10" wire:ignore>
                            <label for="select2-dropdown-new-{{$keys}}">PIC</label> <br>
                            <select class="form-control" id="select2-dropdown-new-{{$keys}}" wire:model.defer="picnya.{{$values}}" >
                                <option value="">Silahkan Pilih</option>
                                @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" wire:key="{{ $pegawai->id }}">{{ $pegawai->nama_pegawai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$keys}})">Hapus PIC</button>                        </div>
                    </div>
                    @error('picnya.{{$keys}}') <span class="text-danger error">{{ $message }}</span>@enderror
                </div> --}}
                @if (empty($selectedIds[$keys]))
                <div class="form-group"
                x-data="{isVisible: false}"
                @click.away="isVisible = false">
                @else
                <div class="form-group">
                @endif
                    <div class="row">
                        <div class="col-md-10">
                            <label for="nampeg">PIC {{$no}}</label>
                            @if (empty($selectedIds[$keys]))
                            <input type="text" class="form-control" aria-describedby="nampeg"
                            wire:model="searchText"
                            @focus="isVisible = true"
                            type="text">

                            <div
                                    x-show="isVisible"
                                    style="display: none"
                                    class="card absolute w-full max-h-40 overflow-scroll border-b border-gray-300 overscroll-contain">
                                @foreach($items as $pegawai)
                                    <div
                                        class="w-full bg-gray-100 p-1 mb-1 rounded-md hover:bg-gray-200 cursor-pointer pl-2 font-semibold"
                                        wire:click="choose({{$pegawai->id}})"
                                        @click="isVisible = false"
                                    >
                                        {{$pegawai->nama_pegawai}}
                                    </div>
                                @endforeach
                            </div>
                            @else
                            <br>
                            <span>{{ $this->ambilDataPegawai($keys) }}</span>

                            @endif
                            {{-- <small id="nampeg" class="form-text text-muted">Silahkan isi nama pelapor.</small> --}}
                            @error('nama_pelapor') <span class="text-danger error">{{ $message }}</span>@enderror
                            {{-- {{ empty($selectedIds[$keys]) ? "" : $keys }} --}}
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="removenew({{ $keys }})">Hapus PIC</button>                        </div>
                    </div>
                    @error('picnya.{{$keys}}') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                {{-- <div class="form-group"
                x-data="{isVisible: false}"
                @click.away="isVisible = false">
                    <div class="row">
                        <div class="col-md-10">
                            <label for="nampeg">PIC</label>
                            <input type="text" class="form-control" aria-describedby="nampeg"
                            wire:model="searchText"
                            @focus="isVisible = true"
                            type="text">
                            <div
                                    x-show="isVisible"
                                    style="display: none"
                                    class="card absolute w-full max-h-40 overflow-scroll border-b border-gray-300 overscroll-contain">
                                @foreach($pegawais as $pegawai)
                                    <div
                                        class="w-full bg-gray-100 p-1 mb-1 rounded-md hover:bg-gray-200 cursor-pointer pl-2 font-semibold"
                                        wire:click="choose({{$pegawai->id}})"
                                        @click="isVisible = false"
                                    >
                                        {{$pegawai->nama_pegawai}}
                                    </div>
                                @endforeach
                            </div>
                            <small id="nampeg" class="form-text text-muted">Silahkan isi nama pelapor.</small>
                            @error('nama_pelapor') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-sm" wire:click.prevent="removenew({{$keys}})">Hapus PIC</button>                        </div>

                        </div>
                    </div>
                </div> --}}
                @php
                    $no++;
                @endphp
            @endforeach
            @endif
            @if ($action == "ubahAduan")
            <button type="submit" class="btn btn-primary" wire:click.prevent="ubah()">Simpan Perubahan</button>
            @else
            <button type="submit" class="btn btn-primary" wire:click.prevent="save()">Simpan Data</button>
            @endif
          </form>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();

        @if ($action == "ubahAduan")
        $('#select2-dropdown').val({{ $divisiss }}); // Select the option with a value of '1'
        $('#select2-dropdown').trigger('change'); // Notify any JS components that the value changed
        @this.set('divisi', {{ $divisiss }});
        // @this.set('picnya', {{ $divisiss }});
        // @this.set('selectedIds.0', {{ $divisiss }});


        @php
        $id = " ";
        @endphp
        @for ($a = 0; $a < $i; $a++)
            @php
                if ($a == $i-1) {
                    $id .= "#select2-dropdown-".$a." ";
                } else if ($a != $i) {
                    $id .= "#select2-dropdown-".$a.", ";
                }
                // $id .= " ";
            @endphp
        @endfor
        // disini
        $('{{$id}}').select2();

        @foreach ($inputs->pic as $key => $value)
        $('#select2-dropdown-{{$key}}').val({{ $value->keluhan_pic->id_pegawai }}); // Select the option with a value of '1'
        $('#select2-dropdown-{{$key}}').trigger('change'); // Notify any JS components that the value changed
        @this.set('pic.{{$key}}', {{ $value->keluhan_pic->id_pegawai }});

                // {{$key}} - {{$value->keluhan_pic->id_pegawai}}
         $('#select2-dropdown-{{$key}}').on('change', function (e) {
            var pic = $('#select2-dropdown-{{$key}}').select2("val");
            @this.set('pic.{{$key}}', pic);

            console.log(pic);
        });
        @endforeach

        @endif // end if update

        $('#select2-dropdown').on('change', function (e) {
            var divisi = $('#select2-dropdown').select2("val");
            @this.set('divisi', divisi);
        });

    });
// document.addEventListener('livewire:load', function (event) {
//     window.livewire.hook('afterDomUpdate', () => {
//         $('#select2-dropdown').select2();
//     });
// });
</script>

@endpush
