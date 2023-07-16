@extends('layouts.app')

@section('content') 
   
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-row-reverse" >
                            <h3 class="card-title">{{$metricas->total_compras}}<i class="fas fa-dollar-sign"></i> </h3>
                        </div>
                        <div class="row">
                            <p class="card-text">Total anual en compras</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-row-reverse" >
                            <h3 class="card-title">{{$metricas->total_ventas}}<i class="fas fa-dollar-sign"></i> </h3>
                        </div>
                        <div class="row">
                            <p class="card-text">Total anual en ventas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-row-reverse" >
                            <h3 class="card-title">{{$metricas->total_ganancias}}<i class="fas fa-dollar-sign"></i> </h3>
                        </div>
                        <div class="row">
                            <p class="card-text">Total anual en ganancias</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-row-reverse" >
                            <h3 class="card-title">{{$metricas->total_impuestos}}<i class="fas fa-dollar-sign"></i> </h3>
                        </div>
                        <div class="row">
                            <p class="card-text">Total anual impuesto por pagar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container" style="width: 700px; height: 400px;">
        <input id="compras" type="hidden" value="{{$metricas->compras}}">
        <input id="ventas" type="hidden" value="{{$metricas->ventas}}">
        <canvas id="grafico"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const grafico = document.getElementById('grafico');

        const rawCompras = document.getElementById('compras').value.split(' ');
        const rawVentas = document.getElementById('ventas').value.split(' ');
        
        let compras = [];
        let ventas = [];
        for(let i = 1; i<13; i++){
            compras.push(parseInt(rawCompras[i]));
            ventas.push(parseInt(rawVentas[i]));
        }

        var datosCompras = {
            label: "Compras",
            data: compras,
            lineTension: 0,
            fill: false,
            borderColor: 'red'
        };

        var datosventas = {
            label: "Ventas",
            data: ventas,
            lineTension: 0,
            fill: false,
            borderColor: 'blue'
        };

        var speedData = {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [datosCompras, datosventas]
        };

        var chartOptions = {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 80,
                    fontColor: 'black'
                }
            },
            scales: {
                y: {
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return   value+' $' ;
                        }
                    }
                }
            }
        };

        

        var lineChart = new Chart(grafico, {
            type: 'line',
            data: speedData,
            options: chartOptions
        });
        
        </script>
@endsection