<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Constants\Status;

class ProfileController extends Controller
{
    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user = auth()->user();

        // Get countries from the JSON file and decode as array
        $path = resource_path('views/partials/country.json');
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));


        // Sort countries by name
        // usort($countries, function ($a, $b) {
        //     return strcmp($a['country'], $b['country']);
        // });

        return view($this->activeTemplate . 'user.profile_setting', compact('pageTitle', 'user', 'countries'));
    }

    public function submitProfile(Request $request)
    {
        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryArray = (array) $countryData;
        $countries = implode(',', array_keys($countryArray));

        $countryCode = $request->country;
        $country = $countryData->$countryCode->country;
        $dialCode = $countryData->$countryCode->dial_code;

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'country' => 'required|in:' . $countries,
        ], [
            'firstname.required' => 'First name field is required',
            'lastname.required' => 'Last name field is required'
        ]);

        $user = auth()->user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->mobile = $dialCode;
        $user->country_code = $countryCode;

        // Update the address array with the new country value if profile request is approved
        if ($user->profile_request == Status::REQUEST_APPROVE) {
            $user->mobile = $user->mobile . $dialCode;
            $user->address = [
                'address' => $request->address,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => @$country, // Add the country from request
                'city' => $request->city,
            ];
        } else {
            $user->address = [
                'address' => $request->address,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => @$user->address->country, // Keep existing country
                'city' => $request->city,
            ];
        }

        if ($request->hasFile('image')) {
            try {
                $old = @$user->image;
                $user->image = fileUploader($request->image, getFilePath('userProfile'), getFileSize('userProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }


        // dd($user);
        $user->save();
        $notify[] = ['success', 'Profile updated successfully'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {

        $passwordValidation = Password::min(6);
        if (gs('secure_password')) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', $passwordValidation]
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }
}
