@extends('site.app')
@section('title') {{ $pageTitle }} @endsection

@section('content')
    {{-- BLOG SEARCH --}}
    <section class="inner_banner">
        <div class="container position-relative text-center">
            <h1>Category </h1>
           
        </div>
    </section>

    {{-- BLOG SEARCH RESULT --}}
      <section class="py-4 py-lg-5">
        <div class="container">
            <!-- <div class="row m-0 mb-4 justify-content-center">
                <div class="page_title text-center">
                    <h2 class="mb-2">Category</h2>
                    <p></p>
                </div>
            </div> -->
            <div class="row justify-content-center">
                {{-- <div class="swiper-wrapper"> --}}
                    @foreach($cat as  $key => $blog)
                    {{-- dd{{ $suburb }} --}}
                    <div class="col-md-4 mb-4">
                        <div class="smplace_card text-center">
                          <h4><a href="{!! URL::to('category/'.$blog->id) !!}" class="location_btn">{{$blog->title}} </a></h4>
                          <p>{{$blog->description}}</p>
                        </div>
                      </div>
                      @endforeach




                {{-- </div> --}}
                <!--<div class="pagination_swip">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>-->
            </div>
             <div class="d-flex justify-content-center mt-4">
                    {{ $cat->links() }}
                </div>
        </div>
    </section>

   
@endsection

@push('scripts')
<script type="text/javascript">


    // $(document).ready(function(){
    // 	$('#btnFilter').on("click",function(){
    // 		$('#checskout-form').submit();
    // 	})
    // });

    $(document).on("click", "#btnFilter", function() {
        $('#checkout-form').submit();
    });
</script>
@endpush
