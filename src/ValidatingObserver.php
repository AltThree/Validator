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

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model validating observer class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ValidatingObserver
{
    /**
     * Validate the model on saving.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @throws \AltThree\Validator\ValidationException
     *
     * @return void
     */
    public function saving(Model $model)
    {
        $this->performValidation($model);
    }

    /**
     * Validate the model on restoring.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @throws \AltThree\Validator\ValidationException
     *
     * @return void
     */
    public function restoring(Model $model)
    {
        $this->performValidation($model);
    }

    /**
     * Validate the given model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @throws \AltThree\Validator\ValidationException
     *
     * @return void
     */
    protected function validate(Model $model)
    {
        if (!$model->isValid()) {
            throw new ValidationException($model->getMessageBag());
        }
    }
}
