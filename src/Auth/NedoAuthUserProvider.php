<?php

namespace Nedoquery\Auth;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Nedoquery\Api\NedoRequest;

class NedoAuthUserProvider implements UserProvider {

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    
    /**
     *
     * Request class to send data to Nedo server
     * 
     * @var \Nedoquery\Api\NedoRequest 
     */
    protected $nedoRequest;
    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @return void
     */
    public function __construct(HasherContract $hasher, NedoRequest $nedoRequest)
    {
        $this->hasher = $hasher;
        $this->nedoRequest = $nedoRequest;
    }

    public function retrieveByCredentials(array $credentials) {
        
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('password', $credentials))) {
            return;
        }
        $credentials['mobile'] = true;
        
        $result = $this->nedoRequest->request('auth/login.json', $credentials, [], false);
        $user = null;
        
        if (!$result->success) {
            $result = (object) [
                'success' => false,
            ];
        }
        
        if ($result->success){
            $user = new \stdClass();
            $user->user_token = $result->token;
            $user->user_id = $result->user->user_id;
            $user->user_name = $result->user->user_name;
            $user->user_email = $result->user->user_email;
            $user->user_type = $result->user->user_type;
            $user->user_username = $result->user->user_username;
            $user->user_role = $result->user->user_role;
            $user->user_organization = $result->user->user_organization;
            $user->id = json_encode($user);
            $user->remember_token = false;
        }
        
        $genericUser = $this->getGenericUser($user);
        return $genericUser;
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new GenericUser((array) $user);
        }
    }

    public function retrieveById($identifier) {
        $objIndentifier = json_decode($identifier);
        
        $result = $this->nedoRequest->request('user/info.json', [], 
                [
                    'Triton-token' => $objIndentifier->user_token,
                    'Triton-role' => $objIndentifier->user_role->role_id
                ], 
        false);
        
        if ($result == null){
            return null;
        }
        
        $user = new \stdClass();
        $user->user_token = $objIndentifier->user_token;
        $user->user_id = $result->user_id;
        $user->user_name = $result->user_name;
        $user->user_email = $result->user_email;
        $user->user_type = $result->user_type;
        $user->user_username = $result->user_username;
        $user->user_role = $result->user_role;
        $user->user_organization = $result->user_organization;
        $user->remember_token = false;
        
        $genericUser = $this->getGenericUser($user);
        
        
        return $genericUser;
    }

    public function retrieveByToken($identifier, $token) {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token) {
        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        
        $plain = $credentials['username'];
        if ($plain === $user->user_username){
            return TRUE;
        }
        return FALSE;
    }
}