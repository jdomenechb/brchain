<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
