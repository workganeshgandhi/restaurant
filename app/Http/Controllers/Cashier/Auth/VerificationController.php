<?php

namespace App\Http\Controllers\Cashier\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | cashier that recently registered with the application. Emails may also
    | be re-sent if the cashier didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect cashiers after verification.
     *
     * @var string
     */
    protected $redirectTo = '/cashier';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('cashier.auth');
        $this->middleware('signed')->only('cashier.verify');
        $this->middleware('throttle:6,1')->only('cashier.verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user('cashier')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('cashier.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('cashier')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('cashier')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('cashier')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('cashier')->markEmailAsVerified()) {
            event(new Verified($request->user('cashier')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user('cashier')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('cashier')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
