<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-slot name="header_content">
        <h1>{{ __('Data Pegawai') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Pegawai</a></div>
        </div>
    </x-slot>

    <div class="card">
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

                <a href="{{ route('tambah_pegawai') }}" class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-plus"></span> Tambah Data Pegawai
                </a>
                {{-- <a href="" class="ml-2 btn btn-success shadow-none">
                    <span class="fas fa-file-export"></span> Export PDF
                </a> --}}
        </div>
    </div>

    <div>
        <livewire:table.pegawai-index name="pegawai" :model="$pegawais" />
    </div>
    <x-slot name="script">
        {{-- custom js disini  --}}
        <script type="text/javascript">

    window.livewire.on('show', () => {
        console.log("buka modal");
        $('#exampleModal').modal('show');
        $("#exampleModal").appendTo("body");
    });
    window.livewire.on('tutup', () => {
        console.log("tutup modal");
        $('.close-modal').click();


    });
        </script>
    </x-slot>
</div>
