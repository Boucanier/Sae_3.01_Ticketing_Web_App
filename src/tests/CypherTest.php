<?php
/**
 * Fichier de tests unitaires pour la classe Cypher
 * 
 * @package Tests
 */

use PHPUnit\Framework\TestCase;
include_once '../pages/cypher.php';

/**
 * Classe de tests pour la classe Cypher
 */
final class CypherTest extends TestCase
{
    /**
     * Tests de la fonction de génération de permutation
     */
    public function testKsa(): void
    {
        $this->assertSame(array_count_values(ksa(""))[0], 256);
        $this->assertSame(count(array_count_values(ksa("a"))), 256);
    }

    /**
     * Tests de la fonction de génération de suite chiffrante
     */
    public function testGen(): void
    {
        $this->assertSame(count(gen("", 128)), 128);
        $this->assertSame(count(gen("", -128)), 0);
        $this->assertSame(count(gen("", 0)), 0);
        $this->assertSame(count(gen("a", 128)), 128);
        $this->assertSame(count(gen("a", -128)), 0);
        $this->assertSame(count(gen("a", 0)), 0);
    }

    /**
     * Tests de la fonction de chiffrement
     */
    public function testcypher(): void
    {
        $this->assertSame(strlen(cypher("a", "a")), 68);
        $this->assertSame(strlen(cypher("", "a")), 68);
        $this->assertSame(strlen(cypher("a", "")), 68);
        $this->assertSame(strlen(cypher("", "")), 68);
    }
}
