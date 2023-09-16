<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display the user's profile.
     */
    public function show(Request $request, \App\Models\User $user): View
    {
        if(!isset($user)) {
            abort(404);
        }

        $profile = $user->perfil;

        return view('profile.show', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Display the user's profile edit page.
     */
    public function edit(Request $request): View
    {
        $profile = Auth::user()->perfil;
        $escolas = \App\Models\Perfil::distinct()->pluck('escola');

        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $profile,
            'escolas' => $escolas,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->perfil->fill($validated);
        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        $request->user()->perfil->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
