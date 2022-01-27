<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\bannerimage;
use Illuminate\Http\Request;

class bannercontroller extends Controller
{

    //To Redirect to Add Banner page 
    public function AddBanner()
    {
        return view('addbanner');
    }

    //To post banner data
    public function PostBanner(Request $req)
    {
        $validateData = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
            ]
        );

        if ($validateData) {
            $title = $req->title;
            $desc = $req->description;
            $cat = new banner;
            $cat->title = $title;
            $cat->description = $desc;

            if ($cat->save()) {
                $images = $req->file('images');
                if (!empty($images)) {
                    $dest = public_path('/uploads');
                    foreach ($images as $item) {
                        $fname = "Image-" . rand() . "-" . time() . "." . $item->extension();
                        if ($item->move($dest, $fname)) {
                            $data = banner::where('title', $req->title)->get();
                            $id = $data[0]->id;
                            $img = new bannerimage();
                            $img->BannerImageId = $id;
                            $img->url = $fname;
                            $img->save();
                        } else {
                            $path = public_path() . "uploads/" . $fname;
                            unlink($path);
                            return back()->with('errMsg', 'Image Not Added');
                        }
                    }
                }
                return back()->with('success', 'Banner Added');
            } else {
                return back()->with('errMsg', 'Banner Not Added');
            }
        }
    }


    //To Show Banner Data
    public function ShowBanner()
    {
        $catdata = banner::all();
        $bannerimages = bannerimage::all();
        return view('showbanner', ['catdata' => $catdata], ['bannerimages' => $bannerimages]);
    }

    //To Show Banner Images
    public function ShowBannerImages($id)
    {
        $catid = $id;
        $bannerimages = bannerimage::all();
        return view('bannerimages', ['catid' => $catid], ['bannerimages' => $bannerimages]);
    }

    //To delete Banner
    public function DeleteBanner($id)
    {
        $cat = banner::find($id);
        // $img = bannerimage::where('BannerImageId',$id)->get();
        // foreach($img as $i)
        // {
        //     $fname = $i['url'];
        //     $path=public_path()."/uploads/".$fname;
        //     //unlink($path);
        // }
        bannerimage::where('BannerImageId', $id)->delete();
        if ($cat->delete()) {
            //unlink($imagePath);
            return back()->with('success', 'Banner deleted');
        } else {
            return back()->with('errMsg', 'Banner Not Deleted');
        }
    }

    //To Edit Banner
    public function EditBanner($id)
    {
        $catdata = banner::find($id);
        return view('editbanner', ['catdata' => $catdata]);
    }

    //To Update Banner
    public function UpdateBanner(Request $req,$id)
    {

        $validateData = $req->validate(
            [
                'title' => 'required',
                'description' => 'required',
            ]
        );
        if($validateData){

        banner::where('id', $req->id)->update([
            'title' => $req->title,
            'description' => $req->description
            ]);

        $images = $req->file('images');

        if (!empty($images)) 
        {
            bannerimage::where('BannerImageId', $req->id)->delete();
            $dest = public_path('/uploads');
            foreach ($images as $item) {
                $fname = "Image-" . rand() . "-" . time() . "." . $item->extension();
                if ($item->move($dest, $fname)) {
                    $img = new bannerimage();
                    $img->BannerImageId = $id;
                    $img->url = $fname;
                    $img->save();
                } 
                else 
                {
                    $path = public_path() . "uploads/" . $fname;
                    unlink($path);
                    return back()->with('errMsg', 'Image Not Added');
                }
            }
        }
        return redirect('/showbanner');
      }
    }
}
