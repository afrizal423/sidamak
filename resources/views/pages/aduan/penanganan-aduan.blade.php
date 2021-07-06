<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Penanganan Aduan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active">List Aduan</div>
        </div>
    </x-slot>
    <div>
        <div>
            <livewire:table.penanganan-aduan name="progressnya" />
        </div>
    </div>
    <x-slot name="script">
        {{-- custom js disini  --}}
        <script type="text/javascript">

    window.livewire.on('show', () => {
        console.log("buka modal");
        $('#exampleModal').modal('show');
        $("#exampleModal").appendTo("body");
    });
    window.livewire.on('showsolusi', () => {
        $('#solusiModal').modal('show');
        $("#solusiModal").appendTo("body");
    });
    window.livewire.on('tutup', () => {
        console.log("tutup modal");
        $('.close-modal').click();


    });
        </script>
    </x-slot>
</x-app-layout>
