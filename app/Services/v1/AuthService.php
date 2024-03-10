<?php

namespace App\Services\v1;

use App\Interfaces\CodeSenderInterface;
use App\Models\User;
use App\Presenters\v1\StorePresenter;
use App\Presenters\v1\UserPresenter;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;
use App\Repositories\VerificationCodeRepository;
use App\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Support\Facades\DB;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Exception\InvalidArgumentException;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthService extends Service
{
    public function __construct(
        public UserRepository $userRepo,
        public VerificationCodeRepository $verificationCodeRepo
    )
    {
    }

    public function register(array $data, CodeSenderInterface $codeSender)
    {
        DB::beginTransaction();
        $user = $this->userRepo->create($data);

        $verificationCode = $this->verificationCodeRepo->get($data);
        $code = 101010;//rand(100000, 999999);
        if (is_null($verificationCode)) {
            $data['code'] = $code;
            $verificationCode = $this->verificationCodeRepo->create($data);
        } else {
            $code = $verificationCode->code;
        }

        if (!config('app.no_send_sms')) {
            $sendCode = $codeSender->send($verificationCode);
            if (!$this->isSuccess($sendCode)) {
                DB::rollBack();
                return $sendCode;
            }
        }

        DB::commit();

        return $this->ok('Успешная регистрация');
    }

    public function login(array $data)
    {
        $user = $this->userRepo->get($data);
        if (is_null($user)) {
            return $this->error(401, 'Неверные данные авторизации');
        }

        if ($user->verified_at == null) {
            return $this->error(406, 'Сначала верифицируйте аккаунт');
        }

        if (!Hash::check($data['password'], $user->password)) {
            return $this->error(401, 'Неверные данные авторизации');
        }

        $token = $user->createToken('api')->plainTextToken;

        return $this->result([
            'token' => $token,
            'user' => (new UserPresenter($user))->myProfile(),
        ]);
    }

    public function loginStore(array $data)
    {
        $storeRepo = new StoreRepository();

        $store = $storeRepo->get($data);
        if (is_null($store)) {
            return $this->error(401, 'Неверные данные авторизации');
        }

        if (!Hash::check($data['password'], $store->password)) {
            return $this->error(401, 'Неверные данные авторизации');
        }

        if ($store->active == false) {
            return $this->error(406, 'Ваш аккаунт не активен');
        }

        $token = $store->createToken('api')->plainTextToken;

        return $this->result([
            'token' => $token,
            'store' => (new StorePresenter($store->load('category')))->profile(),
        ]);
    }

    public function confirmCode(array $data) : array
    {
        $user = $this->userRepo->get($data);
        if (is_null($user)) {
            return $this->errNotFound('Пользователь не найден');
        }

        $verificationCode = $this->verificationCodeRepo->get($data);
        if (is_null($verificationCode)) {
            return $this->errNotFound('Код не найден');
        }
        if ($verificationCode->code != $data['code']) {
            return $this->errNotAcceptable('Неверный код авторизации');
        }

        $user->verified_at = Carbon::now();
        $user->save();

        $token = $user->createToken('api')->plainTextToken;

        return $this->result([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        $user = auth('api')->user();
        if (is_null($user)) {
            return $this->errFobidden('Unauthorized');
        }
        $user->tokens()->delete();
        return $this->ok();
    }

    public function loginFirebase(array $data): array
    {
        $auth = Firebase::auth();

        try {
            $verifiedIdToken = $auth->verifyIdToken($data['token']);
        } catch (InvalidArgumentException $e) {
            return $this->error(401, 'Unauthorized - Can\'t parse the token: ' . $e->getMessage());
        } catch (InvalidToken $e) {
            return $this->error(401, 'Unauthorized - Token is invalid: ' . $e->getMessage());
        } catch (FailedToVerifyToken $e) {
            return $this->error(401, 'Unauthorized - Token is invalid: ' . $e->getMessage());
        }

        $user = $this->userRepo->get([
            'firebase_uid' => $verifiedIdToken->getClaim('sub'),
        ]);

        if (is_null($user)) {
            $user = User::create([
                'name' => 'test',
                'firebase_uid' => $verifiedIdToken->getClaim('sub')
            ]);
        }

        return $this->result([
            'token' => $user->createToken('api')->plainTextToken,
            'user' => (new UserPresenter($user))->myProfile(),
        ]);
    }
}
