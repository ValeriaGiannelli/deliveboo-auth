<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use App\Models\Restaurant;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RestaurantRequest $request): RedirectResponse
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        // gestione immagini
        if ($request->hasFile('img')) {
            $data['img'] = Storage::put('uploads', $request->file('img'));
        }

        $restaurant = Restaurant::create($data);

        //controllo se sono stati inseriti tipi
        if (array_key_exists('types', $data)) {
            $restaurant->types()->attach($data['types']);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
