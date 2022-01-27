<?php

namespace App\Http\Controllers;

use App\Models\addresse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\categorie;
use App\Models\order;
use App\Models\product;
use App\Models\productimage;
use App\Models\productattribute;

class CategoryController extends Controller
{
    // To Add CAtegory Page
    public function AddCategory()
    {
        return view('addcategory');
    }

    //To Post Category
    public function PostCategory(Request $req)
    {
        $validateData = $req->validate(
            [
                'categoryname' => 'required',
            ]
        );

        if ($validateData) {
            $categoryname = $req->categoryname;
            $category = new categorie;

            $category->categoryname = $categoryname;

            if ($category->save()) {
                return back()->with('success', 'Category Added');
            } else {
                return back()->with('errMsg', 'Category Not Added');
            }
        }
    }

    //To Show Category
    public function ShowCategory()
    {
        $category = categorie::all();
        return view('showcategory', ['category' => $category]);
    }

    //To delete Category
    public function DeleteCategory($id)
    {
        $data = categorie::find($id);
        if ($data->delete()) {
            return back()->with('success', 'Category deleted');
        }
    }

    //To Edit Category
    public function EditCategory($id)
    {
        $category = categorie::find($id);
        return view('editcategory', ['category' => $category]);
    }

    //To Update Category
    public function UpdateCategory($id, Request $req)
    {
        $validateData = $req->validate(
            [
                'categoryname' => 'required',
            ]
        );
        if ($validateData) {
            $data = categorie::where('id', $req->id)->update([
                'categoryname' => $req->categoryname,
            ]);
            if ($data) {
                return redirect('/showcategory')->with('success', 'Category Updated');
            } else {
                return redirect('/showcategory')->with('errMsg', 'Category Not Updated');
            }
        }
    }

    //To Add Product
    public function AddProduct()
    {
        $category = categorie::all();
        return view('addproduct', ['category' => $category]);
    }

    //To Post Product
    public function PostProduct(Request $req)
    {
        $validateData = $req->validate(
            [
                'productname' => 'required|unique:products',
                'productdescription' => 'required',
                'productquantity' => 'required',
                'productprice' => 'required',

            ]
        );

        if ($validateData) {
            $productname = $req->productname;
            $productdescription = $req->productdescription;
            $catid = $req->type;

            $product = new product;
            $product->productname = $productname;
            $product->productdescription = $productdescription;
            $product->catid = $catid;


            if ($product->save()) {
                $images = $req->file('images');

                if (!empty($images)) {
                    $dest = public_path('/uploads');
                    foreach ($images as $item) {
                        $fname = "Image-" . rand() . "-" . time() . "." . $item->extension();
                        if ($item->move($dest, $fname)) {
                            $data = product::where('productname', $req->productname)->get();
                            $id = $data[0]->id;
                            $img = new productimage();
                            $img->productid = $id;
                            $img->productimagename = $fname;
                            $img->save();
                            // if ($img->save()) 
                            // {

                            // } 
                            // else 
                            // {
                            //     return back()->with('errMsg', 'Attribute Not Added');
                            // }
                        } else {
                            $path = public_path() . "uploads/" . $fname;
                            unlink($path);
                            return back()->with('errMsg', 'Image Not Added');
                        }
                    }
                    $productquantity = $req->productquantity;
                    $productprice = $req->productprice;

                    $data = product::where('productname', $req->productname)->get();
                    $id = $data[0]->id;
                    $productattr = new productattribute;
                    $productattr->quantity = $productquantity;
                    $productattr->price = $productprice;
                    $productattr->productid = $id;
                    $productattr->save();
                    return back()->with('success', 'Product Added');
                }
            }
        }
    }

    //To show Product
    public function ShowProduct()
    {

        $productdata = DB::select('SELECT products.id,products.productname,products.productdescription,categories.categoryname ,productattributes.quantity,productattributes.price
        FROM categories JOIN products ON categories.id = products.catid JOIN productattributes
        ON productattributes.productid = products.id ');

        $productimage = productimage::all();
        return view('showproduct', ['productdata' => $productdata], ['productimage' => $productimage]);
    }

    //To show Product Images
    public function ShowProductImages($id)
    {
        $productid = $id;
        $productimages = productimage::all();
        return view('productimage', ['productid' => $productid], ['productimages' => $productimages]);
    }

    //To delete Product
    public function DeleteProduct($id)
    {
        $product = product::find($id);
        productimage::where('productid', $id)->delete();
        if ($product->delete()) {
            return back()->with('success', 'Product deleted');
        } else {
            return back()->with('errMsg', 'Product Not Deleted');
        }
    }

    //To Edit Product
    public function EditProduct($id)
    {
        //  $prodata = product::find($id);
        //  dd($prodata);
        $category = categorie::all();
        // $productattribute = productattribute::where('productid',$id)->get()->first();
        $product = DB::select(DB::raw('SELECT products.id ,productname,productdescription,quantity,price
          FROM categories JOIN products ON categories.id = products.catid JOIN productattributes
          ON productattributes.productid = products.id WHERE productid = :author '), array('author' => $id));

        //  dd($product[0]);
        return view('editproduct', ['product' => $product[0]], ['category' => $category]);
    }

    //To update Product
    public function UpdateProduct(Request $req, $id)
    {
        $validateData = $req->validate(
            [

                'productdescription' => 'required',
                'productquantity' => 'required',
                'productprice' => 'required',

            ]
        );
        if ($validateData) {
            product::where('id', $req->id)->update([
                'productname' => $req->productname,
                'productdescription' => $req->productdescription,
                'catid' => $req->type
            ]);

            $data = productattribute::where('productid', $req->id)->update([
                'quantity' => $req->productquantity,
                'price' => $req->productprice
            ]);

            $images = $req->file('images');

            if (!empty($images)) {
                productimage::where('productid', $req->id)->delete();
                $dest = public_path('/uploads');
                foreach ($images as $item) {
                    $fname = "Image-" . rand() . "-" . time() . "." . $item->extension();
                    if ($item->move($dest, $fname)) {
                        $img = new productimage();
                        $img->productid = $req->id;
                        $img->productimagename = $fname;
                        $img->save();
                    } else {
                        $path = public_path() . "uploads/" . $fname;
                        unlink($path);
                        return back()->with('errMsg', 'Image Not Added');
                    }
                }
            }
            return redirect('/showproduct');
        }
    }

    //to show order deatils at admin side
    public function ShowOrderDeatils()
    {
        $orderdeatils = order::all();
       
        return view('orderdeatils',['orderdeatils'=>$orderdeatils]);
    }
}
