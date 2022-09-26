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
                <form action="{{ route('admin.dircategory.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <h3 class="tile-title">Edit primary category
                        <span class="top-form-btn">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>

                            <a class="btn btn-secondary" href="{{ route('admin.dircategory.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </span>
                    </h3>
                    <hr>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : $category->parent_category }}" />
                            @error('title') <p class="text-danger">{{ $message ?? '' }}</p> @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{URL::to('/').'/categories/'}}{{$category->parent_category_image}}"  height="100px" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <label class="control-label" for="image">Image <span class="m-l-5 text-danger">*</span></label>
                                    <p class="small text-danger mb-2">Size must be less than 200kb</p>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" />
                                    @error('image') <p class="text-danger">{{ $message ?? '' }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{ old('description') ? old('description') : $category->description }}</textarea>
                            @error('description') <p class="text-danger">{{ $message ?? '' }}</p> @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="short_content">Short content</label>
                            <p class="small text-danger mb-2">Approx. 200 words</p>
                            <textarea class="form-control @error('short_content') is-invalid @enderror" name="short_content" id="short_content" cols="30" rows="10">{{ old('short_content') ? old('short_content') : $category->short_content }}</textarea>
                            @error('short_content') <p class="text-danger">{{ $message ?? '' }}</p> @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="medium_content">Medium content</label>
                            <p class="small text-danger mb-2">Approx. 700 words</p>
                            <textarea class="form-control @error('medium_content') is-invalid @enderror" name="medium_content" id="medium_content" cols="30" rows="10">{{ old('medium_content') ? old('medium_content') : $category->medium_content }}</textarea>
                            @error('medium_content') <p class="text-danger">{{ $message ?? '' }}</p> @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="long_content">Long content</label>
                            <p class="small text-danger mb-2">Approx. 1000-1200 words</p>
                            <textarea class="form-control @error('long_content') is-invalid @enderror" name="long_content" id="long_content" cols="30" rows="10">{{ old('long_content') ? old('long_content') : $category->long_content }}</textarea>
                            @error('long_content') <p class="text-danger">{{ $message ?? '' }}</p> @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href="{{ route('admin.dircategory.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



{{-- @extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
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
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <img src="{{ asset('/admin/uploads/directorycategory/images/' . $targetCategory->image) }}" height="50%"
                    width="40%">
                <form action="{{ route('admin.dircategory.update') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Category Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title', $targetCategory->title) }}" />
                            <input type="hidden" name="id" value="{{ $targetCategory->id }}">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="image">Category Image <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control" type="file" name="image" id="image" />
                        </div>
                    </div>

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                            Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.dircategory.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection --}}
