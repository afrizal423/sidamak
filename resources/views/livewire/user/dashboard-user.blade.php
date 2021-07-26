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
    <div class="card" style="padding: 15px">
        <h1 style="font-size: 15pt" class="text-center"> Grafik Aduan rentang waktu 1 tahun.</h1>
        <livewire:admin.dashboard.chart.chart1 />
    </div>
    <div class="card" style="padding: 15px">
        <h1 style="font-size: 15pt" class="text-center"> Tabel progress aduan yang sedang berlangsung.</h1>
        <livewire:table.status-progress name="progressnya" />
    </div>
    {{-- {!! Toastr::message() !!} --}}
    {{-- <script>
        // toastr.info('Are you the 6 fingered man?');
        toastr.success('We do have the Kapua suite available.', 'Turtle Bay Resort <a href="http://google.com" target="_blank" rel="noopener noreferrer"> woi</a>', {timeOut: 5000})
        toastr.options.onShown = function() { console.log('hello'); }
        toastr.options.onHidden = function() { console.log('goodbye'); }
        toastr.options.onclick = function() { console.log('clicked'); }
        toastr.options.onCloseClick = function() { console.log('close button clicked'); }
        </script> --}}
    @endif
</div>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#select2-dropdown, #select2-dropdown-0').select2();

    });
</script>
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

@endpush
