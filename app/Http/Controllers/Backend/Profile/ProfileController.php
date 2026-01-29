<?php


namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the profile update page
     */
    public function index()
    {
        $authenticateUserInfo = Auth::user();
        return view('backend.profile.index', compact('authenticateUserInfo'));
    }

    /**
     * Update user profile (name and email)
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
            ]);

            $authenticateUserUpdate = Auth::user();
            $authenticateUserUpdate->name = $request->name;
            $authenticateUserUpdate->email = $request->email;
            $authenticateUserUpdate->save();

            Alert::success('Success', 'Profile updated successfully!');
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong! Please try again.');
            return back()->withInput();
        }
    }

    /**
     * Update user password
     */
    public function password(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ], [
                'new_password.confirmed' => 'The password confirmation does not match.',
                'new_password.min' => 'The password must be at least 8 characters.',
            ]);

            $user = Auth::user();

            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                Alert::error('Error', 'Current password is incorrect!');
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            Alert::success('Success', 'Password updated successfully!');
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update password. Please try again.');
            return back();
        }
    }

    /**
     * Update user profile image
     */
    public function imageUpdate(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
            ], [
                'image.required' => 'Please select an image to upload.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'Only jpeg, png, jpg, gif, and webp images are allowed.',
                'image.max' => 'The image size must not exceed 2MB.',
            ]);

            $authUserImage = Auth::user();

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($authUserImage->image) {
                    $oldImagePath = 'profile/' . $authUserImage->image;
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }

                // Store new image
                $image = $request->file('image');
                $imageUniName = 'profile-' . time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                $image->storeAs('profile', $imageUniName, 'public');

                // Update user record
                $authUserImage->image = $imageUniName;
                $authUserImage->save();

                Alert::success('Success', 'Profile image updated successfully!');
            } else {
                Alert::error('Error', 'No image file was uploaded.');
            }

            return back();
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Let validation errors pass through
            throw $e;
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to update profile image. Please try again.');
            return back();
        }
    }
}