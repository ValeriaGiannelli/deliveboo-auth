@section('titlePage')
    Statistiche
@endsection

@extends('layouts.app')
@section('content')

<div class="container-fluid my-4">
    <div class="row w-100">
        @auth
            @include('admin.partials.aside')
        @endauth
        <div class="col-sm col-12 my-3">
            GRAFICO DELLA STATISTICA
             <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
            <div style="width: 800px;"><canvas id="acquisitions"></canvas></div>


        </div>
    </div>

</div>

<script>

    (async function() {
  const data = [
    { year: 2010, count: 10 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];

  new Chart(
    document.getElementById('acquisitions'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'Acquisitions by year',
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
})();
</script>

@endsection
