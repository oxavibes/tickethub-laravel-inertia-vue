<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
	/**
	 * Display the email verification prompt.
	 */
	public function __invoke(Request $request): RedirectResponse|Response
	{
		return $request->user()->hasVerifiedEmail()
			? redirect(Auth::user()->getRedirectRoute())
			: Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
	}
}
