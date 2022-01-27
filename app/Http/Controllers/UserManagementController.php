<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    //To Show User Data
    public function ShowUser()
    {
        $userdata = DB::select('SELECT users.id, users.firstname,users.lastname,users.email,users.status, roles.role_name FROM users JOIN roles ON users.role_id = roles.id');
        //  $userdata = User::all();
        return view('usermanagement', ['userdata' => $userdata]);
    }


    // To Create User
    public function CreateUser()
    {
        $roledata = role::all();
        return view('createuser', ['roledata' => $roledata]);
    }


    // To Post User Data
    public function PostUser(Request $req)
    {
        $validate = $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cpassword' => 'required',

        ]);

        if ($validate) {
            $firstname = $req->firstname;
            $lastname = $req->lastname;
            $email = $req->email;
            $password = $req->password;
            $cpassword = $req->cpassword;
            $status = $req->radio;
            $role = $req->type;

            //    echo "$firstname and $lastname  and $email  and $password  and $cpassword  and $status and $role";

            $user = new User;

            if ($password == $cpassword) {
                $user->firstname = $firstname;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->status = $status;
                $user->role_id = $role;
                if ($user->save()) {
                    return redirect('/usermanagement');
                } else {
                    return back()->with('errMsg', 'User Not Added');
                }
            } else {
                return back()->with('errMsg', 'Password Not Match');
            }
        }
    }


    //To Delete User
    public function DeleteUser($id)
    {
        $deluser = User::find($id);
        $deluser->delete();
        return redirect('/usermanagement');
    }


    //To Edit User
    public function EditUser($id)
    {
        $edituser = User::find($id);
        $roledata = role::all();
        return view('edituser',['edituser'=>$edituser,'roledata'=>$roledata]);
    }


    //To Update User
    public function UpdateUser(Request $req)
    {
          User::where('id',$req->id)->update([
             'firstname'=>$req->firstname,
             'lastname'=>$req->lastname,
             'email'=>$req->email,
             'status'=>$req->radio,
             'role_id'=>$req->type
        ]);
        return redirect('/usermanagement');
        
        
    }

    //to show contact us
    public function ContactUs()
    {
        $contact = contact::all();
        return view('contactus',['contact'=>$contact]);
    }
}
