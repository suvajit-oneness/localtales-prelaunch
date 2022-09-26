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
                <hr>
                <form action="{{ route('admin.deal.update') }}" method="POST" role="form" enctype="multipart/form-data">
                	<input type="hidden" name="id" value="{{ $targetDeal->id }}">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($targetDeal->category_id==$category->id){{"selected"}}@endif >{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="business_id">Business</label>
                            <select name="business_id" id="business_id" class="form-control @error('business_id') is-invalid @enderror">
                                <option value="">Select a Business</option>
                                @foreach($businesses as $business)
                                    <option value="{{ $business->id }}" @if($targetDeal->business_id==$business->id){{"selected"}}@endif >{{ $business->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetDeal->title) }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description</label>
                            <textarea class="form-control" rows="4" name="short_description" id="short_description">{{ old('short_description', $targetDeal->short_description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $targetDeal->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Address <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address', $targetDeal->address) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Latitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" id="lat" value="{{ old('lat', $targetDeal->lat) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Longitude <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lon') is-invalid @enderror" type="text" name="lon" id="lon" value="{{ old('lon', $targetDeal->lon) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Pin Code <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin" id="pin" value="{{ old('pin', $targetDeal->pin) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Expiry Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('expiry_date') is-invalid @enderror" type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $targetDeal->expiry_date) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Price <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ old('price', $targetDeal->price) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Promo Code <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('promo_code') is-invalid @enderror" type="text" name="promo_code" id="promo_code" value="{{ old('promo_code', $targetDeal->promo_code) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="how_to_redeem">How To Redeem</label>
                            <textarea class="form-control" rows="4" name="how_to_redeem" id="how_to_redeem">{{ old('how_to_redeem', $targetDeal->how_to_redeem) }}</textarea>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Deal</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.banner.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection