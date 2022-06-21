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
                <form action="{{ route('admin.faqmodule.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="pretty_name"> Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('pretty_name') is-invalid @enderror" type="text" name="pretty_name" id="pretty_name" value="{{ old('pretty_name', $contact->pretty_name) }}"/>
                            <input type="hidden" name="id" value="{{ $contact->id }}">
                            @error('pretty_name') {{ $message }} @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="content">Content</label>
                            <textarea class="form-control" rows="4" name="content" id="content">{{ old('content', $contact->content) }}</textarea>
                            <input type="hidden" name="id" value="{{ $contact->id }}">
                            @error('content') {{ $message }} @enderror

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($contact->banner_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('ContactusBanner/'.$contact->banner_image) }}" id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Banner Image</label>
                                    <input class="form-control @error('banner_image') is-invalid @enderror" type="file" id="banner_image" name="banner_image"/>
                                    @error('banner_image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($contact->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('Contactus/'.$contact->image) }}" id="blogImage" class="img-fluid" alt="img">
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
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.faqmodule.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
