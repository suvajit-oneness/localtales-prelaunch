@extends('site.app')
{{-- @section('title') {{ $pageTitle }} @endsection --}}
@section('content')
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="card col-6">
                                <div class="card-header">
                                    <h3>Submit your query!</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name..." name="name">
                                        <p><span class="text-danger">@error('name'){{$message}}@enderror</span></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email..." name="email">
                                        <p><span class="text-danger">@error('email'){{$message}}@enderror</span></p>
                                    </div>
                                    <div class="form-group">
                                        <select type="text" class="form-control" placeholder="" name="query_catagory">
                                            <option value="">--Select a catagory--</option>
                                            @foreach ($query_catagory_all as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <p><span class="text-danger">@error('query_catagory'){{$message}}@enderror</span></p>
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" placeholder="Write your query..." rows="5" name="query"></textarea>
                                        <p><span class="text-danger">@error('query'){{$message}}@enderror</span></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            <h6 class="my-2 text-muted">Give query related images:</h6>
                                            <input type="file" multiple class="form-control" name="related_images[]">
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button type="submit" class="btn main-btn ml-3">Submit</button>
                                    <a href="{{ url('') }}" class="btn main-btn ml-3">Go to Home</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{session('success')}}
                    {{-- <div class="mt-4 mt-md-5">
                        <!-- <button type="button" class="btn main-btn btn_buseness">BACK TO HOME</button> -->
                        <button type="submit" class="btn main-btn ml-3">Go to Home</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        Swal.fire({
            title: '<h2>Success!</h2><h5>Your Query Submitted Successfully!</h5>',
            html: "<small><b>Ticket Id: </b>{{ session('success') }}<small>",
            icon: 'success',
            confirmButtonText: 'Okay'
        })
    </script> --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: '<h2>Success!</h2><h5>Your Query Submitted Successfully!</h5>',
                html: "<small><b>Ticket Id: </b>{{ session('success') }}<small>",
                icon: 'success',
                confirmButtonText: 'Okay'
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Okay'
            })
        </script>
    @endif
@endpush
