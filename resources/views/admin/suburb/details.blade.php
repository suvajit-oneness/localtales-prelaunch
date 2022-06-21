@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p></p>
        </div>
    </div>
    @include('admin.partials.flash')

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-10">
                            <h3>Name : {{ $suburb->name }}</h3>
                            <h3>Pincode :{{ $suburb->pin ? $suburb->pin->pin : '' }}</h3>
                            <h3>Description : {{ $suburb->description }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>




@endsection
