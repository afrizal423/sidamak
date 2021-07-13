<div>
    <div class="text-white text-center">
        <h1>
            FORMULIR ADUAN
        </h1>
    </div>
    @if(session()->has('success'))
    <script>
        Swal.fire(
                'Berhasil Mengirim Aduan!',
                'Aduan anda telah tersimpan didatabase kami.',
                'success'
            ).then(function (result) {
            if (true) {
                location.reload();
            }
            });
    </script>
    @endif
    <div class="container card" style="border-radius: 14px;">
        <div style="background-color: #d2e3f1;border-radius: 15px;margin:7px">
            <div style="padding: 17px">
                <form>
                    <div class="form-group" wire:ignore>
                        <label for="select2-dropdown">Divisi</label> <br>
                        <select class="form-control" id="select2-dropdown" wire:model="divisi" >
                            <option value="">Silahkan Pilih</option>
                            @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}" wire:key="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                            @endforeach
                        </select>
                        @error('divisi') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="nampeg">Nama Pelapor</label>
                        <input type="text" class="form-control" id="nampeg" aria-describedby="nampeg" wire:model="nama_pelapor">
                        <small id="nampeg" class="form-text text-muted">Silahkan isi nama pelapor.</small>
                        @error('nama_pelapor') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Permasalahan</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"  wire:model="keterangan"></textarea>
                      @error('keterangan') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary text-right" wire:click.prevent="save()">Kirim Data</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>

    {{-- <div class="container">
        <div class="row">
          <div class="col-sm">
            One of three columns
          </div>
          <div class="col-sm">
            One of three columns
          </div>
          <div class="col-sm">
            One of three columns
          </div>
        </div>
    </div> --}}
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();
        $('#select2-dropdown').on('change', function (e) {
            var pic = $('#select2-dropdown').select2("val");
            @this.set('divisi', pic);

            console.log(pic);
        });
    });
</script>
@endpush
