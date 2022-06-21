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
                <form action="{{ route('admin.collection.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title"> Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetcollection->title) }}"/>
                            @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_description') is-invalid @enderror" type="text" name="short_description" id="short_description" value="{{ old('short_description', $targetcollection->short_description) }}"/>
                            @error('short_description') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="bottom_content">Content</label>
                            <textarea type="text" class="form-control" rows="4" name="bottom_content" id="bottom_content">{{ old('bottom_content', $targetcollection->bottom_content) }}</textarea>
                            @error('bottom_content') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="description"> Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $targetcollection->description) }}</textarea>
                            {{-- <input name="meta_description" type="text" id="upload" onchange="" hidden> --}}
                            @error('description') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>


                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="pin"> Suburb <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="suburb_id">
                                    <option value="" hidden selected>Select Suburb...</option>
                                    @foreach ($suburb as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetcollection->suburb_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('suburb_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="pin_code">Pin Code</label>
                            <input class="form-control" rows="4" name="pin_code" id="pin_code" value="{{ old('pin_code', $targetcollection->pin_code) }}"/>
                            @error('pin_code') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="address">Address</label>
                            <input class="form-control" rows="4" name="address" id="address" value="{{ old('address', $targetcollection->address) }}"/>
                            @error('address') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_title">Meta Title</label>
                            <input class="form-control" rows="4" name="meta_title" id="meta_title" value="{{ old('meta_title', $targetcollection->meta_title) }}"/>
                            @error('meta_title') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_key">Meta Key</label>
                            <input class="form-control" rows="4" name="meta_key" id="meta_key"{{ old('meta_key', $targetcollection->meta_key) }}/>
                            @error('meta_key') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_description">Meta Description</label>
                            <textarea class="form-control" rows="4" name="meta_description" id="meta_description">{{ old('meta_description', $targetcollection->meta_description) }}</textarea>
                            {{-- <input name="meta_description" type="text" id="upload" onchange="" hidden> --}}

                            @error('meta_description') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="pin_code">Rating</label>
                            <input class="form-control" rows="4" name="rating" id="rating" value="{{ old('rating', $targetcollection->rating) }}"/>
                            @error('rating') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetcollection->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('Collection/'.$targetcollection->image) }}" id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <input type="hidden" name="id" value="{{ $targetcollection->id }}">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Collection</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.collection.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
