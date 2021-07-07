<x-app-layout>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Approval Aduan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active">Approval Aduan</div>
        </div>
    </x-slot>
    <div>
        <div>
            <livewire:table.approval-aduan name="progressnya" />
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
    window.livewire.on('tutup', () => {
        console.log("tutup modal");
        $('.close-modal').click();


    });
        </script>
    </x-slot>
</x-app-layout>
