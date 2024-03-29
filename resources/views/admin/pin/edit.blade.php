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
                <h3 class="tile-title">Edit Postcode</h3>
                @if(!$targetpin->image)
                <img src="{{ asset('/Directory/placeholder-image.png') }}" height="50%" width="35%">
                @else
                <img src="{{ asset('/admin/uploads/pincode/images/' . $targetpin->image) }}" height="50%" width="35%">
                @endif
                <form action="{{ route('admin.pin.update') }}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Postcode <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin"
                                id="pin" value="{{ old('pin', $targetpin->pin) }}" />
                            <input type="hidden" name="id" value="{{ $targetpin->id }}">
                            @error('pin')
                                {{ $message }}
                            @enderror
                        </div>


                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="description">Description <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" type="text"
                                name="description" id="summernote-description"
                                value="{{ old('description', $targetpin->description) }}" /></textarea>
                            <input type="hidden" name="id" value="{{ $targetpin->id }}">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>


                    </div>
                    <div class="page-search-block filterSearchBoxWraper" style="bottom: -83px;">
                        <div class="filterSearchBox">
                            <div class="row">
                                <div class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                <div class="select-floating-admin">
                                    <label class="control-label" for="pincode"> State</label>
                                    <select class="filter_select form-control" name="state_id">
                                        <option value="" hidden selected>Select State...</option>
                                        @foreach ($states as $index => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $targetpin->state_id ? 'selected' : '' }}>{{ $item->name }}
                                                </option>
                                            @endforeach
                                    </select>
                                    @error('state_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="title-body">
                        <div class="form-group">
                            <label for="image" class="form-label">Select image</label>
                            <p class="small text-danger mb-2">Size must be less than 200kb</p>
                            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png">
                        </div>
                    </div>


                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                            Postcode</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.pin.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote-description').summernote({
        height: 400
    });
</script>
@endpush
