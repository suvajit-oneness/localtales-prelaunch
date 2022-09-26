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
                            <td>Deal Title</td>
                            <td>{{ empty($deal['title'])? null:$deal['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Deal Image</td>
                            <td>@if($deal->image!='')
                                <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/deals/'}}{{$deal->image}}">
                                @endif</td>
                        </tr>
                        {{-- <tr>
                            <td>Category</td>
                            <td>{{ empty($deal->category['title'])? null:($deal->category['title']) }}</td>
                        </tr> --}}
                        <tr>
                            <td>Address</td>
                            <td>{{ empty($deal['address'])? null:($deal['address']) }}</td>
                        </tr>
                        <tr>
                            <td>Latitude</td>
                            <td>{{ empty($deal['lat'])? null:($deal['lat']) }}</td>
                        </tr>
                        <tr>
                            <td>Longitude</td>
                            <td>{{ empty($deal['lon'])? null:($deal['lon']) }}</td>
                        </tr>
                        <tr>
                            <td>Expiry Date</td>
                            <td>{{ empty($deal['expiry_date'])? null:(date("d-M-Y",strtotime($deal['expiry_date']))) }}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{!! empty($deal['short_description'])? null:($deal['short_description']) !!}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! empty($deal['description'])? null:($deal['description']) !!}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>${{ empty($deal['price'])? null:($deal['price']) }}</td>
                        </tr>
                        <tr>
                            <td>Promo Code</td>
                            <td>{{ empty($deal['promo_code'])? null:($deal['promo_code']) }}</td>
                        </tr>
                        <tr>
                            <td>How To Redeem</td>
                            <td>{!! empty($deal['how_to_redeem'])? null:($deal['how_to_redeem']) !!}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Business Name</td>
                            <td>{{ empty($deal->business['business_name'])? null:($deal->business['business_name']) }}</td>
                        </tr>
                        <tr>
                            <td>Owner Name</td>
                            <td>{{ empty($deal->business['name'])? null:($deal->business['name']) }}</td>
                        </tr>
                        <tr>
                            <td>Email Id</td>
                            <td>{{ empty($deal->business['email'])? null:($deal->business['email']) }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ empty($deal->business['mobile'])? null:($deal->business['mobile']) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
