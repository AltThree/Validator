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

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model validating observer class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ValidatingObserver
{
    /**
     * The validation factory instance.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $factory;

    /**
     * Create a new validating observer instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     *
     * @return void
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

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
        $this->validate($model);
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
        $this->validate($model);
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
        $attributes = $model->getAttributes();

        $messages = isset($model->validationMessages) ? $model->validationMessages : [];

        $validator = $this->factory->make($attributes, $this->getRules($model), $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator->getMessageBag());
        }
    }

    /**
     * Get the model validation rules.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return array
     */
    public function getRules($model)
    {
        $rules = $model->rules;

        if (!$model->exists) {
            return $rules;
        }

        foreach ($rules as $field => $ruleset) {
            $ruleset = is_string($ruleset) ? explode('|', $ruleset) : $ruleset;

            foreach ($ruleset as $rule) {
                if (starts_with($rule, 'unique')) {
                    $rules[$field] = $this->addExceptId($model, $rule);
                }
            }
        }

        return $rules;
    }

    /**
     * Add except id to unique rules.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $rule
     *
     * @return string
     */
    public function addExceptId($model, $rule)
    {
        $chunks = explode(',', $rule);

        if ($chunks >= 1) {
            if (!isset($chunks[2]) || strtolower($chunks[2]) === 'null') {
                $chunks[2] = $model->getKey();
            }

            if (!isset($chunks[3])) {
                $chunks[3] = $model->getKeyName();
            }
        }

        return implode(',', $chunks);
    }
}
