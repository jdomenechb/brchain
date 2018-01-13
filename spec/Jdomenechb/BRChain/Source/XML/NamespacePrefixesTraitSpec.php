<?php
/**
 * Created by PhpStorm.
 * User: jdomenechb
 * Date: 13/1/18
 * Time: 16:31
 */

namespace spec\Jdomenechb\BRChain\Source\XML;

use Jdomenechb\BRChain\Stub\Source\XML\NamespacePrefixesTraitStub;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class NamespacePrefixesTraitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(NamespacePrefixesTraitStub::class);
    }

    public function it_accepts_namespace_prefixes()
    {
        $this->setNamespacePrefixes(['a' => 'http://url.com']);
        $this->getNamespacePrefixes()->shouldBe(['a' => 'http://url.com']);
    }
}