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
                            <p>State :{{ $suburb->state}}</p>
                            <p>Pincode :{{ $suburb->pin_code}}</p>
                              <p>Region :{{ $suburb->region_name}}</p>
                               <p>Est. Population :{{ $suburb->population}}</p>
                            <p>Description : {{ $suburb->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-secondary" href="{{ route('admin.suburb.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
        </div>




@endsection
