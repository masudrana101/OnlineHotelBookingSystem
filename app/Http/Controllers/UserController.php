<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function login(Request $request)
  {
    if ($request->isMethod("POST")) {
      $data = $request->all();
      $validator = Validator::make($data, [
        'email' => 'required|email',
        'password' => 'required|min:8',
      ]);
      if ($validator->fails()) {
//          return $validator->messages();
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try {

        $user = User::where('email', $data['email'])->first();
        if (isset($user)) {
          if ($user->type != 'customer' && $user->type != 'manager') {
            $this->__alert('w', '<strong>Sorry!!! </strong> You cann\'t login .');
            return redirect()->back()->withInput();
          }
          if ($user->status != 'active') {

            $this->__alert('w', '<strong>Sorry!!! </strong> Your account is inactive.');
            return redirect()->back()->withInput();
          }
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
          if ($user->type == 'manager') {
            return redirect()->route('manager.dashboard');
          }
          return redirect()->route('customer.dashboard');
        }
        $this->__alert('e', '<strong>Sorry!!! </strong> Your credential is incorrect.');
        return redirect()->back()->withInput();
      } catch (QueryException $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong> Something went wrong.');
        return redirect()->back()->withInput();
      }
    }
    return view('auth.login');
  }


  public function register(Request $request)
  {
    if ($request->isMethod('post')) {
      $data = $request->all();
      $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'phone' => 'nullable|string|max:15|unique:users',
        'sex' => 'required|string|max:10',
        'password' => 'required|string|min:8',
        'confirm_password' => 'required|min:8|same:password',
      ]);
      if ($validator->fails()) {
//          return $validator->messages();
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
//      return $data;
      try {
        $user = new User();
        $user->name = $data['name'];
        if (isset($data['phone'])) {
          $user->phone = $data['phone'];
        }
        $user->email = $data['email'];
        $user->sex = strtolower($data['sex']);
        $user->password = Hash::make($data['password']);
//        return $user;
        if ($user->save()) {
          $this->__alert('s', '<strong>Congratulation!!! </strong> Customer created Successful');
          return redirect()->route('login');
        }
        $this->__alert('w', 'Something went wrong');
        return redirect()->back()->withInput();
      } catch (QueryException $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong>Something Went wrong');
        return redirect()->back()->withInput();
      }
    }
    return view('auth.register');
  }


  public function admin_login(Request $request)
  {
    if ($request->isMethod("POST")) {
      $data = $request->all();
      $validator = Validator::make($data, [
        'email' => 'required|email',
        'password' => 'required|min:6',
      ]);
      if ($validator->fails()) {
//          return $validator->messages();
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try {
        $user = User::where('email', $data['email'])->first();
        if (isset($user)) {
          if ($user->type != 'admin') {
            $this->__alert('w', '<strong>Sorry!!! </strong> You cann\'t login as Admin.');
            return redirect()->back()->withInput();
          }
          if ($user->status != 'active') {
            $this->__alert('w', '<strong>Sorry!!! </strong> Your account is inactive.');
            return redirect()->back()->withInput();
          }
        }
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
          return redirect()->route('admin.dashboard');
        }
        $this->__alert('e', '<strong>Sorry!!! </strong> Your credential is incorrect.');
        return redirect()->back()->withInput();
      } catch (QueryException $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong> Something went wrong.');
        return redirect()->back()->withInput();
      }
    }
    return view('admin.auth.login');
  }


  public function manager_login(Request $request)
  {
    if ($request->isMethod("POST")) {
      $data = $request->all();
      $validator = Validator::make($data, [
        'email' => 'required|email',
        'password' => 'required|min:6',
      ]);
      if ($validator->fails()) {
//          return $validator->messages();
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
//      return $data;
      try {
        $user = User::where('email', $data['email'])->first();
        if (isset($user)) {
          if ($user->type != 'manager') {
            $this->__alert('w', '<strong>Sorry!!! </strong> You cann\'t login as Hotel Manager.');
            return redirect()->back()->withInput();
          }
          if ($user->status != 'active') {
            $this->__alert('w', '<strong>Sorry!!! </strong> Your account is inactive.');
            return redirect()->back()->withInput();
          }
        }
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
          return redirect()->route('manager.dashboard');
        }
        $this->__alert('e', '<strong>Sorry!!! </strong> Your credential is incorrect.');
        return redirect()->back()->withInput();
      } catch (QueryException $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong> Something went wrong.');
        return redirect()->back()->withInput();
      }
    }
    return view('manager.auth.login');
  }


  public function change_password(Request $request)
  {
    if ($request->isMethod('post')) {
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
      try {
        if (Auth::guard('web')->attempt(['id' => $user->id, 'password' => $request->post('old_password')])) {
//                return 'true';
          $userPassword = Hash::make($request->post('confirm_password'));
          if (User::where('id', $user->id)->update(['password'=>$userPassword])) {
            $this->__alert('s', '<strong>Congratulation!! </strong> Password Update successful.');
            return redirect()->route('customer.dashboard');
          }
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        } else {
          $this->__alert('w', '<strong>Sorry!!! </strong>Old Password doesn not match.');
          return redirect()->back()->withInput();
        }
      } catch (\Exception $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
        return redirect()->back()->withInput();
      }
    }
    return view('customer.change_password');
  }

  public function change_profile(Request $request)
  {
    if ($request->isMethod('post')) {
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
        $user_date = [
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
    return view('customer.profile');
  }


}
