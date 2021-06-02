<div>
    @if(session()->has('success'))
            <script>
            Swal.fire(
                    'Berhasil!',
                    'Data telah tersimpan di database.',
                    'success'
                ).then(function (result) {
                if (true) {
                    window.location = "{{ route('dtpegawai') }}";
                }
                });
            </script>
            @endif
    <div class="card" style="padding: 20px">
        <form>
            <div class="form-group" wire:ignore>
                <label for="select2-dropdown">Divisi</label>
                <select class="form-control" id="select2-dropdown" wire:model.defer="divisi" >
                    <option value="">Silahkan Pilih</option>
                    @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" wire:key="{{ $divisi->id }}" @if ($divisi->id == $divisiss) selected @endif>{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
                @error('divisi') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group" wire:ignore>
                <label for="exampleFormControlSelect1">Unit Kerja</label>
                <select class="form-control" id="unit_kerja" wire:model.defer="unit_kerja">
                    <option value="">Silahkan Pilih</option>
                    @foreach($unit_kerjas as $unit_kerja)
                    <option value="{{ $unit_kerja->id }}" wire:key="{{ $unit_kerja->id }}">{{ $unit_kerja->nama_unit }}</option>
                    @endforeach
                </select>
                @error('unit_kerja') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group" wire:ignore>
                <label for="exampleFormControlSelect1">Jenis User</label>
                <select class="form-control" id="jenis_user" wire:model.defer="jenis_user">
                    <option value="">Silahkan Pilih</option>
                    @foreach($jenis_users as $jenis_user)
                    <option value="{{ $jenis_user->id }}" wire:key="{{ $jenis_user->id }}">{{ $jenis_user->nama_jenis }}</option>
                    @endforeach
                </select>
                @error('jenis_user') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
              <label for="nampeg">Nama Pegawai</label>
              <input type="text" class="form-control" id="nampeg" aria-describedby="nampeg" wire:model.defer="nama_pegawai">
              <small id="nampeg" class="form-text text-muted">Silahkan isi nama pegawai.</small>
              @error('nama_pegawai') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="hppeg">No HP Pegawai</label>
                <input type="number" class="form-control" id="hppeg" aria-describedby="hppeg" wire:model.defer="no_hp">
                <small id="hppeg" class="form-text text-muted">Silahkan isi nomor HP pegawai.</small>
                @error('no_hp') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="altpeg">Alamat Pegawai</label>
                <input type="text" class="form-control" id="altpeg" aria-describedby="altpeg" wire:model.defer="alamat_pegawai">
                <small id="altpeg" class="form-text text-muted">Silahkan isi alamat pegawai.</small>
                @error('alamat_pegawai') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            @if ($action == "ubahPegawai")
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
        $('#select2-dropdown, #unit_kerja, #jenis_user').select2();

        @if ($action == "ubahPegawai")
        $('#select2-dropdown').val({{ $divisiss }}); // Select the option with a value of '1'
        $('#select2-dropdown').trigger('change'); // Notify any JS components that the value changed
        @this.set('divisi', {{ $divisiss }});

        $('#unit_kerja').val({{ $unit_kerjass }}); // Select the option with a value of '1'
        $('#unit_kerja').trigger('change'); // Notify any JS components that the value changed
        @this.set('unit_kerja', {{ $unit_kerjass }});

        $('#jenis_user').val({{ $jenis_userss }}); // Select the option with a value of '1'
        $('#jenis_user').trigger('change'); // Notify any JS components that the value changed
        @this.set('jenis_user', {{ $jenis_userss }});

        @endif

        $('#select2-dropdown').on('change', function (e) {
            var divisi = $('#select2-dropdown').select2("val");
            @this.set('divisi', divisi);

            console.log(divisi);
        });
        $('#unit_kerja').on('change', function (e) {
            var unit_kerja = $('#unit_kerja').select2("val");
            @this.set('unit_kerja', unit_kerja);

            console.log(unit_kerja);
        });
        $('#jenis_user').on('change', function (e) {
            var jenis_user = $('#jenis_user').select2("val");
            @this.set('jenis_user', jenis_user);

            console.log(jenis_user);
        });
    });
// document.addEventListener('livewire:load', function (event) {
//     window.livewire.hook('afterDomUpdate', () => {
//         $('#select2-dropdown').select2();
//     });
// });
</script>

@endpush
