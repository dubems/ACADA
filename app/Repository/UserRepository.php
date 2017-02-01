<?php
/**
 * Created by PhpStorm.
 * User: proteux3
 * Date: 1/31/17
 * Time: 9:37 PM
 */

namespace App\Repository;


use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Check if the user exists before creating a new one
     *
     * @param $user
     * @param $provider
     * @return bool
     */
    public function userExists($user,$provider)
    {
        $user = $this->user->where($provider.'_id',$user->id)->first();
            return $user
                    ? $user
                    : false;
    }

    /**
     * Create User
     *
     * @param $user
     * @param $provider
     * @return mixed
     */
    public function createUser($user,$provider)
    {
       return $this->user->create([
            'name'=>$user->name,
            'email'=>$user->email,
            $provider.'_id'=>$user->id,
            'avatar' => $user->avatar
        ]);

    }

    /**
     * Update user profile
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateProfile($data,$id)
    {
        $userProfile = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'avatar'=>$data['avatar']
        ];
        return $this->user->where('id',$id)->update($userProfile)
            ? $this->user->where('id',$id)->first()
            :false;
    }
}