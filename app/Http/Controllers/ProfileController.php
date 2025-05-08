<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');

        $user = $request->user();
        $data = $request->validated();

        // Handle new profile image, if provided
        if ($request->hasFile('image')) {
            // Optionally delete old image here:
            \Storage::delete('uploads/profile/'.$user->image);

            $uploaded = $request->file('image');
            $filename = $uploaded->hashName();
            $uploaded->move(public_path('uploads/profile'), $filename);
            $data['image'] = $filename;
        }

        // If they changed their email, reset the verification timestamp
        if ($user->email !== $data['email']) {
            $data['email_verified_at'] = null;
        }

        // Mass‑assign & save
        $user->fill($data)->save();

        return Redirect::route('profile.edit')
                       ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        // $user = $request->user();

        // Auth::logout();

        // $user->delete();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return Redirect::to('/');

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    
        $user = $request->user();
    
        // 1) Delete the profile image file if it exists
        if ($user->image) {
            Storage::delete('uploads/profile/'.$user->image);
        }
    
        Auth::logout();
    
        // 2) Delete the user record
        $user->delete();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return Redirect::to('/');
    }
}
