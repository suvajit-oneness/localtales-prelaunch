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
        <div class="col-md-6 mx-auto">
            <table class="table table-hover custom-data-table-style table-striped" id="collectionDirectorydetails">
                <thead>
                    <tr>
                        <th></th>
                        <th>SR No</th>
                        <th> Name </th>
                    </tr>
                </thead>
                <tbody>
                   {{--   @foreach($directory as $key => $blog)
                        <tr>
                        <td>
                        <input  class="tap-to-delete" type="checkbox"  value="{{$blog->id}}" name="directory_id[]" checked>
                         </td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $blog->name }}</td>
                            <td>
                            {{ $blog->address }}</td>
                            <td>{{$blog->category_tree ? $blog->category_tree : '' }}</td>
                        </tr>
                    @endforeach--}}
                </tbody>
            </table>
        </div>
        <div class="col-md-6 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
                </h3>
                <hr>
                <form action="{{ route('admin.collectiondir.update') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $targetdirectory->id }}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="pin"> Collection <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="collection_id">
                                <option value="">Select Collection...</option>
                                @foreach ($col as $index => $item)
                                    <option value="{{ $item->id }}"
                                        {{ $targetdirectory->collection_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('collection_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="directory_id" id="directory_id"
                        value="{{ $targetdirectory->directory_id }}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"> Directory <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input type="search" class="form-control dropdown-toggle" id="searchName"
                                value="{{ $targetdirectory->directory->name }}" placeholder="Search Directory name"
                                data-toggle="dropdown">
                            <div class="respDrop" style="position: relative;"></div>
                            @error('directory_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Collection</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.collection.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#btnFilter", function() {
            $('#checkout-form').submit();
        });
    </script>
    <script>
        // state, suburb, postcode data fetch
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('admin/collectiondirectory') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('input').html(data);
                }
            });
        })
    </script>
    <script>
        // store name search
        $('#searchName').on('keyup', function() {
            var $this = '#searchName'

            if ($($this).val().length > 0) {
                $.ajax({
                    url: '{{ route('directory.search') }}',
                    method: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        name: $($this).val(),

                    },
                    success: function(result) {
                        var content = '';
                        if (result.error === false) {
                            content +=
                                `<div class="dropdown-menu show w-100 postcode-dropdown" style="position: absolute; top: 0px;" aria-labelledby="dropdownMenuButton">`;

                            $.each(result.data, (key, value) => {
                                console.log(value.id);
                                content +=
                                    `<a class="dropdown-item" href="javascript:void(0)" onClick="setDirectory('${value.id}','${value.name}')">${value.name}</a>`;
                            })
                            content += `</div>`;
                        } else {
                            content +=
                                `<div class="dropdown-menu show w-100 postcode-dropdown" aria-labelledby="dropdownMenuButton"><li class="dropdown-item">${result.message}</li></div>`;
                        }
                        $('.respDrop').html(content);
                    }
                });
            } else {
                $('.respDrop').text('');
            }
        });

        function setDirectory(x, y) {
            $('#searchName').val(y);
            $('#directory_id').val(x);
            $('.respDrop').empty();
        }
    </script>
@endpush
