@extends('admin.app')
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
                <img src="{{ asset('/admin/uploads/suburb/' . $suburb->image) }}" height="50%" width="30%"
                    alt="">
                <form action="{{ route('admin.suburb.update') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                id="name" value="{{ old('name', $suburb->name) }}" />
                            <input type="hidden" name="id" value="{{ $suburb->id }}">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="state">State <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('state') is-invalid @enderror" type="text" name="state"
                                id="state" value="{{ old('state', $suburb->state) }}" />
                            <input type="hidden" name="id" value="{{ $suburb->id }}">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="region_name">Region Name <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('region_name') is-invalid @enderror" type="text" name="region_name"
                                id="region_name" value="{{ old('region_name', $suburb->region_name) }}" />
                            <input type="hidden" name="id" value="{{ $suburb->id }}">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name"> Postcode <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="pin_code">
                                <option hidden selected>Select Postcode...</option>
                                @foreach ($pin as $index => $item)
                                    <option value="{{ $item->pin }}"
                                        {{ $item->pin == $suburb->pin_code ? 'selected' : '' }}>{{ $item->pin }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pin_code')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="description">Description <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('description') is-invalid @enderror" type="text"
                                name="description" id="description"
                                value="{{ old('description', $suburb->description) }}" />
                            <input type="hidden" name="id" value="{{ $suburb->id }}">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{URL::to('/').'/admin/uploads/suburb/'}}{{$suburb->image}}"  height="100px" class="img-thumbnail">
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

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                            Suburb</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.suburb.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
