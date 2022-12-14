<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\OrderProduct;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\ShippingCharge;
use App\Models\DeliveryAddress;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Currencie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * product listin page category wise
     * product filter combindly
     */
    public function ProductListing(Request $request){

        // pagnation method
        Paginator::useBootstrap();
        
        // filtering system by ajax
        if($request -> ajax()){
            // echo '<pre>'; print_r($request -> all()); die;

            $data = $request -> all();
            $url = $data['url'];

            $catCount = Category::where(['url' => $url, 'status' => 1]) -> count();
            // breadchumb
            $searchUrl = Category::where(['url' => $url, 'status' => 1]) -> first();
            // echo '<pre>'; print_r($catCount); die;
            if($catCount > 0){
                $categoryDetails = Category::catDetails($url);

                // echo '<pre>'; print_r($categoryDetails); die;

                // get data without loop
                $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> paginate(6);
                // dd($catWiseProduct) -> toArray(); die;
                // echo '<pre>'; print_r($catWiseProduct); die;

                // breadcum define
                $breadcum = Category::find($searchUrl -> parent_id);

                // product filtering by ajax if fabric option is checked
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> paginate(6);

                    // if(isset($data['sort']) && !empty($data['sort'])){
                    //     {{ echo "fabric2/";}}
                    //     if($data['sort'] == 'highest_price'){
                    //         $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> paginate(6);
    
                    //     }
                    // }elseif($data['sort'] == 'highest_price'){
                    //     $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> paginate(6);


                    //     // $catWiseProduct->orderBy('id', 'Desc') -> get();

                    // }elseif($data['sort'] == 'lower_price'){
                    //     $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> paginate(6);


                    // }elseif($data['sort'] == 'product_z_a'){
                    //     $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> paginate(6);


                    // }elseif($data['sort'] == 'product_a_z'){
                    //     $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> paginate(6);

                    
                    // }


                }

                // if sleeve or fabric both are selected
                if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                }
                if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                }

                // if sleeve or fabric or fit both are selected
                if(isset($data['fit']) && !empty($data['fit'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                }
                
                if(isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                }
                if(isset($data['sleeve']) && !empty($data['sleeve'])  && isset($data['fit']) && !empty($data['fit'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                }

                if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                    // {{ echo "fit3/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                }


                // product filtering by ajax if sort option is seleted
                if(isset($data['sort']) && !empty($data['sort'])){
                    {{ echo "sort1/";}}
                    if($data['sort'] == 'latest_product'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> paginate(6);


                        // ================ sleeve or fabric ==============
                        if(isset($data['fabric']) && !empty($data['fabric'])){
                            // $catWiseProduct -> whereIn('products.fabric', $data['fabric']);
        
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> get();
        
                        }

                        // ================ sleeve or fabric ==============
                        // if sleeve or fabric both are selected
                        if(isset($data['sleeve']) && !empty($data['sleeve'])){
                            // {{ echo "sleeve1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> get();
                            
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric'])){
                            // {{ echo "sleeve2/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> get();
                            
                        }

                        // ================ sleeve or fabric or fit ==============
                        // if sleeve or fabric or fit both are selected
                        if(isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> get();
                        }
                        
                        if(isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> get();
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve'])  && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC')  -> get();
                        }

                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fit3/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('id', 'DESC') -> get();
                        }

                        
                        // $catWiseProduct->orderBy('products.id', 'Desc') -> get();

                    }elseif($data['sort'] == 'highest_price'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> paginate(6);

                        // ================ fabric  ==============
                        if(isset($data['fabric']) && !empty($data['fabric'])){
                            // $catWiseProduct -> whereIn('products.fabric', $data['fabric']);
                            {{ echo "sort2/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> get();
        
                        }

                        // ================ sleeve or fabric==============
                        // if sleeve or fabric both are selected
                        if(isset($data['sleeve']) && !empty($data['sleeve'])){
                            // {{ echo "sleeve1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> get();
                            
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric'])){
                            // {{ echo "sleeve2/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> get();
                            
                        }


                        // ================ sleeve or fabric or fit ==============
                        // if sleeve or fabric or fit both are selected
                        if(isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> get();
                        }
                        
                        if(isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> get();
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve'])  && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC')  -> get();
                        }

                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fit3/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'DESC') -> get();
                        }


                        // $catWiseProduct->orderBy('id', 'Desc') -> get();

                    }elseif($data['sort'] == 'lower_price'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> paginate(6);


                        // ================ fabric ==============
                        if(isset($data['fabric']) && !empty($data['fabric'])){
                            // $catWiseProduct -> whereIn('products.fabric', $data['fabric']);
        
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> get();
        
                        }

                        // ================ sleeve or fabriceve ==============
                        // if sleeve or fabric both are selected
                        if(isset($data['sleeve']) && !empty($data['sleeve'])){
                            // {{ echo "sleeve1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> get();
                            
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric'])){
                            // {{ echo "sleeve2/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> get();
                            
                        }


                        // ================ sleeve or fabric or fit ==============
                        // if sleeve or fabric or fit both are selected
                        if(isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> get();
                        }
                        
                        if(isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> get();
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve'])  && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC')  -> get();
                        }

                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fit3/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> get();
                        }


                    }elseif($data['sort'] == 'product_z_a'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_price', 'ASC') -> paginate(6);

                        // ================ fabric==============
                        if(isset($data['fabric']) && !empty($data['fabric'])){
                            // $catWiseProduct -> whereIn('products.fabric', $data['fabric']);
        
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> get();
        
                        }

                        // ================ sleeve or fabric==============
                        // if sleeve or fabric both are selected
                        if(isset($data['sleeve']) && !empty($data['sleeve'])){
                            // {{ echo "sleeve1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> get();
                            
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric'])){
                            // {{ echo "sleeve2/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> get();
                            
                        }

                        // ================ sleeve or fabric or fit ==============
                        // if sleeve or fabric or fit both are selected
                        if(isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> get();
                        }
                        
                        if(isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> get();
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve'])  && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC')  -> get();
                        }

                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fit3/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'DESC') -> get();
                        }



                    }elseif($data['sort'] == 'product_a_z'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> paginate(6);

                        // ================ fabric==============
                        if(isset($data['fabric']) && !empty($data['fabric'])){
                            // $catWiseProduct -> whereIn('products.fabric', $data['fabric']);
        
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> get();
        
                        }

                        // ================ sleeve or fabric ==============
                        // if sleeve or fabric both are selected
                        if(isset($data['sleeve']) && !empty($data['sleeve'])){
                            // {{ echo "sleeve1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> get();
                            
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric'])){
                            // {{ echo "sleeve2/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> get();
                            
                        }

                        // ================ sleeve or fabric or fit ==============
                        // if sleeve or fabric or fit both are selected
                        if(isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> get();
                        }
                        
                        if(isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('fit', $data['fit']) -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> get();
                        }
                        if(isset($data['sleeve']) && !empty($data['sleeve'])  && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fabric1/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC')  -> get();
                        }

                        if(isset($data['sleeve']) && !empty($data['sleeve']) && isset($data['fabric']) && !empty($data['fabric']) && isset($data['fit']) && !empty($data['fit'])){
                            // {{ echo "fit3/";}}
                            $catWiseProduct = Product::with('getBrand') -> whereIn('sleeve', $data['sleeve']) -> whereIn('fabric', $data['fabric']) -> whereIn('fit', $data['fit']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> orderBy('product_name', 'ASC') -> get();
                        }

                    }
                }

                $catDetails = $categoryDetails['catDetails'];

                // seo items & page title change
                $meta_title = $categoryDetails['catDetails']['meta_title'];
                $meta_description = $categoryDetails['catDetails']['meta_description'];
                $meta_keywords = $categoryDetails['catDetails']['meta_keyword'];

                return view('frontend.product.ajax_product_listing', compact('catWiseProduct', 'breadcum', 'catDetails', 'meta_title', 'meta_description', 'meta_keywords'));
            }else{
                abort(404);
            }
            
        }else{
            //filtergin system by php

            // get uri
            $url = Route::getFacadeRoot() -> current() -> uri();

            $catCount = Category::where(['url' => $url, 'status' => 1]) -> count();
            $searchUrl = Category::where(['url' => $url, 'status' => 1]) -> first();

            // search product
            if(@$_REQUEST['search'] && !empty($_REQUEST['search'])){
                $serch_product = $_REQUEST['search'];
                $catDetails['category_name'] = $serch_product;
                $catDetails['description'] = 'Result for Search '.$serch_product;
                $catWiseProduct = Product::with('getBrand') -> where(function($query)use($serch_product){
                    $query -> where('product_name', 'LIKE', '%'.$serch_product.'%') -> orWhere('product_code', 'LIKE', '%'.$serch_product.'%'); 
                }) -> where('status', 1);

                $catWiseProduct = $catWiseProduct -> get();

                // product fabric filter option
                $page_name = 'list';

                return view('frontend.product.product_list', compact('catWiseProduct', 'catDetails', 'page_name'));

            }else if($catCount > 0){
                $catDetails = Category::select('id', 'category_name', 'url', 'description', 'parent_id') -> with('subcategories', function($query){
                    $query -> select('id', 'parent_id', 'description', 'category_name', 'parent_id') -> where('status', 1);
                }) -> where(['url' => $url]) -> first() -> toArray();

                // cat or subcat all Ids array
                $catIds = [$catDetails['id']];

                foreach($catDetails['subcategories'] as $key => $item){
                    // $catIds = $item['id'];
                    array_push($catIds, $item['id']);
                }

                // breadcum define
                $breadcum = Category::find($searchUrl -> parent_id);

                // get data with loop
                // foreach($catIds as $key => $item){
                //     $catWiseProduct = Product::where('category_id', $item) -> where('status', 1) -> get();
                // }

                // get data without loop
                $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> paginate(6);

                // product fabric filter option
                $page_name = 'list';

                // all static filter item from product model
                $allFilters = Product::getAllFilters();

                // seo items & page title change
                $meta_title = $catDetails['category_name'];

                return view('frontend.product.product_list', compact('catWiseProduct', 'catDetails', 'breadcum', 'page_name', 'meta_title'), $allFilters);

            }else{
                abort(404);
            }
        }


    }



    // product details page show
    public function ProductDetailsPage($id){
        $productDetails = Product::find($id);
        $productGalleris = ProductGallery::where('product_id', $id) -> where('status', 1) -> get() -> pluck('images');
        $totalStock = ProductAttribute::where('product_id', $id) -> sum('stock');

        // all currencie
        $all_currencie = Currencie::where('status', 1) -> get() -> toArray();

        // get all rating data
        $ratings = Rating::with('getUser') -> where('status', 1) -> where('product_id', $id) -> orderBy('id', 'desc') -> get() -> toArray();
            // dd($ratings); die;

        // get average rating
        $ratingCount = Rating::where('status', 1) -> where('product_id', $id) -> count();
        $ratingSum = Rating::where('status', 1) -> where('product_id', $id) -> sum('rating');
        if(@$ratingCount > 0){
            $averageRating = $ratingSum / $ratingCount;
        }else {
            $averageRating = 0;
        }
        // dd($averageRating); die;
        


        // group code
        $groupCode = [];
        if(@$productDetails -> group_code){
            $groupCode = Product::select('id', 'main_image') -> where('group_code', $productDetails -> group_code) -> where('id', '!=', $id) -> where('status', 1) -> get() -> toArray(); 
        }
        // dd($groupCode); die;

        $relatedProduct = Product::where('category_id', $productDetails -> category_id) -> where('id', '!=', $id) -> limit(3) -> inRandomOrder() -> get();
        // echo '<pre>'; print_r($relatedProduct); die;
        // dd($relatedProduct);

        // seo items & page title change
        $meta_title = $productDetails['product_name'];

        return view('frontend.product.product_details', compact('productDetails', 'productGalleris', 'totalStock', 'relatedProduct', 'groupCode', 'meta_title', 'all_currencie', 'ratings', 'averageRating', 'ratingCount'));
    }


    /**
     *  get price based on product size
     */
    public function ProductWiseGetPrice(Request $request){

        if($request -> ajax()){

            // $getPrice = ProductAttribute::where('product_id', $request -> product_id) -> where('size', $request -> size) -> first();

            $getDiscount = Product::getAttrDiscountPrice($request -> product_id, $request -> size);
            // all currencie
            $all_currencie = Currencie::where('status', 1) -> get() -> toArray();
            $currencie = '';
            foreach($all_currencie as $item){
                $currencie .= '<span>';
                $currencie .= $item['currnecie_code'];
                $currencie .= round($getDiscount['attrPrice'] -> price / $item['currnecie_rate'], 2);
                $currencie .= '</span>';
            }
            
            // dd($getPrice);
            return [
                "currencie"     => $currencie,
                "getDiscount"   => $getDiscount,
            ];
        }

    }

    // add to cart
    public function AddToCart(Request $request){

        if($request -> isMethod('post')){

            // validaiton
            $this -> validate($request, [
                'size'      => 'required',
                'quantity'  => 'required'
            ]);

            // validation
            if($request -> quantity == 0){
                $productQuantity = 1;
            }else {
                $productQuantity = $request -> quantity;
            }

            // get product stock
            $getStock = ProductAttribute::where('product_id', $request -> product_id) ->        
            where('size', $request -> size) -> first();

            // stock validation 
            if($getStock -> stock < $productQuantity){
                // msg  
                $notify = [
                    'message'       => 'Quantity is not available',
                    'alert-type'    => "warning"
                ];

                return redirect() -> back() -> with($notify);
            }

            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // check wheather auth is logged in or not
            if(Auth::check()){
                // user is logged in
                $countProduct = Cart::where(['product_id' => $request -> product_id, 'size' =>      
                $request -> size, 'user_id' => Auth::user() -> id]) -> count();
            }else{
                // user is not logged in
                $countProduct = Cart::where(['product_id' => $request -> product_id, 'size' => 
                $request -> size, 'session_id' => Session::get('session_id')]) -> count();
            }

            // if same size already exists
            if($countProduct > 0){
                // msg  
                $notify = [
                    'message'       => 'Product already exists',
                    'alert-type'    => "error"
                ];

                return redirect() -> back() -> with($notify);
            }

            // store product
            Cart::insert([
                'session_id'        => $session_id,
                'product_id'        => $request -> product_id,
                'user_id'           => Auth::user() -> id ?? 0,
                'size'              => $request -> size,
                'quantity'          => $productQuantity,
            ]);


            // msg  
            $notify = [
                'message'       => 'Product added succesfully',
                'alert-type'    => "success"
            ];

            return redirect() -> to('/cart') -> with($notify);

        }
    }


    // cart page view
    public function CartPage(){
        $userCartItems = Cart::userCartItems();
        // echo '<pre>'; print_r($userCartItems); die;

        // seo items & page title change
        $meta_title = 'Cart';
        return view('frontend.product.cart_view', compact('userCartItems', 'meta_title'));
    }


    // cart item increment or decrement
    public function CartItemUpdateByAjax(Request $request){

        // get all cart items
        $userCartItems = Cart::userCartItems();
        $totalCartItem = totalCartItem();

        // stock checking
        $cartDetails = Cart::find($request -> cartId);
        $stockLimit = ProductAttribute::where('product_id', $cartDetails -> product_id) -> where('size', $cartDetails -> size) -> first() -> toArray();
        // dd($stockLimit);
        // return $cartDetails -> size; die;

        // stock validation
        if($stockLimit['stock'] < $request -> new_qty){
            return response() -> json([
                'status'        => false
            ]);
        }


        // Size stock checking
        if($stockLimit['size'] != $cartDetails -> size){
            return response() -> json([
                'status'        => false
            ]);
        }


        // quantity update
        if($request -> ajax()){
            $update = Cart::find($request -> cartId);
            $update -> quantity = $request -> new_qty;
            $update -> update();
        }

        // full page will reload the data again by ajax
        return response() -> json([
            'totalCartItem'   => $totalCartItem,
            'view' => (String)View::make('frontend.product.append_cart_item') -> with(compact('userCartItems'))
            
        ]);
    }



    // cart item delete
    public function CartItemDeleteByAjax(Request $request){
        
        // data delete
        Cart::find($request -> cart_id) -> delete();

        // get all cart items
        $userCartItems = Cart::userCartItems();
        $totalCartItem = totalCartItem();

        // full page will reload the data again by ajax
        return response() -> json([
            'totalCartItem'     => $totalCartItem,
            'view' => (String)View::make('frontend.product.append_cart_item') -> with(compact('userCartItems'))
        ]);

    }


    // delivery address add or edit
    public function DeliveryAddressAddEdit($id=null, Request $request){

        if($id == ''){
            // add delivery address
            $title = 'Add Delivery Address';
            $address = new DeliveryAddress();
            $message = "Delivery Address Added";
        }else {
            // edit delivery address
            $title = 'Edit Delivery Address';
            $address = DeliveryAddress::find($id);
            $message = "Delivery Address Updated";
        }


        if($request -> isMethod('post')){

            // validation 
            $this -> validate($request, [
                'name'      => 'required',
                'phone'     => 'required', 
                'address'   => 'required',
                'city'      => 'required',
                'country'   => 'required',
                'pincode'   => 'required',
            ]);

            // contact details updated
            $address -> name         = $request -> name;
            $address -> user_id      = Auth::id();
            $address -> phone        = $request -> phone;
            $address -> email        = Auth::user() -> email;
            $address -> country      = $request -> country;
            $address -> city         = $request -> city;
            $address -> address      = $request -> address;
            $address -> pincode      = $request -> pincode;
            $address -> save();


            // msg
            $notify = [
                'message'       => $message,
                'alert-type'    => "success"
            ];

            return redirect() -> to('/user/checkout') -> with($notify);

        }

        $country = Country::where('status', 1) -> get();
        return view('frontend.deliveryAddress.address_add_edit',[
            'title'             => $title, 
            'country'           => $country, 
            'edit_data'       => $address, 
        ]);

    }


    // delivery address delete
    public function DeliveryAddressDelete($id){

        DeliveryAddress::find($id) -> delete();

        // msg
        $notify = [
            'message'       => 'Delivery Address Delete',
            'alert-type'    => "success"
        ];

        return redirect() -> back() -> with($notify);

    }

    
    /**
     *  check out page all function
     */

    // checkout page view
    public function CheckoutView(Request $request){

        $userCartItems = Cart::userCartItems();
        $deliveryAddress = DeliveryAddress::getDeliveryAddress();

        // total price 
        $totalAmount = 0;
        $product_weight = 0;
        $total_tax = 0;
        foreach($userCartItems as $item){
            $discount = Product::getAttrDiscountPrice($item['product_id'], $item['size']);
            $totalAmount = $totalAmount + ($discount['attrDiscountPrice'] * $item['quantity']); 
            $product_weight = $product_weight + ($item['get_product']['product_weight'] * 
            $item['quantity']);

            $product_total_price = $discount['attrDiscountPrice'] * $item['quantity'];
            $getTaxPercentage =Product::select('tax') -> where('id', $item['product_id']) ->first();
            $taxPercent = $getTaxPercentage -> tax;

            $taxAmount = round($product_total_price * $taxPercent/100, 2);
            $total_tax = $total_tax + $taxAmount;
            // dd($taxAmount);  die;
        }
        // dd($product_weight);  die;


        // Minimun cart amount validation
        if($totalAmount<500){
            // message
            $notify = [
                'message'       => 'Minimun Amount Shoud Be $500',
                'alert-type'    => "warning"
            ];
            return redirect() -> back()  -> with($notify);
        }

        // Maximum cart amount validation
        if($totalAmount > 50000){
            // message
            $notify = [
                'message'       => 'Maximum Amount Shoud Be $50000',
                'alert-type'    => "warning"
            ];
            return redirect() -> back()  -> with($notify);
        }

        if($request -> isMethod('post')){
            // dd(Session::get('grand_total'));
            // dd($userCartItems) -> toArray(); die;

            // Prevent disabled product to order
            foreach($userCartItems as $key => $item){
                // get product
                $productStatus = Product::getProductStatus($item['product_id']);
                // print_r($productStatus); 

                // inactive product delete from cart
                if($productStatus == false){
                    Product::deleteCartProduct($item['product_id']);

                    // message
                    $notify = [
                        'message'       => 'This '. $item['get_product']['product_name'] .' Product is not available',
                        'alert-type'    => "warning"
                    ];
                    return redirect() -> to('/cart')  -> with($notify);
                }

                // prevent to order out of stock product
                $productStock = Product::getProductStockCheck($item['product_id'], $item['size']);
                if($productStock == 0){
                    
                    // delete cart product
                    Product::deleteCartProduct($item['product_id']);

                    // message
                    $notify = [
                        'message'       => 'This '. $item['get_product']['product_name'] .' Product is Out Of Stock',
                        'alert-type'    => "error"
                    ];
                    return redirect() -> to('/cart') -> with($notify);
                }

                 // checking product attribute status
                 $getAttributeCount = Product::getAttributeCount($item['product_id'], $item['size']);
                 if($getAttributeCount == 0){
 
                     // message
                     $notify = [
                         'message'       => 'This '. $item['get_product']['product_name'] .' Product is not available. Please Remove form the cart',
                         'alert-type'    => "warning"
                     ];
                     return redirect() -> to('/cart') -> with($notify);
                 }


                // checking product category status
                $getCategoryStatus = Product::getCategoryStatus($item['get_product']['category_id'] );
                if($getCategoryStatus == 0){

                    // message
                    $notify = [
                        'message'       => 'This '. $item['get_product']['product_name'] .' Product is not available. Please Remove form the cart',
                        'alert-type'    => "warning"
                    ];
                    return redirect() -> to('/cart') -> with($notify);
                }
                
            }


            // validation
            if(empty($request -> address_id)){
                // message
                $notify = [
                    'message'       => 'Delivery Address is empty',
                    'alert-type'    => "error"
                ];

                return redirect() -> back() -> with($notify);
            }
            
            // payment method checking
            if(empty($request -> payment_gateway)){
                // message
                $notify = [
                    'message'       => 'Payment Method is required',
                    'alert-type'    => "error"
                ];

                return redirect() -> back() -> with($notify);
            }

            // payment method checking
            if($request -> payment_gateway == 'COD'){
                $payment_method = 'COD';
            }else {
                $payment_method = 'Prepaid';
            }

            // get delivery address form address_id
            $deliveryAddress = DeliveryAddress::where('id', $request -> address_id) -> first() -> toArray();

            // shipping charge
            $ShippingCharge = ShippingCharge::getShippingCharge($product_weight, $deliveryAddress['country']);
           
            // calculate total price with shipping charge
            $grand_total = $totalAmount + $ShippingCharge + $total_tax - Session::get('couponAmount');
            Session::put('grand_total', $grand_total);

            // if there has some isssu, then both tables will be empty.
            DB::beginTransaction();

            // store data to ordre table
            $order = new Order();
            $order -> user_id       = Auth::id();
            $order -> name          = $deliveryAddress['name'];
            $order -> address       = $deliveryAddress['address'];
            $order -> city          = $deliveryAddress['city'];
            $order -> country       = $deliveryAddress['country'];
            $order -> phone         = $deliveryAddress['phone'];
            $order -> pincode       = $deliveryAddress['pincode'];
            $order -> email         = $deliveryAddress['email'];
            $order -> courier_name  = "None";
            $order -> traking_number = 'None';

            $order -> shipping_charge   = $ShippingCharge;
            $order -> tax               = $total_tax;
            $order -> coupon_code       = Session::get('couponCode') ?? null;
            $order -> coupon_amount     = Session::get('couponAmount') ?? 00;
            $order -> order_status      = "New";
            $order -> payment_method    = $payment_method;
            $order -> grand_total       = Session::get('grand_total');
            $order -> save();


            // get last order inserted id instantly
            $order_id = DB::getPdo() -> lastInsertId();
            // order id put in session
            Session::put('order_id', $order_id);

            // get the all cart item
            $cartItem = Cart::where('user_id', Auth::id()) -> get() -> toArray();
            foreach($cartItem as $item ){

                // insert data to orderProduct table
                $orderProduct = new OrderProduct();
                $orderProduct -> user_id = $item['user_id'];
                $orderProduct -> order_id = $order_id;
                $orderProduct -> product_id = $item['product_id'];
                $orderProduct -> product_size = $item['size'];
                $orderProduct -> product_qty = $item['quantity'];

                // get product details
                $getProductDetails = Product::select('product_code', 'product_color', 'product_name') -> where('id', $item['product_id']) -> first() -> toArray();

                $orderProduct -> product_code = $getProductDetails['product_code'];
                $orderProduct -> product_color = $getProductDetails['product_color'];
                $orderProduct -> product_name = $getProductDetails['product_name'];

                // get cart item price after discount
                $getDiscountAttrPrice = Product::getAttrDiscountPrice($item['product_id'], $item['size']); 

                $orderProduct -> product_price = $getDiscountAttrPrice['attrDiscountPrice'];
                $orderProduct -> save();


                // product stock reduce after order
                if($request -> payment_gateway == 'COD'){
                    $getStock = ProductAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']]) -> first() -> toArray();
                    $newStock = $getStock['stock'] - $item['quantity'];

                    // new stock update
                    ProductAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']]) -> update(['stock' => $newStock]);
                }


                // if there has some isssu, then both tables will be empty.
                DB::commit();
                
            }

            // redirect to payment page
            if($request -> payment_gateway == 'COD'){

                // send mail
                $orderDetails = Order::with('order_product') -> where('id', $order_id) -> first() -> toArray();
                $userDetails = User::where('id', $orderDetails['user_id']) -> first() -> toArray();

                $email = Auth::user() -> email;
                $messageData = [
                    'name'      => Auth::user() -> name,
                    'email'      => $email,
                    'order_id'      => $order_id,
                    'userDetails'      => $userDetails,
                    'orderDetails'      => $orderDetails
                ];

                // Mail::send('frontend.email.order', $messageData, function($msg) use($email) {
                //     $msg -> to($email) -> subject('Order Placed');
                // });

                // message
                $notify = [
                    'message'       => "Order has been placed successfully",
                    'alert-type'    => "success"
                ];

                return redirect() -> route('thanks') -> with($notify);
            }else if($request -> payment_gateway == 'PAYPAL'){

                // message
                $notify = [
                    'message'       => "Order has been placed successfully",
                    'alert-type'    => "success"
                ];
                
                return redirect() -> route('paypal.thanks') -> with($notify);


            }

        }

        // user or deliver data
        $userCartItems = Cart::userCartItems();
        $deliveryAddress = DeliveryAddress::getDeliveryAddress();

        // dd($userCartItems) -> toArray(); die;

        // total price 
        $totalAmount = 0;
        $product_weight = 0;
        foreach($userCartItems as $item){
            // print_r($item); die;
            $discount = Product::getAttrDiscountPrice($item['product_id'], $item['size']);
            $totalAmount = $totalAmount + ($discount['attrDiscountPrice'] * $item['quantity']); 
            $product_weight = $product_weight + ($item['get_product']['product_weight'] * $item['quantity']);

            // echo $product_weight; die;
        }

          
        // shipping charge define
        foreach($deliveryAddress as $key => $item){
            $charges = ShippingCharge::getShippingCharge($product_weight, $item['country']); 
            // add new item with previous array
            $deliveryAddress[$key]['shipping_charge'] = $charges;
            $deliveryAddress[$key]['tax_charge'] = $total_tax;

            // valid postal code checking for COD
            $deliveryAddress[$key]['cod_pincode_count'] = DB::table('postal_codes') -> where('postal_code', $item['pincode']) -> count();
            // valid postal code checking for Prepaid
            $deliveryAddress[$key]['prepaid_pincode_count'] = DB::table('prepaid_postal_codes') -> where('postal_code', $item['pincode']) -> count();

         }
         

        // echo '<pre>'; print_r($deliveryAddress); die;
        // cart item checking
        if(count($userCartItems) == 0){
            // message
            $notify = [
                'message'       => "Your Cart is empty ! Please Add Product",
                'alert-type'    => "warning"
            ];

            return redirect() -> back() -> with($notify);
        }

        // page title change
        $meta_title = 'Checkout';

        return view('frontend.checkout.checkout_view', compact('userCartItems', 'deliveryAddress', 'totalAmount', 'meta_title', 'total_tax'));
    }



    // thanks for order
    public function ThanksForOrder(){

        if(Session::has('order_id')){
            // delete all cart item after order is placed
            Cart::where('user_id', Auth::id()) -> delete();
            
            // page title
            $meta_title = 'Thansk For Shopping';
            return view('frontend.checkout.thank_you', compact('meta_title'));

             // session delete
             Session::forget('grand_total');
             Session::forget('couponAmount');
             Session::forget('couponCode');
             Session::forget('order_id');
 
        }else {
            return  redirect() -> route('cart.view');
        }

       
    }
  

    // postal code check
    public function PostalCodeCheck(Request $request){
        $data = $request -> all();

        $cod_postalCode = DB::table('postal_codes') -> where('postal_code', $data['postal_code']) -> count();
        $prepaid_postalCode = DB::table('prepaid_postal_codes') -> where('postal_code', $data['postal_code']) -> count();

        // psotal code check
        if( $cod_postalCode == 0 && $prepaid_postalCode == 0){
            return 'error' ;
        }else {
            return 'valid' ;
        }


    }


    // Add or Remove wishlist product
    public function WishlistProduct($product_id){

        // get data
        $wishlistProduct = Wishlist::where(['user_id'=>Auth::user() -> id, 'product_id'=>$product_id]) -> count();
            // dd($wishlistProduct); die;

        // wishlist add or remove
        if($wishlistProduct == 0){
            // wishlist add
            $wishlist = new Wishlist();
            $wishlist -> user_id    = Auth::user() -> id;
            $wishlist -> product_id = $product_id;
            $wishlist -> save();
            return response() -> json([
                'action'    => 'add'
            ]);
        }else {
            // remove wishlist
            Wishlist::where(['user_id'=>Auth::user() -> id, 'product_id'=>$product_id]) -> delete();
            return response() -> json([
                'action'    => 'remove'
            ]);
        }

    }


    // Show wishlist product to user
    public function ViewWishlistProduct(){

        // get data
        $wishlistProduct = Wishlist::with(['getProductDetails'=>function($query){
            $query->select('id', 'product_name', 'product_code', 'product_price', 'product_color', 'main_image');
        }, 'getUserDetails' => function ($query){
            $query -> select('id', 'name');
        }]) -> where('user_id', Auth::user() -> id) -> get() -> toArray();
            // dd($wishlistProduct); die;
        return view('frontend.wishlist.view_wishlist', compact('wishlistProduct'));
        
    }


    // Show wishlist product to user
    public function DeleteWishlistProduct($id){

        // get data
        Wishlist::find($id) -> delete();
        $wishlistProduct = Wishlist::with(['getProductDetails'=>function($query){
            $query->select('id', 'product_name', 'product_code', 'product_price', 'product_color', 'main_image');
        }, 'getUserDetails' => function ($query){
            $query -> select('id', 'name');
        }]) -> get() -> toArray();

        $totalWishlistItem = totalWishlistItem();

        return response() -> json([
            'view' => (String)View::make('frontend.wishlist.append_wishlist_item') -> with(compact('wishlistProduct')),
            'totalWishlistItem'     => $totalWishlistItem
        ]);
        
    }

}
