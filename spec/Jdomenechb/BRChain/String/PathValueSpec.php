<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\String;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\AbstractString;
use Jdomenechb\BRChain\String\PathValue;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class PathValueSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PathValue::class);
    }

    public function it_is_a_common_string_item()
    {
        $this->shouldBeAnInstanceOf(AbstractString::class);
    }

    public function it_accepts_options_via_constructor(StringInterface $string)
    {
        $this->beConstructedWith(['path' => $string]);
        $this->getPath()->shouldBe($string);
    }

    public function it_accepts_a_path(StringInterface $path)
    {
        $path->__toString()->willReturn('/a/path');

        $this->setPath($path);
        $this->getPath()->shouldBe($path);
    }

    public function it_evaluates_as_the_value_of_a_path(SourceItemInterface $childSourceItem, SourceItemInterface $parentSourceItem, StringInterface $path)
    {
        $childSourceItem->getValue()->willReturn('a value');
        $parentSourceItem->queryPath('/a/path')->willReturn([$childSourceItem]);

        $path->__toString()->willReturn('/a/path');
        $this->setPath($path);

        $this->setContext($parentSourceItem);

        $this->__toString()->shouldBe('a value');
    }

    public function it_evaluates_as_empty_string_if_path_does_not_exist(SourceItemInterface $parentSourceItem, StringInterface $path)
    {
        $parentSourceItem->queryPath('/a/path')->willReturn([]);

        $path->__toString()->willReturn('/a/path');
        $this->setPath($path);

        $this->setContext($parentSourceItem);

        $this->__toString()->shouldBe('');
    }
}
