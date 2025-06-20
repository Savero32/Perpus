@php
use App\Models\User;
use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;

$jumlahAnggota = User::where('jenis', 'member')->count();
$jumlahPinjam = Pinjam::where('status', 'pinjam')->count();
$anggotaPerTahun = User::selectRaw("strftime('%Y', created_at) as tahun, COUNT(*) as total")
    ->where('jenis', 'member')
    ->groupBy(DB::raw("strftime('%Y', created_at)"))
    ->orderBy('tahun')
    ->pluck('total', 'tahun');
@endphp

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Total Anggota</div>
            <div class="card-body">
                <h5 class="card-title">{{ $jumlahAnggota }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Total Peminjaman Aktif</div>
            <div class="card-body">
                <h5 class="card-title">{{ $jumlahPinjam }}</h5>
            </div>
        </div>
    </div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="anggota-tahun"></div>
    <p class="highcharts-description">
        Grafik pertumbuhan anggota perpustakaan per tahun.
    </p>
</figure>

<script>
document.addEventListener('DOMContentLoaded', function () {
    Highcharts.chart('anggota-tahun', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Anggota Per Tahun'
        },
        xAxis: {
            categories: @json(array_keys($anggotaPerTahun->toArray())),
            crosshair: true,
            title: { text: 'Tahun' }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Anggota'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Anggota',
            data: @json(array_values($anggotaPerTahun->toArray()))
        }]
    });
});
</script>
<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tbody tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-description {
    margin: 0.3rem 10px;
}
</style>
