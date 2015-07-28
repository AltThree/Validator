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

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Support\MessageProvider;
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
     * @var \Illuminate\Contracts\Support\MessageBag
     */
    protected $errors;

    /**
     * Make a new validation exception instance.
     *
     * @param \Illuminate\Contracts\Support\MessageBag $errors
     *
     * @return void
     */
    public function __construct(MessageBag $errors)
    {
        $this->errors = $errors;

        parent::__construct('Validation has failed.');
    }

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this->errors;
    }

    /**
     * Get the string representation of the exception.
     *
     * @return string
     */
    public function __toString()
    {
        $lines = explode("\n", parent::__toString());

        return array_shift($lines)." \nValidation errors:\n".implode($this->errors->all(), "\n")."\n".implode($lines, "\n");
    }
}
