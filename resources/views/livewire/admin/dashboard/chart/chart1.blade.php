<div>
    {{-- Be like water. --}}
    <div id="chart" style="max-width: 650px;
            margin: 35px auto;">
    </div>
</div>
@push('scripts')
    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'selesai',
                data: {!! json_encode($selesai) !!}
            },
                    {
                name: 'progress',
                data: {!! json_encode($progress) !!}
            },
                    {
                name: 'pending',
                data: {!! json_encode($pending) !!}
            }],
            xaxis: {
                categories: {!! json_encode($tgl_dibuat) !!}
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
    @endpush
