<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Lib\FormProcessor;
use Illuminate\Http\Request;


class ProfileApproveController extends Controller
{
    public function settings()
    {
        $pageTitle = "User Profile Settings";
        $form = Form::where('act', 'UserProfile')->first();
        return view('admin.update_profile.settings', compact('pageTitle', 'form'));
    }

    public function settingsUpdate(Request $request)
    {
        $formProcessor = new FormProcessor();
        $generatorValidation = $formProcessor->generatorValidation();
        $request->validate($generatorValidation['rules'], $generatorValidation['messages']);
        $exist = Form::where('act', 'UserProfile')->first();
        if ($exist) {
            $isUpdate = true;
        } else {
            $isUpdate = false;
        }

        $formProcessor->generate('UserProfile', $isUpdate, 'act');

        $notfiy[] = ['success', 'User Profile Form Updated Successfully'];
        return back()->withNotify($notfiy);
    }




}