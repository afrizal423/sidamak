<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Ubah Data Aduan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('manage_aduan') }}">Data Aduan</a></div>
            <div class="breadcrumb-item">Ubah Data Aduan</div>
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
            <livewire:admin.aduan.tambah-aduan
            action="ubahAduan" :aduanId="request()->aduanId" />
        </div>
    </div>
</x-app-layout>
