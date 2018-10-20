<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use App\Property;
use App\Featured_Product;
use App\Like;
use App\Card;
use App\Message;
use Auth;
use DB ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $user = User::all()->where('id',Auth::user()->id); 
        if(Auth::user()->admin == 1 )
        return view('home',compact('user') );
        else
        {
        $products = Property::all()->where('featured',1);
        $all_cards = Card::all()->where('user_id',Auth::user()->id);
        return view('pages_user.index',compact('all_cards'),compact('products'),compact('likes'));
        }

    }  
    public function view_profile($id)
   {
   
    $user = User::find($id); 
    return view('edit_profile',compact('user'));
  
   }

    public function update_account(Request $request)
    {
     if($request->isMethod('POST')){
     $user        =  Auth::user(); 
     if(!empty($request->name) ){
     if(ctype_alpha($request->name)) 
     $user->name = $request->input('name');
    else
    {
    $errors = "The Name must be string "; 
         return view('edit_profile',array('user'=>Auth::user()),compact('errors'));

    }
     
     }
     if(!empty($request->file('image')))
     {
     $image       = $request->file('image'); 
     $new_name    = time().'.'.$image->getClientOriginalExtension();
     $image->move(public_path("images/avatar"),$new_name);
     $user->image =  $new_name; 
     }
     //password 
    if(!empty($request->gender))
     {
      $user->gender = $request->gender ; 
     }
     if(!empty($request->new_pass)&&!empty($request->Retype_pass))
     { 
      if(Hash::check($request->current_pass, $user->password)){
     if($request->new_pass == $request->Retype_pass)
     {
      if(strlen($request->new_pass) > 5)
      $user->password = Hash::make($request->new_pass);
      else
      {
      $errors="The new & The retype pass must be at least 6 characters";
     return view('edit_profile',array('user'=>Auth::user()),compact('errors'));

      }
     }
     else
     {
     $errors="The new pass and retype pass must match";
     return view('edit_profile',array('user'=>Auth::user()),compact('errors'));

     }
     }
    else 
     { 
     $errors="The Current password is wrong";
     return view('edit_profile',array('user'=>Auth::user()),compact('errors'));


        }     
                }
     
     $user->save();

     return view('edit_profile',array('user'=>Auth::user())); 
     
     }
    }
    public function view_all_users()
    {
    $users = User::all()->where('admin',0); 
    return view('tables.users_table',compact('users')); 
    } 
    public function view_all_admins()
    {
    $users = User::all()->where('admin',1); 
    return view('tables.admins_table',compact('users')); 
    }
    public function view_all_products()
    {
    $product = property::all()->where('featured',0);
    return view('tables.product_table',compact('product'));

    }
    public function delete_user(Request $request)
    { 
      

    DB::table('users')->where('id',$request->input('id'))->delete();
    $users = User::all()->where('admin',0); 
    return redirect('user_tables')->with(compact('users')); 


    } 
    
    public function delete_featured_product(Request $request)
    {

    DB::table('likes')->where('property_id',$request->input('id'))->delete(); 
    DB::table('cards')->where('property_id',$request->input('id'))->delete();  
    DB::table('properties')->where('id',$request->input('id'))->delete(); 
    $product = Property::all();
        return view('tables.feature_products_table',compact('product'));
    }
    public function delete_product(Request $request)
    {

    DB::table('likes')->where('property_id',$request->input('id'))->delete(); 
    DB::table('cards')->where('property_id',$request->input('id'))->delete(); 
    DB::table('properties')->where('id',$request->input('id'))->delete(); 
    $product = Property::all();
    return view('tables.product_table',compact('product'));
    }
    public function delete_admin(Request $request)
    { 
      

    DB::table('users')->where('id',$request->input('id'))->delete();
    $users = User::all()->where('admin',1); 
    return redirect('admin_tables')->with(compact('users')); 


    }
    public function view_featured_product_table()
    { 
        $product = Property::all()->where('featured',1);
        return view('tables.feature_products_table',compact('product'));

    }
    public function view_all_messages()
    {
        $messages = Message::all(); 
        return view('tables.user_message_table',compact('messages')); 
    }
    public function edit_featured_product(Request $request)
    {

        if($request->isMethod('POST'))
        {
         $product = Property::find($request->input('id')); 
         $request->validate([
         'title' =>'required|string',
         'body'  =>'required|string',
         'price' =>'required|numeric',
         ]);
         $product->title     = $request->input('title');
         $product->body      = $request->input('body');
         $product->info      = $request->input('info');
         $product->quantity  = $request->input('quantity');
         $product->price     = $request->input('price');
        if(!empty($request->file('image')))
         {
         $image               = $request->file('image'); 
         $new_name            = time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path("images/avatar"),$new_name);
         $product->image     =  $new_name; 
         }
         if(!empty( $request->input('category')))
         $product->category  =  $request->input('category');
         if(!empty($request->input('sex')))
         $product->sex       =  $request->input('sex');
         if(!empty($request->input('size')))
         $product->size      =  $request->input('size');
         if(!empty($request->input('color')))
         $product->color     =  $request->input('color');
         $product->save();

        $product = Property::all()->where('featured',1);
        return view('tables.feature_products_table',compact('product'));
} 
        else
        {
        $product = Property::find($request->input('id')); 
        return view('edit_featured_product',compact('product'));

        } 

    }
    public function edit_product(Request $request)
    {

        if($request->isMethod('POST'))
        {
        $product = Property::find($request->input('id')); 
         $request->validate([
         'title' =>'required|string',
         'body'  =>'required|string',
         'price' =>'required|numeric',
         ]);
         $product->title     = $request->input('title');
         $product->body      = $request->input('body');
         $product->info      = $request->input('info');
         $product->quantity  = $request->input('quantity');
         $product->price     = $request->input('price');
        if(!empty($request->file('image')))
         {
         $image               = $request->file('image'); 
         $new_name            = time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path("images/avatar"),$new_name);
         $product->image     =  $new_name; 
         }
         if(!empty( $request->input('category')))
         $product->category  =  $request->input('category');
         if(!empty($request->input('sex')))
         $product->sex       =  $request->input('sex');
         if(!empty($request->input('size')))
         $product->size      =  $request->input('size');
         if(!empty($request->input('color')))
         $product->color     =  $request->input('color');
         $product->save();

         $product = Property::all()->where('featured',0);
          return view('tables.product_table',compact('product'));
        } 
        else
        {
            $product = Property::find($request->input('id')); 
             return view('edit_property',compact('product'));

        } 

    }
    public function edit_user(Request $request)
    {   

        if($request->isMethod('POST'))
        { 
        $user = User::find($request->input('id'));
        if(!empty($request->name) ){
          $request->validate([
          'name'=>'required|string',
          ]);
         $user->name = $request->input('name'); 
        }
        if(!empty($request->file('image')))
        {
         $image       = $request->file('image'); 
         $new_name    = time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path("images/avatar"),$new_name);
         $user->image =  $new_name; 
         }
         if(!empty($request->gender))
         { 
            $user->gender = $request->input('gender');

         }
         $user->save(); 
        }
        else
        {
        $user = User::find($request->input('id'));
        }
        return view('edit_user',compact('user'));

    }
    public function register_ad(Request $request)
    {
      
      if($request->isMethod('POST'))
      {
       $user = new User(); 
       $user->name     = $request->input('name'); 
       $user->email    = $request->input('email'); 
       $user->password = Hash::make($request->input('password')); 
       $user->admin    = 1;
       $user->save();
       return redirect('home');

      }
     return view('auth.register_ad');
    }
    public function my_profile(Request $request)
    { 
        $all_cards = Card::all()->where('user_id',Auth::user()->id);
        if($request->isMethod('POST'))
        { 
        $user = User::find(Auth::user()->id);
        if(!empty($request->name) ){
          $request->validate([
          'name'=>'required|string',
          ]);
         $user->name = $request->input('name'); 
        }
        if(!empty($request->file('image')))
        {
         $image       = $request->file('image'); 
         $new_name    = time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path("images/avatar"),$new_name);
         $user->image =  $new_name; 
         }
         if(!empty($request->gender))
         { 
            $user->gender = $request->input('gender');

         }
        if(!empty($request->new_pass)&&!empty($request->Retype_pass))
        { 
          if(Hash::check($request->current_pass, $user->password)){
            if($request->new_pass == $request->Retype_pass)
              {
             if(strlen($request->new_pass) > 5)
             $user->password = Hash::make($request->new_pass);
             else
             {
             $errors="The new & The retype pass must be at least 6 characters";
             return view('edit_profile',array('user'=>Auth::user()),compact('errors'),compact('all_cards'));
             }
             }
            else
             {
             $errors="The new pass and retype pass must match";
             return view('edit_profile',array('user'=>Auth::user()),compact('errors'),compact('all_cards'));
             } 
             }
             else 
             {  
            $errors="The Current password is wrong";
                    return view('pages_user.my_profile',array('user'=>Auth::user()),compact('errors'),compact('all_cards'));
                       }     
                }
         $user->save(); 
        }
      $user = User::find(Auth::user()->id);
      return view('pages_user.my_profile',compact('user'),compact('all_cards'));

    }//
    public function add_featured_product(Request $request)
    { 

        if($request->isMethod('POST'))
        {  
      
         $request->validate([
         'title' =>'required|string',
         'body'  =>'required|string',
         'price' =>'required|numeric',
         'image' =>'required|mimes:jpeg,bmp,png',
         ]);
         $property               =  new Property();
         $property->title        = $request->input('title');
         $property->featured     = 1;
         $property->body         = $request->input('body');
         $property->info         = $request->input('info');
         $property->quantity     = $request->input('quantity');
         $property->price        = $request->input('price');

         $image       = $request->file('image'); 
         $new_name    = time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path("images/avatar"),$new_name);
         $property->image =  $new_name; 

         $property->category  =  $request->input('category');
         $property->sex       =  $request->input('sex');
         $property->size      =  $request->input('size');
         $property->color     =  $request->input('color');
         $property->save();
         return redirect('home');
        }
    return view('add_featured_product');
    }   

    public function add_property(Request $request)
    { 

        if($request->isMethod('POST'))
        {  
      
         $request->validate([
         'title' =>'required|string',
         'body'  =>'required|string',
         'price' =>'required|numeric',
         'image' =>'required|mimes:jpeg,bmp,png',
         ]);
         $property            =  new Property();
         $property->title     = $request->input('title');
         $property->body      = $request->input('body');
         $property->info  = $request->input('info');
         $property->quantity  = $request->input('quantity');
         $property->price  = $request->input('price');

         $image       = $request->file('image'); 
         $new_name    = time().'.'.$image->getClientOriginalExtension();
         $image->move(public_path("images/avatar"),$new_name);
         $property->image =  $new_name; 

         $property->category =  $request->input('category');
         $property->sex =  $request->input('sex');
         $property->size =  $request->input('size');
         $property->color =  $request->input('color');
         $property->save();
         return redirect('home');
        }
    return view('add_property');
    }
    public function view_product()
    {
    
    $product = property::all()->where('featured',0);
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.product',compact('product'),compact('all_cards'));
    }
    public function product_details($id)
    { 
        $product = Property::find($id);
        $all_cards = Card::all()->where('user_id',Auth::user()->id);
        return view('pages_user.product_details',compact('product'),compact('all_cards'));

    }
    public function view_product_woman()
    {
     $product = Property::all()->where('sex','woman');
     $all_cards = Card::all()->where('user_id',Auth::user()->id);
     return view('pages_user.product_woman',compact('product'),compact('all_cards'));
    }
    public function view_product_man()
    {
     $product = Property::all()->where('sex','man');
     $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.product_man',compact('product'),compact('all_cards'));
    }
    public function view_product_kids()
    {
     $product = Property::all()->where('sex','kids');
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
     return view('pages_user.product_kids',compact('product'),compact('all_cards'));
    }


    function action(Request $request)
    {
      {
      $output  = '';
      $start   = $request->get('start'); 
      $end     = $request->get('end');
      $sex     = $request->get('sex'); 
      if($sex=="all")
      $product = Property::all()->where('price','>=',$start)->where('price','<=',$end); 
       else
      $product = Property::all()->where('price','>=',$start)->where('price','<=',$end)->where('sex',$sex); 

      $total_row = $product->count();
     
       foreach($product as $pro)
       {

         $like_count = 0 ;
         $style ="";
         $style_alt="";
         $value = 0 ; 
         foreach ($pro->likes as $like) {
              
               if($like->like==1)
                $like_count++; 
               if($like->user_id == Auth::user()->id)
               {
                $style     ="display:block; color:red;";
                $style_alt ="display:none";
                $value = 1 ;
               }             
                 
              


        }

      $output .= '
       <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/avatar/'.$pro->image.'" alt="IMG-PRODUCT" >

                                    <div class="block2-overlay trans-0-4">
                                        <a  onclick="like('.$pro->id.', $(this))" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                             
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true" style="'.$style_alt.'"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" style="'.$style.'"></i>
                                            
                                        </a>
                                 
                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.route('product_details',$pro->id).'" class="block2-name dis-block s-text3 p-b-5">
                                         '. $pro->title.'
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        $'. $pro->price.'
                                    </span>
                                </div>
                            </div>
                           
                        </div>';
           } 
    
      $data = array(
       'table_data'  => $output,
       'total_row'  => $total_row,
     
      );

      echo json_encode($data);
     }
    }
    public function search(Request $request)
    {
     $que = $request->get('query');
     $output="";
     $sex     = $request->get('sex'); 
     if($sex=="all")
     $data =  Property::where('title','like', '%'.$que.'%')->get();
     else
     $data =  Property::where('title','like', '%'.$que.'%')->where('sex',$sex)->get();
     
     $total_row = $data->count();
      if($total_row > 0)
      {
             
       foreach($data as $pro)
       {

         $like_count = 0 ;
         $style ="";
         $style_alt="";
         $value = 0 ; 
         foreach ($pro->likes as $like) {
              
               if($like->like==1)
                $like_count++; 
               if($like->user_id == Auth::user()->id)
               {
                $style     ="display:block; color:red;";
                $style_alt ="display:none";
                $value = 1 ;
               }             
                 
              


        }

      $output .= '
       <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/avatar/'.$pro->image.'" alt="IMG-PRODUCT" >

                                    <div class="block2-overlay trans-0-4">
                                        <a  onclick="like('.$pro->id.', $(this))" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                             
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true" style="'.$style_alt.'"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" style="'.$style.'"></i>
                                            
                                        </a>
                                 
                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.route('product_details',$pro->id).'" class="block2-name dis-block s-text3 p-b-5">
                                         '. $pro->title.'
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        $'. $pro->price.'
                                    </span>
                                </div>
                            </div>
                           
                        </div>';
           } 
       }
        else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      } 
      $data = array(
       'table_data'  => $output,
       'total_row'   =>$total_row,
     
      );

      echo json_encode($data);
    }
    
      public function search_color(Request $request)
    {
     $color     =  $request->get('color');
     $output    = '';
     $sex       = $request->get('sex'); 
     if($sex=="all")
     $data      = Property::where('color',$color)->get();
     else
     $data      = Property::where('color',$color)->where('sex',$sex)->get();
  
      $total_row = $data->count();
      if($total_row > 0)
      {
         foreach($data as $pro)
      
       {
      $output .= '
       <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/avatar/'.$pro->image.'" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="'.route('product_details',$pro->id).'" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.route('product_details',$pro->id).'" class="block2-name dis-block s-text3 p-b-5">
                                         '. $pro->title.'
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        $'. $pro->price.'
                                    </span>
                                </div>
                            </div>
                        </div>';
           } 
       }
        else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      } 
      $data = array(
       'table_data'  => $output,
      
     
      );

      echo json_encode($data);
    }

     public function like(Request $request)
     {
     $property_id = $request->id;
     
     //know the value of like 
     $product      = Property::where('id',$property_id)->first(); 
     $name_product = $product->category;
     $like = DB::table('likes') 
     ->where('property_id',$property_id)
     ->where('user_id',Auth::user()->id)
     ->first();
    
     if(!$like) //create new like 
     { 
       $new_like = new Like();
       $new_like->user_id   = Auth::user()->id ; 
       $new_like->property_id= $property_id;
       $new_like->like      = 1 ; 
       $new_like->save();

       $new_card = new Card(); 
       $new_card->user_id   = Auth::user()->id ; 
       $new_card->property_id= $property_id ;
       $new_card->save(); 

       $is_like = 1 ; 
      
     }
     else if($like->like == 1) //delete like 
     {
      DB::table('likes')
      ->where('property_id',$property_id)
      ->where('user_id',Auth::user()->id)
      ->delete();
      DB::table('cards')
      ->where('property_id',$property_id)
      ->where('user_id',Auth::user()->id)
      ->delete();

      $is_like = 0 ; 
     

     }
      $response = array(
     'is_like' =>$is_like,
     'name_product'=>$name_product,
    
  
    );

    return response()->json($response,200);
    }
    public function view_card()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.card',compact('all_cards'));
    }
    public function about()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.about',compact('all_cards'));
    }public function contact()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.contact',compact('all_cards'));
    }
    public function view_dresses()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.dreeses',compact('all_cards'));
   }
       public function view_sunglasses()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.sunglasses',compact('all_cards'));
   }

    public function view_t_shirt()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.t-shirt',compact('all_cards'));
   }

    public function view_watches()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.watches',compact('all_cards'));
   }

    public function view_footerwear()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.footerwear',compact('all_cards'));
   }

    public function view_bags()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.bags',compact('all_cards'));
   } 
   public function view_jackets()
    {
    $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.category.jackets',compact('all_cards'));
   }

     function action_category(Request $request)
    {
      {
      $output  = '';
      $start   = $request->get('start'); 
      $end     = $request->get('end');
      $category     = $request->get('category');
      $product = Property::all()->where('price','>=',$start)->where('price','<=',$end)->where('category',$category); 
     
      $total_row = $product->count();
     
       foreach($product as $pro)
       {

         $like_count = 0 ;
         $style ="";
         $style_alt="";
         $value = 0 ; 
         foreach ($pro->likes as $like) {
              
               if($like->like==1)
                $like_count++; 
               if($like->user_id == Auth::user()->id)
               {
                $style     ="display:block; color:red;";
                $style_alt ="display:none";
                $value = 1 ;
               }             
                 
              


        }

      $output .= '
       <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/avatar/'.$pro->image.'" alt="IMG-PRODUCT" >

                                    <div class="block2-overlay trans-0-4">
                                        <a  onclick="like('.$pro->id.', $(this))" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                             
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true" style="'.$style_alt.'"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" style="'.$style.'"></i>
                                            
                                        </a>
                                 
                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.route('product_details',$pro->id).'" class="block2-name dis-block s-text3 p-b-5">
                                         '. $pro->title.'
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        $'. $pro->price.'
                                    </span>
                                </div>
                            </div>
                           
                        </div>';
           } 
    
      $data = array(
       'table_data'  => $output,
       'total_row'  => $total_row,
     
      );

      echo json_encode($data);
     }
    }
    public function search_category(Request $request)
    {
     $que = $request->get('query');
     $output="";
     $category=$request->get('category');
     $data =  Property::where('title','like', '%'.$que.'%')->where('category',$category)->get();
     $total_row = $data->count();
      if($total_row > 0)
      {
             
       foreach($data as $pro)
       {

         $like_count = 0 ;
         $style ="";
         $style_alt="";
         $value = 0 ; 
         foreach ($pro->likes as $like) {
              
               if($like->like==1)
                $like_count++; 
               if($like->user_id == Auth::user()->id)
               {
                $style     ="display:block; color:red;";
                $style_alt ="display:none";
                $value = 1 ;
               }             
                 
              


        }

      $output .= '
       <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/avatar/'.$pro->image.'" alt="IMG-PRODUCT" >

                                    <div class="block2-overlay trans-0-4">
                                        <a  onclick="like('.$pro->id.', $(this))" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                             
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true" style="'.$style_alt.'"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" style="'.$style.'"></i>
                                            
                                        </a>
                                 
                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.route('product_details',$pro->id).'" class="block2-name dis-block s-text3 p-b-5">
                                         '. $pro->title.'
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        $'. $pro->price.'
                                    </span>
                                </div>
                            </div>
                           
                        </div>';
           } 
       }
        else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      } 
      $data = array(
       'table_data'  => $output,
       'total_row'   =>$total_row,
     
      );

      echo json_encode($data);
    }
    
      public function search_color_category(Request $request)
    {
     $color  = $request->get('color');
     $output ='';
     $category=$request->get('category');
     $data   = Property::where('color',$color)->where('category',$category)->get();
     $total_row = $data->count();
      if($total_row > 0)
      {
         foreach($data as $pro)
      
       {
      $output .= '
       <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                    <img src="images/avatar/'.$pro->image.'" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="'.route('product_details',$pro->id).'" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="'.route('product_details',$pro->id).'" class="block2-name dis-block s-text3 p-b-5">
                                         '. $pro->title.'
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        $'. $pro->price.'
                                    </span>
                                </div>
                            </div>
                        </div>';
           } 
       }
        else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      } 
      $data = array(
       'table_data'  => $output,
      
     
      );

      echo json_encode($data);
    }
    public function add_card(Request $request)
    {

     $likes =  Like::all()->where('user_id',Auth::user()->id) ; 
     foreach($likes as $like){
             DB::table('likes')->where('property_id',$like->property_id)->delete(); 
             DB::table('cards')->where('property_id',$like->property_id)->delete();
             DB::table('properties')->where('id',$like->property_id)->delete();

     }
     $all_cards = Card::all()->where('user_id',Auth::user()->id);
    return view('pages_user.card',compact('all_cards'));
   

    }
    public function send_msg(Request $request)
    {
    
    $msg = new Message(); 
    $msg->from        = $request->input('name');
    $msg->phone_num   = $request->input('phone-number');
    $msg->email       = $request->input('email');
    $msg->msg         = $request->input('message');
    $msg->user_id     = Auth::user()->id;
    $msg->save(); 
    return redirect('home');

    }
    public function delete_msg(Request $request)
    { 
     DB::table('messages')->where('id',$request->input('id'))->delete();
        $messages = Message::all(); 
        return view('tables.user_message_table',compact('messages'));
   
    }





}
