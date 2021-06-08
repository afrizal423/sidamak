<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Manage Reminder') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('reminder_index') }}">Reminder</a></div>
        <div class="breadcrumb-item active">Manage Reminder</div>
        </div>
    </x-slot>
    <div>
        <div>
            <livewire:table.reminder name="reminder"/>
        </div>
    </div>

</x-app-layout>



