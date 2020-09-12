@extends('layouts.admin')
@section('title','Dashboard')
@section('dashboard','active')
@section('content')
@include('includes.page-title',['title' => 'Dashboard','paragraph' => 'Melihat statistik cafe'])
<section class="section">
    <div class="row mb-2">
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between">
                            <h3 class="card-title">
                                Pendapatan
                            </h3><br>
                            <div class="card-right d-flex align-items-center">
                                <p>Rp.
                                    @if (count($incomes) > 0)
                                    {{ number_format($incomes[count($incomes) - 1]->total_incomes,0) ?? 0 }}
                                    @else
                                    0

                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas1" style="
                                    height: 100px !important;
                                "></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between">
                            <h3 class="card-title">
                                Transaksi
                            </h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{ $transactions[0]->total_transaction  ?? 0}}</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas2" style="
                                    height: 100px !important;
                                "></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between">
                            <h3 class="card-title">
                                Menu
                            </h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{ $menus }}</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas3" style="
                                    height: 100px !important;
                                "></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-heading p-1 pl-3">
                        Pengeluaran bahan-bahan bulan ini
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-12">
                            <canvas id="bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-heading p-1 pl-3">
                        Pemasukan bahan-bahan bulan ini
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-12">
                            <canvas id="bar-pemasukan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    var config1 = {
        type: "line",
        data: {
            labels: [
               @foreach($incomes as $income)
                '{{ $income->month }}',
               @endforeach
            ],
            datasets: [
                {
                    label: "Jumlah",
                    backgroundColor: "#fff",
                    borderColor: "#fff",
                    data: [
                        @foreach($incomes as $income)
                            '{{ $income->total_incomes }}',
                        @endforeach
                    ],
                    fill: false,
                    pointBorderWidth: 100,
                    pointBorderColor: "transparent",
                    pointRadius: 3,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,1)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: -10,
                    top: 10,
                },
            },
            legend: {
                display: false,
            },
            title: {
                display: false,
            },
            tooltips: {
                mode: "index",
                intersect: false,
                callbacks: {
                label: function(tooltipItem, chart){
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel, 0);
                }
            },
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                ],
            },
        },
    };
    
    var config2 = {
        type: "line",
        data: {
            labels: [
                @foreach($transactions as $transaction)
                '{{ $transaction->month }}',
               @endforeach
            ],
            datasets: [
                {
                    label: "Transaksi",
                    backgroundColor: "#fff",
                    borderColor: "#fff",
                    data: [
                        @foreach($transactions as $transaction)
                            '{{ $transaction->total_transaction }}',
                        @endforeach
                    ],
                    fill: false,
                    pointBorderWidth: 100,
                    pointBorderColor: "transparent",
                    pointRadius: 3,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,1)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: -10,
                    top: 10,
                },
            },
            legend: {
                display: false,
            },
            title: {
                display: false,
            },
            tooltips: {
                mode: "index",
                intersect: false,
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                ],
            },
        },
    };

    var config3 = {
        type: "line",
        data: {
            labels: [
                "Menu",
                "Menu",
                "Menu",
                "Menu"
            ],
            datasets: [
                {
                    label: "menu",
                    backgroundColor: "#fff",
                    borderColor: "#fff",
                    data: [25, 40, 20, 52],
                    fill: false,
                    pointBorderWidth: 100,
                    pointBorderColor: "transparent",
                    pointRadius: 3,
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "rgba(63,82,227,1)",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: -10,
                    top: 10,
                },
            },
            legend: {
                display: false,
            },
            title: {
                display: false,
                text: "Chart.js Line Chart",
            },
            tooltips: {
                mode: "index",
                intersect: false,
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            drawBorder: false,
                            display: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            display: false,
                        },
                    },
                ],
            },
        },
    };
    let ctx1 = document.getElementById("canvas1").getContext("2d");
    let incomeChart = new Chart(ctx1, config1);

    let ctx2 = document.getElementById("canvas2").getContext("2d");
    let transaction_total_chart = new Chart(ctx2, config2);

    let ctx3 = document.getElementById("canvas3").getContext("2d");
    let menus_chart = new Chart(ctx3, config3);

    let ctxBar = document.getElementById("bar").getContext("2d");
    let myBar = new Chart(ctxBar, {
        type: "bar",
        data: {
            labels: [
                @foreach($totalIngredients as $key => $value)
                    "{{ $key }}",
                @endforeach
            ],
            datasets: [
                {
                    label: "Terpakai",
                    backgroundColor: [
                        @foreach($sumIngredients as $total)
                            getRandomColor(),
                        @endforeach
                    ],
                    data: [
                        @foreach($sumIngredients as $total)
                            "{{ $total }}",
                        @endforeach
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            barRoundness: 1,
            title: {
                display: false,
                text:
                    "Chart.js - Bar Chart with Rounded Tops (drawRoundedTopRectangle Method)",
            },
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            suggestedMax: 40 + 20,
                            padding: 10,
                            callback: function(value, index, values) {
                                return  Math.floor(value) + 'gr'; 
                            },
                            stepSize:100
                        },
                        gridLines: {
                            drawBorder: false,
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                ],
            },
        },
    });

    let ingredientCome = document.getElementById("bar-pemasukan").getContext("2d");
    let ingredientChart = new Chart(ingredientCome, {
        type: "bar",
        data: {
            labels: [
                @foreach($ingredientCome as  $ingredient)
                    "{{ $ingredient->name }}",
                @endforeach
            ],
            datasets: [
                {
                    label: "Masuk",
                    backgroundColor: [
                        @foreach($ingredientCome as $total)
                            getRandomColor(),
                        @endforeach
                    ],
                    data: [
                        @foreach($ingredientCome as  $ingredient)
                            "{{ $ingredient->stock }}",
                        @endforeach
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            barRoundness: 1,
            title: {
                display: false,
                text:
                    "Chart.js - Bar Chart with Rounded Tops (drawRoundedTopRectangle Method)",
            },
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            
                            suggestedMax: 40 + 20,
                            padding: 10,
                            callback: function(value, index, values) {
                                return  Math.floor(value) + 'gr'; 
                            },
                            stepSize:100
                        },
                        gridLines: {
                            drawBorder: false,
                        },
                        
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                    },
                ],
            },
        },
    });
</script>
@endpush