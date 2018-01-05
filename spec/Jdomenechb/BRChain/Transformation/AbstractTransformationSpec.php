<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Stub\Transformation\AbstractTransformationStub;
use Jdomenechb\BRChain\Test\ObjectBehavior;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;
use Jdomenechb\BRChain\Transformation\TransformationInterface;

class AbstractTransformationSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(AbstractTransformationStub::class);
    }

    public function its_stub_extends_the_abstract_class()
    {
        $this->shouldHaveType(AbstractTransformation::class);
    }

    public function it_is_a_Transformation_item()
    {
        $this->shouldImplement(TransformationInterface::class);
    }

    public function it_is_chainable()
    {
        $this->shouldImplement(ChainableItemInterface::class);
    }

    public function it_accepts_dynamic_options()
    {
        $this->shouldUseTrait(DynamicOptionsTrait::class);
    }
}
