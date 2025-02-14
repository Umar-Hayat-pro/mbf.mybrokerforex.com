<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CopyTradingController extends Controller
{
    public function index()
	{
		$pageTitle = 'Copy Trading';
		return view('templates.basic.user.copy_trading', compact('pageTitle'));
	}
	public function followeraccess()
    {
        $pageTitle = 'follower-access';
        return view('templates.basic.user.follower_access', compact('pageTitle'));
    }

    public function provideraccess()
    {
        $pageTitle = 'provider-access';
        return view('templates.basic.user.provider_access', compact('pageTitle'));
    }
    public function ratings()
    {
        $pageTitle = 'ratings';
        return view('templates.basic.user.ratings', compact('pageTitle'));
    }
}
