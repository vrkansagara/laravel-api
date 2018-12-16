<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class RoleValidator.
 *
 * @package namespace App\Validators;
 */
class RoleValidator extends LaravelValidator
{

    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|min:3|max:191|unique:roles',
            'display_name' => 'required|min:3|max:191',
            'guard_name' => 'required|min:3|max:191',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'display_name' => 'required|min:3|max:191',
            'guard_name' => 'required|min:3|max:191',
        ],
    ];


    protected $messages = [
        'required' => 'The :attribute field is required.',
    ];
}
