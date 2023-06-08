<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Master;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::all();
        $aspek = Master::where('jenis','Aspek')->get();
        $data = [
            'user'=>$user,
            'aspek'=>$aspek
        ];
        // return $data;
        return view("user",$data);
    }

    public function create()
    {
        $aspek = Master::where('jenis','Aspek')->get();
        return view("newuser",['aspek'=>$aspek]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=> ['required'],
        ]);
        
        if($request->role == "Admin"){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'id_master' => 0
            ]);
        }
        else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'id_master' => $request->id_master,
            ]);
        }

        // event(new Registered($user));

        // Auth::login($user);

        return redirect("/user")->with("success","Berhasil");
    }
    /**
     * Display the user's profile form.
     */
    public function edit($id): View
    {
        $data = User::find($id);
        // dd($data);
        $aspek = Master::where('jenis','Aspek')->get();
        return view("edituser",['data'=>$data,'aspek'=>$aspek]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'role'=> ['required'],
        ]);
        $user = User::find($id);
        if($request->role == "Admin"){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->id_master = $request->id_master;
        }
        $user->save();
        // $user->update($request->all());

        // event(new Registered($user));

        // Auth::login($user);

        return redirect("/user")->with("success","Berhasil");
    }

    /**
     * Delete the user's account.
     */
    public function destroy($id)
    {
        
        $user = User::find($id);

        $user->delete();


        return redirect("/user")->with("warning","Berhasi");
    }
}
