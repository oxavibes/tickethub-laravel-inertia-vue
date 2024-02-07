<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * The list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 */
	public function register(): void
	{
		$this->reportable(function (Throwable $e) {
			//
		});
	}

	/**
	 * A list of error messages
	 *
	 * @var array<int, string>
	 */
	protected $messages = [
		500 => 'Something went wrong',
		503 => 'Service unavailable',
		404 => 'Not found',
		403 => 'Not authorized',
	];

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Throwable
	 */
	public function render($request, Throwable $e)
	{
		$response = parent::render($request, $e);

		$status = $response->getStatusCode();

		if (app()->environment(['local', 'testing'])) {
			return $response;
		}

		if (!array_key_exists($status, $this->messages)) {
			return $response;
		}

		if (!$request->isMethod('GET')) {
			return back()
				->setStatusCode($status)
				->with('error', $this->messages[$status]);
		}

		return Inertia::render('Error', [
			'status' => $status,
		])
			->toResponse($request)
			->setStatusCode($status);
	}
}
