<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {        
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        
        $user = [
            'name'=>$input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'works_at' => $input['works_at'] ?? auth()->user()->organization->getRoot()->id
        ];        
        
        if(array_key_exists('position_id', $input)){
            $user['position_id'] = $input['position_id'];            
        }        
        return User::create($user);        
    }

    public function validate(array $input)
    {
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : ''     
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(', ',$errors->all());
            return $errorMessages;
        }
        return "";
    }

    public function update(array $input)
    {   
            if(is_null($input['password'])){
                unset($input['password']);
                unset($input['password_confirmation']);
            }
            
            Validator::make($input, [
                'id' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$input['id']],  
                'password' => ['confirmed', 'min:8'],
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
            
            $user = [
                'name'=>$input['name'],
                'email' => $input['email']                
            ];        
            
            if(array_key_exists('position_id', $input)){
                $user['position_id'] = $input['position_id'];                
            }        
            
            if(array_key_exists('works_at', $input)){                
                $user['works_at'] = $input['works_at'];
            }        

            if(array_key_exists('password', $input)){                
                $user['password'] = Hash::make($input['password']);
            }

            User::find($input['id'])
            ->update($user);
    }
    public function updateValidate(array $input)
    {   
        if(is_null($input['password'])){
            unset($input['password']);
            unset($input['password_confirmation']);
        }
        // dd($input);
        $validator = Validator::make($input, [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$input['id']],
            'password' => ['confirmed', 'min:8'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : ''     
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(', ',$errors->all());
            return $errorMessages;
        }
        return "";
    }
}
