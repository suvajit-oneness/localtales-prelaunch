@extends('site.appprofile')
@section('title') Dashboard @endsection
@section('content')

@php
$businesses = App\Models\Userbusiness::where('user_id',Auth::guard('user')->user()->id)->get();
$collection = App\Models\UserCollection::where('user_id',Auth::guard('user')->user()->id)->get();
@endphp
<style type="text/css">
    .row-md-body.no-nav {
    margin-top: 70px;
}
</style>
<div class="fixed-row">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
</div>
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-6 col-lg-3">
        <div class="card-body event-body">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-briefcase fa-3x"></i>
                <div class="info">
                    <h4>Favourite Business</h4>
                    <p><b> {{count($businesses)}} </b></p>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-briefcase fa-3x"></i>
                <div class="info">
                    <h4>Favourite Collection</h4>
                    <p><b> {{count($collection)}} </b></p>
                </div>
            </div>
        </div>
    </div>
@endsection