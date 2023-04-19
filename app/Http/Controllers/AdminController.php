<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
  public function index(){
    return view('admin.index');
  }

    public function add_user(Request $request)
    {
        if ($request->isMethod('POST')){
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'sex' => 'required|string',
                'phone' => 'required|string|min:11|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
                'user_type' => 'required|string',
            ]);
            if ($validator->fails()) {
//        return $validator->messages();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            try {

                $user = new User();
                $user->name = $data['name'];
                $user->phone = $data['phone'];
                $user->email = $data['email'];
                $user->type = $data['user_type'];
                $user->sex = $data['sex'];
                $user->password = Hash::make($data['password']);
                $user->status = strtolower($data['status']);
//                Mail::to($data['email'])->send(new SendPassword($data['password'],$data['name']))
                if ($user->save()) {
                    $this->__alert('s', '<strong>Congratulation!! </strong> User added successful.');
                    return redirect()->back();

                }

                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            } catch (QueryException $e) {
                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            }
        }
        return view('admin.user.add');
  }

    public function view_user()
    {
        $users = User::whereIn('type' ,['customer','manager'])->get();
        return view('admin.user.view',compact('users'));
  }

    public function edit_user(Request $request, $id)
    {
        $user = User::findOrfail($id);
        if ($request->isMethod('post')){
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'sex' => 'required|string',
                'phone' => 'required|string|min:11|unique:users,phone,'. $user->id,
                'email' => 'required|email|unique:users,email,'. $user->id,
                'user_type' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            try {
                if (isset($data['password']) == null) {
                    $user_date =[
                        'name' => $data['name'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                        'type' => $data['user_type'],
                        'sex' => $data['sex'],
                        'status' => $data['status'],
                    ];
                }else{
                    $user_date =[
                        'name' => $data['name'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                        'type' => $data['user_type'],
                        'sex' => $data['sex'],
                        'status' => $data['status'],
                        'password' =>  Hash::make($data['password'])
                    ];
                }
//                return $user_date;
//                Mail::to($data['email'])->send(new SendPassword($data['password'],$data['name']));
                $update = User::find($user->id)->update($user_date);
//            return $update;

                if ($update) {
                    $this->__alert('s', '<strong>Congratulation!! </strong> User Update successful.');
                    return redirect()->route('admin.user.view');
                }

                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            } catch (QueryException $e) {
                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            }

        }
        return view('admin.user.edit',compact('user'));
  }

    public function delete_user(Request $request)
    {
        if ($request->isMethod('DELETE')) {
            $id = $request->post('id');
            $hotel = User::find($id);
            if ($hotel->delete()) {
                return 'success';
            }
        }
  }

    public function change_password(Request $request)
    {
        if ($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'old_password' => 'required|min:8',
                'new_password' => 'required|min:8',
                'confirm_password' => 'same:new_password|min:8',

            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = Auth::user();
            if(Auth::guard('web')->attempt(['id'=>$user->id,'password' =>$request->post('old_password')])) {
//                return 'true';
                $user->password = Hash::make($request->post('confirm_password'));
                $user->save();
                $this->__alert('s', '<strong>Congratulation!! </strong> Password Update successful.');
                return redirect()->back();
            }
            else{
                $this->__alert('w', '<strong>Sorry!!! </strong>Old Password doesn not match.');
                return redirect()->back()->withInput();
            }
        }
        return view('admin.change_password');
    }
    public function change_profile(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'sex' => 'required|string',
                'phone' => 'required|string|min:11',
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            try {
                    $user_date =[
                        'name' => $data['name'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                        'sex' => $data['sex'],

                    ];
                $update = User::where('id', auth()->id())->update($user_date);
                if ($update) {
                    $this->__alert('s', '<strong>Congratulation!! </strong> User Update successful.');
                    return redirect()->back();
                }

                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            } catch (QueryException $e) {
                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            }

        }
        return view('admin.profile');
    }

}
