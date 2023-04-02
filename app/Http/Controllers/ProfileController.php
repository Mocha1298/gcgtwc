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
use App\Models\Aspect;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $data = User::all();
        $aspek = Aspect::all();
        return view("user",['data'=>$data,'aspek'=>$aspek]);
    }

    public function create()
    {
        $aspek = Aspect::all();
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
            ]);
        }
        else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'id_aspek' => $request->id_aspek,
            ]);
        }

        // event(new Registered($user));

        // Auth::login($user);

        return redirect("/user")->with("cek","simpan");
    }
    /**
     * Display the user's profile form.
     */
    public function edit($id): View
    {
        $data = User::find($id);
        // dd($data);
        $aspek = Aspect::all();
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
        $user->update($request->all());

        // event(new Registered($user));

        // Auth::login($user);

        return redirect("/user")->with("cek","edit");
    }

    /**
     * Delete the user's account.
     */
    public function destroy($id)
    {
        
        $user = User::find($id);

        $user->delete();


        return redirect("/user")->with("cek","hapus");
    }
}
