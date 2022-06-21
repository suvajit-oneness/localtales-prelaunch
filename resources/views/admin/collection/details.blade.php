@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td> Title</td>
                            <td>{{ empty($collection['title'])? null:$collection['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{{ empty($collection['short_description'])? null:$collection['short_description'] }}</td>
                        </tr>
                        <tr>
                            <td>Content</td>
                            <td>{!!empty($collection['bottom_content'])? null:$collection['bottom_content'] !!}</td>
                        </tr>
                        <tr>
                            <td>Pin Code</td>
                            <td>{{ empty($collection['pin_code'])? null:$collection['pin_code'] }}</td>
                        </tr>
                        <tr>
                            <td>Suburb</td>
                            <td>{{ $collection->suburb ? $collection->suburb->name : '' }}</td>
                        </tr>
                        <tr>
                            <td> Meta Title</td>
                            <td>{{ empty($collection['meta_title'])? null:$collection['meta_title'] }}</td>
                        </tr>
                        <tr>
                            <td> Meta Key</td>
                            <td>{{ empty($collection['meta_key'])? null:$collection['meta_key'] }}</td>
                        </tr>
                        <tr>
                            <td> Meta Description</td>
                            <td>{!! empty($collection['meta_description'])? null:$collection['meta_description'] !!}</td>
                        </tr>

                        <tr>
                            <td>Description</td>
                            <td>{!! empty($collection['description'])? null:($collection['description']) !!}</td>
                        </tr>

                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.collection.index') }}">Back</a>
            </div>


        </div>
    </div>
@endsection
