<?php

/*
 * This file is part of Alt Three Validator.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AltThree\Validator;

use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Support\MessageBag;
use RuntimeException;

/**
 * This is the validating exception class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ValidationException extends RuntimeException implements MessageProvider
{
    /**
     * The validation errors.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Make a new validation exception instance.
     *
     * @param \Illuminate\Support\MessageBag $errors
     *
     * @return void
     */
    public function __construct(MessageBag $errors)
    {
        $this->setErrors($errors);

        parent::__construct('Validation has failed.');
    }

    /**
     * Get the validation errors.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this->getErrors();
    }

    /**
     * Sets the validation errors.
     *
     * @param \Illuminate\Support\MessageBag $errors
     */
    public function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;
    }
}
