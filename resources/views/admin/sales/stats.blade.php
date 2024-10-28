@section('titlePage')
    Home
@endsection

@extends('layouts.app')
@section('content')

<div class="container-fluid my-4">

    <div class="row w-100">
        @auth
            @include('admin.partials.aside')
        @endauth
        <div class="col-sm-10 col-12 my-3">
            {{-- GRAFICO DELLA STATISTICA

            HAI GUADAGNATO UN TOTALE DI {{ $totalSales }}&euro; --}}

                <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
            <div class="chart-container" style="position: relative; height:80vh; max-width:100%">
                <canvas id="acquisitions"></canvas>
            </div>

            <script>
                // Passa i dati come variabili globali
                window.chartData = {
                    months: @json($allMonths),
                    sales: @json($sales)
                };
    
                if (window.chartData) {
                    (async function() {
                        const { months, sales } = window.chartData;
    
                        // Verifica i dati in console
                        console.log('Mesi:', months);
                        console.log('Vendite:', sales);
    
                        // Crea il grafico con i dati forniti
                        new Chart(document.getElementById('acquisitions'), {
                            type: 'bar',
                            data: {
                                labels: months, // Usa l'array dei mesi
                                datasets: [{
                                    label: 'Vendite mensili',
                                    data: sales, // Usa l'array delle vendite
                                    borderColor: '#36A2EB',
                                    backgroundColor: '#9BD0F5',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Entrate (€)'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Mese'
                                        }
                                    }
                                }
                            }
                        });
                    })();
                } else {
                    console.error('Dati non presenti');
                }
            </script>
    
            </div>
        </div>
    </div>
    @endsection
