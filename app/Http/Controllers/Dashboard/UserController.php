<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Dashboard\hash;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');

    }


    public function index(Request $request)
    {
        /** first method to search*/
        $users =User::whereRoleIs('admin')->where(function ($q) use ($request){
        return $q->when($request->input('search'),function ($query) use ($request){
            return $query->where('first_name','like','%'.$request->input('search').'%')
                ->orWhere('last_name','like','%'.$request->input('search').'%');

        });
        })->latest()->paginate(5);

        /** second method to search*/
       /*
         if($request->input('search')){
        $users=User::where('first_name','like','%'.$request->input('search').'%')
       ->orWhere('last_name','like','%'.$request->input('search').'%')->get();

        }else{

            $users =User::whereRoleIs('admin')->get();
        }
       */
        return view("dashboard.users.index",compact('users'));


    }


    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:users',
            'image'=>'image',
            'permissions'=>'required',
            'password'=>'required|confirmed',
         ]);
        $request_data=$request->except('password,password_confirmation,permissions,image');
        $request_data['password']=bcrypt($request->input('password'));

        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore =$filename.'_'.time().'.'.$extension;
            // Upload Image ده الي بينقل الصوره للمكان الي عايزه
            $path = $request->file('image')->storeAs('public/uploads/user_images',$fileNameToStore);

            $request_data['image'] = $fileNameToStore;
        }
//        if($request->input('image')) {
//          Image::make($request->input('image'))
//              ->resize(300, null, function ($constraint) {
//              $constraint->aspectRatio();
//          })->save(public_path('uploads/user_images/'.$request->input('image')->hashName()));
//
//
//            //$request_data['image']=$request->input('image')->store('images','public');
//          }
//        $file = $request->file('image');
//        $file->store('toPath', ['public' => 'uploads']);
//
//        if(!Storage::disk('public_uploads')->put($path, $file_content)) {
//            return false;
//        }

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->input('permissions'));

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');

    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required',Rule::unique('users')->ignore($user->id)],
            'image'=>'image',
            'permissions'=>'required',
        ]);
        $request_data=$request->except('permissions','image');
      if($request->image){
        if($user->image != 'default.png'){

        Storage::disk('public')->delete('/uploads/user_images/'.$user->image);

    }
          // Get filename with the extension
          $filenameWithExt = $request->file('image')->getClientOriginalName();
          //Get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          // Get just ext
          $extension = $request->file('image')->getClientOriginalExtension();
          // Filename to store
          $fileNameToStore =$filename.'_'.time().'.'.$extension;
          // Upload Image ده الي بينقل الصوره للمكان الي عايزه
          $path = $request->file('image')->storeAs('public/uploads/user_images',$fileNameToStore);

          $request_data['image'] = $fileNameToStore;

}

        $user->update($request_data);
        $user->syncPermissions($request->input('permissions'));
        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');


    }

    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
            Storage::disk('public')->delete('/uploads/user_images/'.$user->image);

        }
        $user->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');


    }
}
