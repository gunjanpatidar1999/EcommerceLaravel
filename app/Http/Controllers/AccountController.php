<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\categorie;
use App\Models\contact;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\addresse;
use App\Models\order;
use App\Models\coupon;


class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','coupon', 'address', 'register', 'index', 'order', 'categories', 'contact', 'logout', 'category', 'product', 'singleproduct',]]);
    }

    //to get all data
    public function index()
    {
        $data = User::all();
        return response()->json($data);
    }


    //To register user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'role_id' => 5
            ]);

            if (!$token = auth()->attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'Unauthorized', 'err' => 1], 401);
            }


            //  return $this->respondWithToken($token);

            return response()->json([
                'message' => 'User create successfully',
                'user' => $user
            ], 201);
        }
    }


    //to login user
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            if (!$token = auth()->guard('api')->attempt($validator->validated())) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            // return $this->respondWithToken($token);
            return response()->json(['access_token' => $token, "email" => $request->email], 200);
        }
    }


    //token
    public function respondWithToken($token)
    {
        return response()->json([
            'err' => 0,
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in'=>auth()->factory()->getTTL()*60
            'user' => auth()->user()
        ]);
    }


    //profile
    public function profile(Request $request)
    {
        //   $arr=["anuj","anil"];
        // $admin = Auth::user();
        // dd(Auth::user());
        return response()->json($request->user());

        // return response()->json($arr);
    }


    //to logout user
    public function logout()
    {
        auth()->logout();
        return response()->json(["message" => "User Logout Successfully"]);
    }


    //to request user
    public function getuser(Request $request)
    {
        return response()->json($request->user());
    }


    // to refresh token
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }


    //Contact API
    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'subject' => 'required',
            'message' => 'required|string|min:4',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $contact = new contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;

            if ($contact->save()) {
                return response()->json(['msg' => 'Query Submitted']);
            } else {
                return response(['msg' => 'Query Not Added']);
            }
        }
    }


    //all category api
    public function category()
    {
        $category = categorie::all();
        return response()->json($category);
    }


    //products of particular category id
    public function categories($id)
    {

        $categorydata = DB::table('products')
            ->join('productimages', 'products.id', '=', 'productimages.productid')
            ->join('productattributes', 'products.id', '=', 'productattributes.productid')
            ->select('products.*', 'productimages.productimagename', 'productattributes.price', 'productattributes.quantity')
            ->where('products.catid', '=', $id)
            ->get();

        return response()->json($categorydata);

        // $prodata = product::find($id);
        //   dd($prodata);

        // $product = DB::select(DB::raw('SELECT products.productname,products.productdescription , productattributes.quantity, productattributes.price,
        // productimages.productimagename
        // FROM products JOIN productattributes ON products.id = productattributes.productid JOIN productimages ON productimages.productid = products.id WHERE products.catid =  :author'), array('author' => $id));

        // dd($product[0]);
        //  json_encode($product);



    }

    //all products
    public function product()
    {
        $product = DB::table('products')
            ->join('productimages', 'products.id', '=', 'productimages.productid')
            ->join('productattributes', 'products.id', '=', 'productattributes.productid')
            ->select('products.*', 'productimages.productimagename', 'productattributes.price', 'productattributes.quantity')
            ->get();



        // $product = DB::table('products')
        //     ->leftjoin('productimages', 'products.id', '=', 'productimages.productid')
        //     ->leftjoin('productattributes', 'products.id', '=', 'productattributes.productid')
        //     ->select('products.*', 'productimages.productimagename', 'productattributes.price','productattributes.quantity')
        //     ->get();


        return response()->json($product);
    }


    //For particular product data
    public function singleproduct($id)
    {
        $singleproduct = DB::table('products')
            ->join('productimages', 'products.id', '=', 'productimages.productid')
            ->join('productattributes', 'products.id', '=', 'productattributes.productid')
            ->select('products.*', 'productimages.productimagename', 'productattributes.price', 'productattributes.quantity')
            ->where('products.id', '=', $id)
            ->get();

        return response()->json($singleproduct);
    }


    //api for storing order data
    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pid' => 'required',
            'productname' => 'required|string|max:255',
            'productimagename' => 'required',
            'uid' => 'required',
            'price' => 'required',
            'quantity' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $order = new order;
        $order->productname = $request->get('productname');
        $order->pid = $request->get('pid');
        $order->productimagename = $request->get('productimagename');
        $order->price = $request->get('price');
        $order->quantity = $request->get('quantity');
        $order->uid = $request->get('uid');
        if ($order->save()) {
            $message = ["Order Placed Successfully"];
            return response()->json(compact('message'));
        } else {
            $message = ["Unsuccessful"];
            return response()->json(compact('message'));
        }
    }

    
    //api for storing address
    public function address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'postal' => 'required',
            'mobile' => 'required|min:10|max:10',
            'address' => 'required',
            'payment_method' => 'required',
            'uid' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $address = new addresse;
        $address->firstname = $request->get('firstname');
        $address->lastname = $request->get('lastname');
        $address->email = $request->get('email');
        $address->postal = $request->get('postal');
        $address->mobile = $request->get('mobile');
        $address->address = $request->get('address');
        $address->payment_method = $request->get('payment_method');
        $address->uid = $request->get('uid');
        if ($address->save()) {
            $message = ["Address Saved Successfully"];
            return response()->json(compact('message'));
        } else {
            $message = ["Unsuccessful"];
            return response()->json(compact('message'));
        }
    }

    
    //api for change password
    public function changepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old' => 'required',
            'new' => 'required',
            'cnew' => 'required|same:new',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'msg' => "Validation fails",
                "error"=>$validator->errors()
            ], 422);
        }

        $user = $request->user();

        if (Hash::check($request->old, $user->password)) {
            $user->update([
                'password' => Hash::make($request->cnew)
            ]);
            return response()->json([
                'msg' => "Password Updated successfully"
            
            ], 200);
        } else {
            return response()->json([
                'msg' => "Old Password Not Match"
                
            ], 400);
        }
    }

    //api for coupon management
    public function coupon()
    {
        $data = coupon::all();
        return response()->json(['coupons'=>$data]);
    }
}
