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
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.blog.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Blog Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetblog->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetblog->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>

                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="pin"> Category <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="blog_category_id">
                                    <option hidden selected>Select Categoy...</option>
                                    @foreach ($blogcat as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetblog->blog_category_id) ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @error('blog_category_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="pin"> Sub Category <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="blog_sub_category_id">
                                    <option hidden selected>Select Sub Categoy...</option>
                                    @foreach ($blogsubcat as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetblog->blog_sub_category_id) ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @error('blog_sub_category_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="pincode">Select Pincode  <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="pincode">
                                    <option hidden selected>Select Pincode ...</option>
                                    @foreach ($pin as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetblog->pincode) ? 'selected' : '' }}>{{ $item->pin }}</option>
                                    @endforeach
                                </select>
                                @error('pincode') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="suburb_id"> Suburb<span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="suburb_id">
                                    <option hidden selected>Select Suburb...</option>
                                    @foreach ($suburb as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetblog->suburb_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('suburb_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content">Content</label>
                            <textarea class="form-control" rows="4" name="content" id="content">{{ old('content', $targetblog->content) }}</textarea>
                            <input type="hidden" name="id" value="{{ $targetblog->id }}">
                            @error('content') {{ $message }} @enderror

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_title">Meta Title</label>
                            <input class="form-control @error('meta_title') is-invalid @enderror" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $targetblog->meta_title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetblog->id }}">
                            @error('meta_title') {{ $message }} @enderror

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_key">Meta Key</label>
                            <input class="form-control @error('meta_key') is-invalid @enderror" type="text" name="meta_key" id="meta_key" value="{{ old('meta_key', $targetblog->meta_key) }}"/>
                            <input type="hidden" name="id" value="{{ $targetblog->id }}">
                            @error('meta_key') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_description">Description</label>
                            <textarea class="form-control" rows="4" name="meta_description" id="meta_description">{{ old('meta_description', $targetblog->meta_description) }}</textarea>
                            <input type="hidden" name="id" value="{{ $targetblog->id }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="tag">Tag</label>
                            <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag" id="tag" value="{{ old('tag', $targetblog->tag) }}"/>
                            <input type="hidden" name="id" value="{{ $targetblog->id }}">
                            @error('tag') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetblog->banner_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('Blogs/'.$targetblog->banner_image) }}" id="banner_image" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Blog Banner Image</label>
                                    <input class="form-control @error('banner_image') is-invalid @enderror" type="file" id="banner_image" name="banner_image"/>
                                    @error('banner_image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetblog->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('Blogs/'.$targetblog->image) }}" id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Blog Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetblog->image2 != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('Blogs/'.$targetblog->image2) }}" id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Blog Image2</label>
                                    <input class="form-control @error('image2') is-invalid @enderror" type="file" id="image2" name="image2"/>
                                    @error('image2') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Blog</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.blog.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
