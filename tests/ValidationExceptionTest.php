<?php

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

    public function testGetsMessageBag()
    {
        $messageBagMock = Mockery::mock('Illuminate\Support\MessageBag');

        $this->exception->setErrors($messageBagMock);

        $this->assertEquals($messageBagMock, $this->exception->getMessageBag());
    }
}
