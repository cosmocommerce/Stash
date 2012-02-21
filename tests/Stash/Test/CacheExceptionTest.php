<?php

namespace Stash\Test;

use Stash\Test\Exception\ExceptionTest;
use Stash\Cache;

class CacheExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testStore()
    {
        $handler = new ExceptionTest();
        $stash = new Cache($handler);
        $stash->setupKey('path', 'to', 'store');
        $this->assertFalse($stash->isDisabled());
        $this->assertFalse($stash->store(array(1, 2, 3), 3600));
        $this->assertTrue($stash->isDisabled(), 'Is disabled after exception is thrown in handler');
    }

    public function testGet()
    {
        $stash = new Cache(new ExceptionTest());
        $stash->setupKey('path', 'to', 'get');
        $this->assertFalse($stash->isDisabled());
        $this->assertNull($stash->get());
        $this->assertTrue($stash->isDisabled(), 'Is disabled after exception is thrown in handler');
    }

    public function testClear()
    {
        $stash = new Cache(new ExceptionTest());
        $stash->setupKey('path', 'to', 'clear');
        $this->assertFalse($stash->isDisabled());
        $this->assertFalse($stash->clear());
        $this->assertTrue($stash->isDisabled(), 'Is disabled after exception is thrown in handler');
    }

    public function testPurge()
    {
        $stash = new Cache(new ExceptionTest());
        $this->assertFalse($stash->isDisabled());
        $this->assertFalse($stash->purge());
        $this->assertTrue($stash->isDisabled(), 'Is disabled after exception is thrown in handler');
    }
}
