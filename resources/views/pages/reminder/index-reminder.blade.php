<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Reminder') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Reminder</div>
            {{-- <div class="breadcrumb-item">Tambah Data Pegawai</div> --}}
        </div>
    </x-slot>
    <div>
        <div>
            {{-- <livewire:create-pegawai action="tambahPegawai" /> --}}

            <livewire:reminder.calendar
            before-calendar-view="pages/reminder/header"
            />

        </div>
    </div>

<x-slot name="script">
    @livewireCalendarScripts
</x-slot>
</x-app-layout>



