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
                <h3 class="tile-title">{{ $subTitle }}
                    <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Directory</button>
                        <a class="btn btn-secondary" href="{{ route('admin.collectiondir.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.collectiondir.store') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    @php
                        if (!empty(request()->input('collection'))) {
                            $cid = request()->input('collection');
                            $data = App\Models\CollectionDirectory::where('collection_id', $cid)
                                ->with('directory')
                                ->get();
                        } else {
                            $data = 'new';
                            $cid ='';
                        }
                    @endphp

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="pin"> Collection <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="collection_id">
                                <option value="">Select Collection...</option>
                                @foreach ($col as $index => $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $cid ? 'selected' : '' }}>
                                        {{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('collection_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="directory_id" id="directory_id" value="">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"> Directory <span class="m-l-5 text-danger">
                                    *</span></label>
                            <div id="show_checkboxes" class="row">
                                @if ($data != 'new')
                                    @foreach ($data as $value)
                                        <label id="directory_{{ $value->directory_id }}" class="d-flex m-3"
                                            style="flex-direction: row-reverse; align-items: center;">{{ $value->directory->name }}<input
                                                checked type="checkbox" name="directory_id[]"
                                                onClick="removeCheckbox('{{ $value->directory_id }}')"
                                                value="{{ $value->directory_id }}"></label>
                                    @endforeach
                                @endif
                            </div>
                            <input type="search" class="form-control dropdown-toggle" id="searchName" value=""
                                placeholder="Search Directory name" data-toggle="dropdown">
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
                        <a class="btn btn-secondary" href="{{ route('admin.collectiondir.index') }}"><i
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
                                `<div class="dropdown-menu row show w-100 postcode-dropdown" style="display: flex; position: absolute; top: 0px;" aria-labelledby="dropdownMenuButton">`;

                            $.each(result.data, (key, value) => {
                                if ($('#directory_' + value.id).length > 0) {
                                    content +=
                                        `<label class="d-flex m-3" style="flex-direction: row-reverse; align-items: center;">${value.name}<input onClick="setDirectory('${value.name}','${value.id}', this)" type="checkbox" checked value="${value.id}"></label>`
                                } else {
                                    content +=
                                        `<label class="d-flex m-3" style="flex-direction: row-reverse; align-items: center;">${value.name}<input onClick="setDirectory('${value.name}','${value.id}', this)" type="checkbox" value="${value.id}"></label>`
                                }
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

        function setDirectory(x, y, z) {
            if (z.checked == true) {
                if ($('#directory_' + y).length <= 0) {
                    $('#show_checkboxes').append(
                        `<label id="directory_${y}" class="d-flex m-3" style="flex-direction: row-reverse; align-items: center;">${x}<input checked type="checkbox" name="directory_id[]" onClick="removeCheckbox('${y}')" value="${y}"></label>`
                    )
                } else {
                    console.log('Hello');
                    $('#directory_' + y).remove();
                }
            } else {
                $('#directory_' + y).remove();
            }
            $('#searchName').val('');
            $('.respDrop').html('');
            $('#searchName').focus();
        }

        function removeCheckbox(x) {
            $('#directory_' + x).remove();
        }
    </script>
@endpush
