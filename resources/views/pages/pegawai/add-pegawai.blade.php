<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Tambah Data Pegawai') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('dtpegawai') }}">Data Pegawai</a></div>
            <div class="breadcrumb-item">Tambah Data Pegawai</div>
        </div>
    </x-slot>

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
                <div class="alert alert-danger card" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
    <div>
        <div>
            <livewire:create-pegawai action="tambahPegawai" />
        </div>
    </div>
</x-app-layout>
