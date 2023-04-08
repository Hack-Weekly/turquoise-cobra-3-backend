<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email'))
        {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function saveAvatar(Request $request, User $user)
    {
        try
        {
            $request->validate(
                [
                    "image" => "required|mimes:jpg,jpeg,png|image|max:2048"
                ],
                [
                    "image.required" => "Please Select An Image To Upload",
                    "image.mimes" => "Only .jpg,.jpeg or .png files allowed",
                    "image.image" => "Only Images Allowed",
                    "image.max" => "Maximum Allowed Image Size : 2048 Kilobyte"
                ]
            );
            $path = $request->image->storePublicly('user-avatars', "public");
            $path = URL::to('/') . "/storage/" . $path;
            $user->avatar = $path;
            $user->save();
        }
        catch (\Exception $e)
        {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
        return response()->json([
            "url" => $user->avatar
        ]);
    }
}
