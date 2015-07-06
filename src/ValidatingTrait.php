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

use Illuminate\Support\Facades\Validator;

/**
 * This is the model validating trait.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait ValidatingTrait
{
    /**
     * Setup the validating observer.
     *
     * @return void
     */
    public static function bootValidatingTrait()
    {
        static::observe(new ValidatingObserver(Validator::getFacadeRoot()));
    }
}
