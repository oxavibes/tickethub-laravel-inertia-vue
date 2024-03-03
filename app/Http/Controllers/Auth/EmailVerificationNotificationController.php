<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
	/**
	 * Send a new email verification notification.
	 */
	public function store(Request $request): RedirectResponse
	{
		if ($request->user()->hasVerifiedEmail()) {
			redirect(Auth::user()->getRedirectRoute());
		}

		$request->user()->sendEmailVerificationNotification();

		return back()->with('status', 'verification-link-sent');
	}
}
