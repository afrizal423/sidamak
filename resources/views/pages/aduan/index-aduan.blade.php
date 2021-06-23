<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Tambah Aduan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Tambah Aduan</div>
        </div>
    </x-slot>
    <div>
        <div>
            <livewire:admin.aduan.tambah-aduan
            action="tambahAduan"
            />
        </div>
    </div>

<x-slot name="script">
</x-slot>
</x-app-layout>



