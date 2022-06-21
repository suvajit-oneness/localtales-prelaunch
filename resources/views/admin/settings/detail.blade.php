@extends('admin.app')

@section('page', 'Settings detail')

@section('content')
<section>
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-muted small mb-1">Page</p>
                            <p class="text-dark small">{{strtoupper($settings->key)}}</p>

                            <p class="text-muted small mb-1">Content</p>
                            <p class="text-dark small">{!! $settings->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                        <h4 class="page__subtitle">Edit</h4>
                        <div class="form-group">
                            <label class="control-label" for="content">Content</label>
                            <textarea class="form-control" rows="4" name="content" id="content">{{ old('content', $settings->content) }}</textarea>
                            <input type="hidden" name="id" value="{{ $settings->id }}">
                            @error('content') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="key" value="terms">
                            <button type="submit" class="btn btn-sm btn-danger">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
