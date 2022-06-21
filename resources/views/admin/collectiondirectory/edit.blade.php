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
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save CollectionDirectory</button>
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
                                <option value="{{$item->id}}" {{ ($item->id == $targetdirectory->collection_id) ? 'selected' : '' }}>{{ $item->title }}</option>
                                @endforeach
                                </select>
                                @error('collection_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="pin"> Directory <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="directory_id" id="directory_id" class="form-control @error('directory_id') is-invalid @enderror">
                                    <option hidden selected>Select Directory...</option>
                                    @foreach ($directory as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetdirectory->directory_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach


                                </select>
                                @error('directory_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>


                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save CollectionDirectory</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.collectiondir.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
