<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    /**
     * product listin page category wise
     * product filter combindly
     */
    public function ProductListing(Request $request){
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
                $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();
                // dd($catWiseProduct) -> toArray(); die;
                // echo '<pre>'; print_r($catWiseProduct); die;

                // breadcum define
                $breadcum = Category::find($searchUrl -> parent_id);

                // product filtering by ajax if fabric option is checked
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    // {{ echo "fabric1/";}}
                    $catWiseProduct = Product::with('getBrand') -> whereIn('fabric', $data['fabric']) -> whereIn('category_id', $categoryDetails['catIds']) -> where('status', 1) -> get();

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

                return view('frontend.product.ajax_product_listing', compact('catWiseProduct', 'breadcum', 'catDetails'));
            }else{
                abort(404);
            }
            
        }else{
            $url = Route::getFacadeRoot() -> current() -> uri();

            $catCount = Category::where(['url' => $url, 'status' => 1]) -> count();
            $searchUrl = Category::where(['url' => $url, 'status' => 1]) -> first();

            if($catCount > 0){
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

                return view('frontend.product.product_list', compact('catWiseProduct', 'catDetails', 'breadcum', 'page_name'), $allFilters);

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

        $relatedProduct = Product::where('category_id', $productDetails -> category_id) -> where('id', '!=', $id) -> limit(3) -> inRandomOrder() -> get();
        // echo '<pre>'; print_r($relatedProduct); die;
        // dd($relatedProduct);

        return view('frontend.product.product_details', compact('productDetails', 'productGalleris', 'totalStock', 'relatedProduct'));
    }


    /**
     *  get price based on product size
     */
    public function ProductWiseGetPrice(Request $request){

        if($request -> ajax()){

            $getPrice = ProductAttribute::where('product_id', $request -> product_id) -> where('size', $request -> size) -> first();

            // dd($getPrice);
            return $getPrice;
        }

    }

}
