<?php

namespace App\Repositories\User;

use App\Models\Settings;
use App\Models\User;

use App\Repositories\Base\Abstract\AbstractRepository;

use App\Repositories\Base\Traits\HasGet;
use App\Repositories\Base\Traits\HasUpdate;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserRepository extends AbstractRepository
{
    private $testPeriod = 30;

    public function __construct()
    {
        $this->model = new User();
    }

    use HasGet;
    use HasUpdate;

    public function create($data)
    {
        DB::transaction(function () use ($data) {
            $data['password'] = bcrypt($data['password']);

            $data['activation_token'] = Str::random(60);

            $user = $this->model::create($data);

            Settings::create(["user_id" => $user->id]);
        });

        return $this->model::where('email', $data['email'])->first();
    }

    public function getResetPasswordToken($email)
    {
        $user = $this->model->where('email', $email)->first();

        $token = Str::random(60);

        $user->update([
            "password_reset_token" =>  $token,
        ]);

        return $token;
    }

    public function validatePasswordToken($token, $email)
    {
        $user = $this->model->where('email', $email)->where('password_reset_token', $token)->first();

        return $user;
    }


    public function changePassword($email, $token, $newPassword)
    {
        $newPassword = bcrypt($newPassword);

        $user = User::where('email', $email)->where('password_reset_token', $token)->first();

        $user->update([
            "password" =>  $newPassword,
            "password_reset_token" => null
        ]);

        return $user;
    }


    public function updateAvatar($id, $avatar)
    {
        DB::transaction(function () use ($id, $avatar) {
            $user = $this->model::find($id);

            if ($user) {
                $path = Storage::disk('public')->putFile('uploaded', $avatar);

                $user->update([
                    "avatar_url" => $path,
                ]);
                return $user;
            }
        });
    }

    public function validateCode($token)
    {
        $user = $this->model->where("activation_token", $token)->first();

        if (!$user) {
            return false;
        }

        $user->update([
            "activation_token" => null,
        ]);

        return $this->activateUser($user->id);
    }

    public function activateUser($id)
    {
        $user = $this->model::find($id)->update(["user_verified_at" => now()]);;
        return $user;
    }
    public function updateSub($id)
    {
        $user = $this->model::find($id)->update(["sub_date" => now()->addDays($this->testPeriod)]);;
        return $user;
    }

    public function updateExpo($id, $token)
    {
        $user = $this->model::find($id)->update(["expo_token" => $token]);
        return $user;
    }
}
