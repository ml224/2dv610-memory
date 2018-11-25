<?php
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class FileReaderTest extends TestCase
{
    public function tearDown() {
        m::close();
    }

    public function fakePile(int $amount){
        $stub = $this->createMock(Pile::class);
        $stub->method('getRowSize')
             ->willReturn($amount);
        
        return $stub;
    }
}


