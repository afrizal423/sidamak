<div>
    {{-- The whole world belongs to you. --}}
    <x-slot name="header_content">
        <h1>{{ __('Data Jenis User') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Jenis User</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.jenisuser name="jenis_user" :model="$jenis_users" />
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
