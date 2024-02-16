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

        # Tests des données du sujet
        $this->assertSame(gen("Key", 16), array(235,159,119,129,183,52,202,114,167,25,74,40,103,182,66,149));
        $this->assertSame(gen("Wiki", 16), array(96,68,219,109,65,183,232,231,164,214,249,251,212,66,131,84));
        $this->assertSame(gen("Secret", 16), array(4,212,107,5,60,168,123,89,65,114,48,42,236,155,185,146));
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

        # Tests des données du sujet
        $this->assertSame(cypher("Plaintext", "Key"), "bbf316e8d940af0ad3297a18578672a53d6d7c1662274bae4ab225dc649b600eb00b");
        $this->assertSame(cypher("pedia", "Wiki"), "1021bf042087d8d794e6c9cbe472b364683c88c1436497c9824037b2c59a20835817");
        $this->assertSame(cypher("Attack at dawn", "Secret"), "45a01f645fc35b383552544b9bf589a20221e405697f30472df9296f7846c0b7c241");
    }
}
