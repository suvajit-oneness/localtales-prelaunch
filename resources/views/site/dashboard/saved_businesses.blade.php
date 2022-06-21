@extends('site.appprofile')
@section('title') Dashboard @endsection
@section('content')

<div class="row">
    <div class="col-12">
          
          <div class="row">
            @foreach($businesses as $key => $business)
            <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3">
              <div class="card save-grid">
                <div class="position-relative">
                  @if($business->directory->image='')
                  <figure>
                    <div class="category-tag">
                      <!--<img src="{{URL::to('/').'/categories/'}}{{$business->directory->category->image}}">-->
                    
                    </div>
                    <img src="{{URL::to('/').'/businesses/'}}{{$business->directory->image}}" class="card-img-top" alt="">
                      @else
                                    <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" >
                                    
                  </figure>
                  @endif
                  <div class="img-retting">
                    <!-- <ul>
                      <li><img src="./images/event-star.png"> <span>4.5</span> (60 reviews)</li>
                      <li>|</li>
                      <li><i class="far fa-comment-dots"></i> 40 Comments</li>
                    </ul> -->
                  </div>
                </div>
                <div class="card-body event-body">
                  <h5 class="card-title">{{$business->directory->name}}</h5>
                    <p>{{$business->directory->category->title}}</p>
                  <h6><i class="fas fa-map-marker-alt"></i> {{$business->directory->address}}</h6>
                  <p class="card-text">{!!strip_tags(substr($business->directory->description,0,200))!!}...</p>
                  <a href='{!! URL::to('directory-details/'.$business->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->directory->name))) !!}' target="_blank" class="text-dark">View Details</a> | <a href="{{ route('site.dashboard.directory.delete', $business->directory->id) }}" onclick="return confirm('Are you sure that you want to remove this business?')" class="text-danger">Delete</a>
                  
                </div>
              </div>
            </div>
            @endforeach
            
      </div>
    </div>

</div>
@endsection