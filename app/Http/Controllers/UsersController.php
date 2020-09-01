<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\AddUsersRequest;
use App\Http\Requests\Users\UpdateUsersRequest;

class UsersController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Users.index')->with('users', DB::select('select *,(select count(*) from user_accounts where user_id=users.id) as cnt,(select sum(Amount) from salary_break_downs where user_id=users.id) as salary from users where deleted_at is null'));
    }


    public function create()
    {
        return view('Users.create');
    }

    // Edit Users
    public function edit(User $user)
    {
        return view('Users.create')->with('user', $user);
    }

    // Update Users 
    public function update(Request $request, User $user)
    {

        $this->validate($request,[
            'name'=> 'required',
            'email'=> 'required|unique:users,id,'.$request->id,
            'password'=>'required|min:8'
        ]);

        if($request->hasFile('image')){
            $image=$request->image->store('users');
            $user->deleteImage();
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=>$image,
                'Phone'=>$request->Phone,
                'CNSS_StartDate'=>$request->CNSS_StartDate,
                'CNSS_EndDate'=>$request->CNSS_EndDate,
                'password'=> Hash::make($request->password)
            ]);
        }else{
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'Phone'=>$request->Phone,
                'CNSS_StartDate'=>$request->CNSS_StartDate,
                'CNSS_EndDate'=>$request->CNSS_EndDate,
                'password'=> Hash::make($request->password)
            ]);
        }

      
    
   
     return redirect(route('users.index'));
    }

    // Save users in database 
    public function store(AddUsersRequest $request)
    {
        $image='';
  if($request->image!=null)
        $image=$request->image->store('users');
        User::create([ 
            'name' => $request->name,
            'email' => $request->email,
            'Phone'=>$request->Phone,
            'CNSS_StartDate'=>$request->CNSS_StartDate,
            'CNSS_EndDate'=>$request->CNSS_EndDate,
            'password' => Hash::make($request->password),
            'image'=>$image
        ]);
        return redirect(route('users.index'));
    }
    public function destroy(User $user)
    {
        $user->deleteImage();
        $user->delete();
        return redirect(route('users.index'));
    }
}
