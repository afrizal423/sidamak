<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Manage Aduan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('aduan_index') }}">Aduan</a></div>
        <div class="breadcrumb-item active">Manage Aduan</div>
        </div>
    </x-slot>
    <div>
        <div>
            <livewire:table.aduan name="Aduan"/>
        </div>
    </div>

</x-app-layout>
z
