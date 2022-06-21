@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}
                    <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Directory</button>
                        <a class="btn btn-secondary" href="{{ route('admin.collectiondir.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.collectiondir.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="pin"> Collection <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="collection_id">
                                    <option hidden selected>Select Collection...</option>
                                    @foreach ($col as $index => $item)
                                        <option value="{{$item->id}}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @error('collection_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                         <div class="col-auto">
                    <form action="{{ route('admin.collectiondir.create') }}">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                        <input type="search" name="term" id="term" class="form-control" placeholder="Search here.." value="{{app('request')->input('term')}}" autocomplete="off">
                        </div>
                        <div class="col-auto">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Search Collection </button>
                        </div>
                    </div>
                    </form>
                </div>
                        <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>

                                <th> Title </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($directory as $key => $blog)
                                <tr>


                                    <td>{{ $blog->name }}</td>
                                   
                                    


                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Collection</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.collectiondir.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
