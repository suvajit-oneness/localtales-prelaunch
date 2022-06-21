@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Blog Title</td>
                            <td>{{ empty($blog['title'])? null:$blog['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Blog Slug</td>
                            <td>{{ empty($blog['slug'])? null:$blog['slug'] }}</td>
                        </tr>
                        <tr>
                            <td>Blog Content</td>
                            <td>@php
                                $desc = strip_tags($blog['content']);
                                $length = strlen($desc);
                                if($length>50)
                                {
                                    $desc = substr($desc,0,50)."...";
                                }else{
                                    $desc = substr($desc,0,50);
                                }
                            @endphp
                            {!! $desc !!}</td>
                        </tr>
                        <tr>
                            <td>Blog Category</td>
                            <td>{{$blog->category ? $blog->category->title : '' }}</td>
                        </tr>
                        <tr>
                            <td>Blog Sub Category</td>
                            <td>{{ $blog->subcategory ? $blog->subcategory->title : '' }}</td>
                        </tr>
                        {{-- <tr>
                            <td>Pincode</td>
                            <td>{{$blog->pincode ? $blog->pincode->pin : '' }}</td>
                        </tr> --}}
                        <tr>
                            <td>Suburb</td>
                            <td>{{ $blog->suburb ? $blog->suburb->name : '' }}</td>
                        </tr>
                        <tr>
                            <td>Blog Meta Title</td>
                            <td>{{ empty($blog['meta_title'])? null:$blog['meta_title'] }}</td>
                        </tr>
                        <tr>
                            <td>Blog Meta Key</td>
                            <td>{{ empty($blog['meta_key'])? null:$blog['meta_key'] }}</td>
                        </tr>
                        <tr>
                            <td>Blog Tag</td>
                            <td>{{ empty($blog['tag'])? null:$blog['tag'] }}</td>
                        </tr>
                        <tr>
                            <td>Blog Image</td>
                            <td>@if($blog->image!='')
                                <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/Blogs/'}}{{$blog->image}}">
                                @endif</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! empty($blog['meta_description'])? null:($blog['meta_description']) !!}</td>
                        </tr>

                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.blog.index') }}">Cancel</a>
            </div>


        </div>
    </div>
@endsection
