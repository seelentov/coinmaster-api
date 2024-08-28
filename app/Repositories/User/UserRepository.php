<?php

namespace App\Repositories\User;

use App\Models\Settings;
use App\Models\User;
use App\Models\UserVerifier;

use App\Repositories\Base\Abstract\AbstractRepository;

use App\Repositories\Base\Traits\HasGet;
use App\Repositories\Base\Traits\HasUpdate;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            $data['password'] = bcrypt("password");
            $data['user_verified_at'] = now();
            $user = $this->model::create($data);
            $verifier = [];
            $verifier['phone'] = $data['phone'];
            $code = bcrypt(fake()->randomNumber(6, true));
            $verifier['code'] = $code;
            UserVerifier::create($verifier);
            Settings::create(["user_id" => $user->id]);
        });
    }

    public function verify($phone, $code)
    {
        $verifiersQuery = UserVerifier::where('phone', $phone);

        foreach ($verifiersQuery->get() as $verifier) {
            if (Hash::check($code, $verifier->code)) {
                $verifiersQuery->delete();
                $this->model::where("phone", $phone)->update(["user_verified_at" => now()]);
                return true;
            }
        }

        return false;
    }

    public function updateAvatar($id, $avatar)
    {
        DB::transaction(function () use ($id, $avatar) {
            $user = $this->model::find($id);

            if ($user) {
                $path = Storage::disk('public')->putFile('images', $avatar);

                $user->update([
                    "avatar_url" => $path,
                ]);
                return $user;
            }
        });
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
