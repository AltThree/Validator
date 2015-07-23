<?php

/*
 * This file is part of Alt Three Validator.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AltThree\Tests\Validator;

use AltThree\Validator\ValidationException;
use Mockery;

class ValidationExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \AltThree\Validator\ValidatingException
     */
    protected $exception;

    public function setUp()
    {
        $messageBagMock = Mockery::mock('Illuminate\Support\MessageBag');
        $this->exception = new ValidationException($messageBagMock);
    }

    public function testGetErrors()
    {
        $this->assertInstanceOf('Illuminate\Support\MessageBag', $this->exception->getErrors());
    }
}
