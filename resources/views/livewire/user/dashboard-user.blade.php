<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="header_content">
        <h1>{{ __('Dashboard User') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        </div>
    </x-slot>
    @if ($status)
    <div>
        <div class="header_content card" style="padding: 25px">
            <h1 style="font-size: 20pt">Tambahkan PIC untuk aduan ini</h1>
            Jumlah Antrean dibelakang {{$aduan-1}} dari {{$aduan}}
        </div>
        <livewire:admin.aduan.tambah-aduan action="ubahAduanUser" :aduanId="$idnya" />
    </div>
    @else
    <div>
        nanti chart disini
    </div>
    @endif
</div>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#select2-dropdown, #select2-dropdown-0').select2();

    });
</script>

@endpush
