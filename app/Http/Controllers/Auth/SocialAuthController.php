<?php
/**
 * Created by PhpStorm.
 * User: proteux3
 * Date: 1/31/17
 * Time: 9:03 PM
 */

namespace App\Http\Controllers\Auth;

use App\Repository\UserRepository;
use App\User;
use Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * SocialAuthController constructor.
     * @param User $user
     * @param UserRepository $userRepository
     */
    public function __construct(User $user,UserRepository $userRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    /**
     * Check if the user exists
     *
     * @param $user
     * @param $provider
     * @return bool
     */
    public function exists($user,$provider)
    {
        return $this->userRepository->userExists($user,$provider);
    }

    /**
     * Redirect request to facebook for login
     *
     * @return mixed
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle facebook response
     */
    public function handleFacebookCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();

        }catch(Exception $e)
        {
            return redirect('/login');
        }

        if ( $authUser = $this->exists($user,'facebook'))
        {
            return $this->loginUser($authUser);
        }
        
        $user =  $this->userRepository->createUser($user,'facebook');

        return $this->loginUser($user);
        
    }

    public function redirectToGoogle()
    {

    }

    public function handleGoogleCallback()
    {

    }

    public function loginUser($user)
    {
        Auth::login($user);
        return redirect('/home');
    }
}