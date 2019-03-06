<?php

use PHPUnit\Framework\TestCase;

class FooTest extends TestCase {
    public function test_it_works() {
        $result = (new Korba\GenericView())->menu();
        $this->assertEquals(1, $result);
    }
}
