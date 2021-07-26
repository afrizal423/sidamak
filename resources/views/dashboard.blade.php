<x-app-layout>
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
    </x-slot>

    <div class="">
        {{-- <x-jet-welcome /> --}}
        <div class="container card" style="padding: 15px">
            <h1 style="font-size: 15pt" class="text-center"> Grafik Aduan rentang waktu 1 tahun.</h1>
            <livewire:admin.dashboard.chart.chart1 />
        </div>
        <div class="card" style="padding: 15px">
            <h1 style="font-size: 15pt" class="text-center"> Tabel PIC beserta penyelesaian aduan.</h1>
        <livewire:table.dashboard-admin />
        </div>
    </div>

</x-app-layout>
