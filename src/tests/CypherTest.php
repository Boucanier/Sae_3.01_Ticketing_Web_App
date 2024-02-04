<?php

use PHPUnit\Framework\TestCase;
include_once '../pages/cypher.php';

final class CypherTest extends TestCase
{
    public function testKsa(): void
    {
        $this->assertSame(array_count_values(ksa(""))[0], 256);
        $this->assertSame(count(array_count_values(ksa("a"))), 256);
    }

    public function testGen(): void
    {
        $this->assertSame(count(gen("", 128)), 128);
        $this->assertSame(count(gen("", -128)), 0);
        $this->assertSame(count(gen("", 0)), 0);
        $this->assertSame(count(gen("a", 128)), 128);
        $this->assertSame(count(gen("a", -128)), 0);
        $this->assertSame(count(gen("a", 0)), 0);
    }

    public function testcypher(): void
    {
        $this->assertSame(strlen(cypher("a", "a")), 68);
        $this->assertSame(strlen(cypher("", "a")), 68);
        $this->assertSame(strlen(cypher("a", "")), 68);
        $this->assertSame(strlen(cypher("", "")), 68);
    }
}
