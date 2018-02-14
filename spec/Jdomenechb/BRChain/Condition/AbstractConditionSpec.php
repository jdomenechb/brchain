<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Condition;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\Chain\ChainInterface;
use Jdomenechb\BRChain\Condition\AbstractCondition;
use Jdomenechb\BRChain\Condition\ConditionInterface;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\String\StringInterface;
use Jdomenechb\BRChain\Stub\Condition\AbstractConditionStub;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class AbstractConditionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(AbstractConditionStub::class);
    }

    public function its_stub_extends_the_abstract_class()
    {
        $this->shouldHaveType(AbstractCondition::class);
    }

    public function it_is_a_Condition_item()
    {
        $this->shouldImplement(ConditionInterface::class);
    }

    public function it_is_chainable()
    {
        $this->shouldImplement(ChainableItemInterface::class);
    }

    public function it_can_contain_a_chain()
    {
        $this->shouldImplement(ChainContainerItemInterface::class);
        $this->shouldUseTrait(ChainContainerItemTrait::class);
    }

    public function it_accepts_dynamic_options()
    {
        $this->shouldUseTrait(DynamicOptionsTrait::class);
    }

    public function it_is_not_negated_by_default()
    {
        $this->isNegated()->shouldBe(false);
    }

    public function it_can_be_negated()
    {
        $this->setNegated(true);
        $this->isNegated()->shouldBe(true);
    }

    public function it_processes_chain_when_evaluation_true_and_not_negated(ChainInterface $chain, SourceItemInterface $sourceItem)
    {
        // FIXME: Missing check of what evaluates
        $this->setNegated(false);
        $this->setWhatShouldReturnStubEvaluation(true);

        $chain->process($sourceItem)->shouldBeCalled();
        $this->setChain($chain);

        $this->process($sourceItem);
    }

    public function it_processes_chain_when_evaluation_false_but_is_negated(ChainInterface $chain, SourceItemInterface $sourceItem)
    {
        // FIXME: Missing check of what evaluates
        $this->setNegated(true);
        $this->setWhatShouldReturnStubEvaluation(false);

        $chain->process($sourceItem)->shouldBeCalled();
        $this->setChain($chain);

        $this->process($sourceItem);
    }

    public function it_does_not_process_chain_when_evaluation_true_and_negated(ChainInterface $chain, SourceItemInterface $sourceItem)
    {
        // FIXME: Missing check of what evaluates
        $this->setNegated(true);
        $this->setWhatShouldReturnStubEvaluation(true);

        $chain->process($sourceItem)->shouldNotBeCalled();
        $this->setChain($chain);

        $this->process($sourceItem);
    }

    public function it_does_not_process_chain_when_evaluation_false_and_not_negated(ChainInterface $chain, SourceItemInterface $sourceItem)
    {
        // FIXME: Missing check of what evaluates
        $this->setNegated(false);
        $this->setWhatShouldReturnStubEvaluation(false);

        $chain->process($sourceItem)->shouldNotBeCalled();
        $this->setChain($chain);

        $this->process($sourceItem);
    }

    public function it_can_evaluate_an_alternative_given_path(StringInterface $path, ChainInterface $chain, SourceItemInterface $parentSourceItem, SourceItemInterface $childSourceItem)
    {
        // FIXME: Missing check of what evaluates
        $path->__toString()->willReturn('a');

        $parentSourceItem->queryPath('a')->willReturn([$childSourceItem]);
        $this->setPath($path);

        $path->setContext($childSourceItem)->shouldBeCalled();

        $chain->process($parentSourceItem)->shouldBeCalled();
        $this->setChain($chain);

        $this->process($parentSourceItem);
    }
}
