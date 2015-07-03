<?php

/*
 * This file is part of Alt Three Validator.
 *
 * (c) Alt Three LTD <support@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AltThree\Validator;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

/**
 * This is the model validating trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait ValidatingTrait
{
    /**
     * The error messages from the validator.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $validationErrors;

    /**
     * Setup the validating observer.
     *
     * @return void
     */
    public static function bootValidatingTrait()
    {
        static::observe(new ValidatingObserver());
    }

    /**
     * Is the model valid?
     *
     * @return bool
     */
    public function isValid()
    {
        $attributes = $this->getAttributes();

        $messages = isset($this->validationMessages) ? $this->validationMessages : [];

        $validator = Validator::make($attributes, $this->rules, $messages);

        $result = $validator->passes();

        $this->validationErrors = $validator->getMessageBag();

        return $result;
    }

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this->validationErrors ?: new MessageBag();
    }
}
