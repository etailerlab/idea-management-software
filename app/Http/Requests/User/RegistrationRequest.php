<?php

namespace App\Http\Requests\User;

/**
 * Class RegistrationRequest
 * @package App\Http\Requests\User
 */
class RegistrationRequest extends AbstractRequest
{
    /**
     * @return array
     */
    protected function getEmailValidator() : array
    {
        return ['email' => 'required|email|unique:users,email'];
    }
}
