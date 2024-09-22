<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\ResetPasswordRequest;
use App\Http\Requests\PasswordReset\SendResetLinkRequest;
use App\Mail\ResetPasswordMail;
use App\Mail\ResetPasswordMailSuccess;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function __construct(
        private readonly UserRepository $users
    ) {}

    public function sendResetLink(SendResetLinkRequest $request)
    {
        $request = $request->validated();

        $resetToken = $this->users->getResetPasswordToken($request["email"]);

        $resetLink = route('password.reset', ['token' => $resetToken, 'email' => $request["email"]]);

        Mail::to($request["email"])->send(new ResetPasswordMail($resetLink));

        return response()->json(['authorization' => __("authorization.SEND_TO_EMAIL")]);
    }

    public function showResetForm($token, $email)
    {
        $user = $this->users->validatePasswordToken($token, $email);

        if (!$user) {
            return view('message')->with("message", __("authorization.PASS_CHANGE_LINK_ERR"));
        }

        return view('auth.passwords.reset', compact('token', 'email'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $request = $request->validated();

        $email = $request["email"];
        $token = $request["token"];
        $password = $request["password"];
        $password_confirmation = $request["password_confirmation"];

        if ($password !== $password_confirmation) {
            return redirect()->route('password.reset', ['token' => $token, 'email' => $email, "message" => __("authorization.PASS_CHANGE_NOT_SAME")]);
        }

        $user = $this->users->changePassword(
            email: $email,
            token: $token,
            newPassword: $request["password"]
        );

        if (!$user) {
            return back()->withErrors(['email' => __("authorization.PASS_CHANGE_ERR")]);
        }

        Mail::to($user->email)->send(new ResetPasswordMailSuccess());

        return view('message')->with("message", __("authorization.PASS_CHANGE_OK"));
    }
}
