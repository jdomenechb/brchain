<?php
/**
 * Created by PhpStorm.
 * User: jdomenechb
 * Date: 13/1/18
 * Time: 3:08
 */

namespace Jdomenechb\BRChain\Source\XML;

/**
 * Trait for helping implementing namespace prefixes.
 * @package Jdomenechb\BRChain\Source\XML
 */
trait NamespacePrefixesTrait
{
    /**
     * Given a prefix as key and a namespace as value, nodes in the namespace will be able to be accessed using in the
     * path the prefix given.
     * @var string[]
     */
    protected $namespacePrefixes = [];

    /**
     * @return string[]
     */
    public function getNamespacePrefixes(): array
    {
        return $this->namespacePrefixes;
    }

    /**
     * @param string[] $namespacePrefixes
     */
    public function setNamespacePrefixes(array $namespacePrefixes): void
    {
        $this->namespacePrefixes = $namespacePrefixes;
    }
}