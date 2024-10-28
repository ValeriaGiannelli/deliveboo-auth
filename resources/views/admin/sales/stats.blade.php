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
        <div class="col-sm col-12 my-3">
            GRAFICO DELLA STATISTICA
        </div>
    </div>

</div>
@endsection
