<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-slot name="header_content">
        <h1>{{ __('Data Unit Kerja') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Unit Kerja</a></div>
            {{-- <div class="breadcrumb-item"><a href="{{ route('unit_kerja') }}">Data Unit Kerja</a></div> --}}
        </div>
    </x-slot>

    <div>
        <livewire:table.unitkerja name="unit_kerjas" :model="$unit_kerjas" />
    </div>
    <x-slot name="script">
        {{-- custom js disini  --}}
        <script type="text/javascript">


    //     $(document).ready(function () {
    //     window.livewire.emit('show');
    // });

    window.livewire.on('show', () => {
        $('#exampleModal').modal('show');
    });

            window.livewire.on('unitkerjaStore', () => {
                $('#exampleModal').modal('hide');
            });
        </script>
    </x-slot>
</div>
