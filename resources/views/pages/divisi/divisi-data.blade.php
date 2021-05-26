<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Divisi') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Divisi</a></div>
            {{-- <div class="breadcrumb-item"><a href="{{ route('user') }}">Data User</a></div> --}}
        </div>
    </x-slot>

    <div>
        <livewire:table.divisi name="divisi" :model="$divisis" />
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
</x-app-layout>
