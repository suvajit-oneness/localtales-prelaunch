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
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Event</button>
                        <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.event.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="business_id">Business</label>
                            <select name="business_id" id="business_id" class="form-control @error('business_id') is-invalid @enderror">
                                <option value="">Select a Business</option>
                                @foreach($businesses as $business)
                                    <option value="{{ $business->id }}">{{ $business->bussiness_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Event Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Address <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Latitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" id="lat" value="{{ old('lat') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Longitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lon') is-invalid @enderror" type="text" name="lon" id="lon" value="{{ old('lon') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Pin Code <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin" id="pin" value="{{ old('pin') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Start Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Start Time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('start_time') is-invalid @enderror" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">End Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">End Time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('end_time') is-invalid @enderror" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}"/>
                        </div>
                      
                        <div class="form-group">
                            <label class="control-label" for="is_paid">Paid Event?</label>
                            <select name="is_paid" id="is_paid" class="form-control @error('is_paid') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Price <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ old('price') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="is_recurring">Recurring Event?</label>
                            <select name="is_recurring" id="is_recurring" class="form-control @error('is_recurring') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Website <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('website') is-invalid @enderror" type="text" name="website" id="website" value="{{ old('website') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Contact Email Id <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('contact_email') is-invalid @enderror" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Contact Phone No <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('contact_phone') is-invalid @enderror" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}"/>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Event</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection