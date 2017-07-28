<?php

declare(strict_types=1);

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
use Illuminate\Support\MessageBag;
use PHPUnit\Framework\TestCase;

/**
 * This is the validation exception test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ValidationExceptionTest extends TestCase
{
    public function testExceptionMessageIsCorrect()
    {
        $e = new ValidationException(new MessageBag([]));

        $this->assertSame('Validation has failed.', $e->getMessage());
    }

    public function testExceptionMessageBagWorks()
    {
        $e = new ValidationException(new MessageBag(['123']));

        $this->assertSame(['123'], $e->getMessageBag()->all());
    }
}
