<?php

use App\Models\ArticleFaq;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Directory;
use App\Models\PinCode;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\Suburb;
use App\Models\User;

if (!function_exists('sidebar_open')) {
    function sidebar_open($routes = []) {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

    return $open ? 'active' : '';
    }
}

if (!function_exists('imageResizeAndSave')) {
    function imageResizeAndSave($imageUrl, $type = 'categories', $filename)
    {
        if (!empty($imageUrl)) {
                                                    
            //save 60x60 image
            \Storage::disk('public')->makeDirectory($type.'/60x60');
            $path60X60     = storage_path('app/public/'.$type.'/60x60/'.$filename);
            $canvas = \Image::canvas(60, 60);
            $image = \Image::make($imageUrl)->resize(60, 60,
                    function($constraint) {
                        $constraint->aspectRatio();
                    });
            $canvas->insert($image, 'center');
            $canvas->save($path60X60, 70); 
            
            //save 350X350 image
            \Storage::disk('public')->makeDirectory($type.'/350x350');
            $path350X350     = storage_path('app/public/'.$type.'/350x350/'.$filename);
            $canvas = \Image::canvas(350, 350);        
            $image = \Image::make($imageUrl)->resize(350, 350,
                    function($constraint) {
                        $constraint->aspectRatio();
                    });
            $canvas->insert($image, 'center');
            $canvas->save($path350X350, 75);

            return $filename;
        } else { return false; }
    }
}

if(!function_exists('directoryRatingHtml')) {
    function directoryRatingHtml($rating = null) {
        if ($rating == 0) {
            $resp = '<p>No ratings available</p>';
        } elseif ($rating == 1) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Rating</small>
            </p>
            ';
        } elseif ($rating > 1 && $rating < 2) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fas fa-star-half-alt" style="color:#FFA701"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating == 2) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating > 2 && $rating < 3) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fas fa-star-half-alt" style="color:#FFA701"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating == 3) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating > 3 && $rating < 4) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star-half-alt" style="color:#FFA701"></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating == 4) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating > 4 && $rating < 5) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star-half-alt" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } else {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        }

        return $resp;
    }
}

function CountUsers(){
    return User::where('status','1')->count();
}

function CountState(){
    return State::count();
}
function CountSuburb()
{
    return Suburb::count();
}
function CountPostcode()
{
    return PinCode::count();
}
function CountDirectory()
{
    return Directory::count();
}
function CountCollection()
{
    return Collection::count();
}
function CountCategory()
{
    return Category::count();
}
function CountSubCategory()
{
    return SubCategory::count();
}
function CountArticles()
{
    return ArticleFaq::count();
}

if(!function_exists('directoryCategory')){
    function directoryCategory($category_id) {
        if(!empty($category_id)) {
            $cat = substr($category_id, 0, -1);
            $displayCategoryName = '';
            foreach(explode(',', $cat) as $catKey => $catVal) {
                $catDetails = \App\Models\DirectoryCategory::where('id', $catVal)->where('status', 1)->first();

                if(!empty($catDetails->child_category)) {
                    $displayCategoryName .= '<a class="" href="'.URL::to('category/'.$catDetails->child_category_slug).'">'.$catDetails->child_category.'</a>, ';
                } else {
                    $displayCategoryName .= '<a class="" href="'.URL::to('category/'.$catDetails->slug).'">'.$catDetails->title.'</a>, ';
                }
            }
            $displayCategoryName = substr($displayCategoryName, 0, -2);
            return $displayCategoryName;
        } else {
            return false;
        }
    }
}

if(!function_exists('in_array_r')) {
    function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
}







