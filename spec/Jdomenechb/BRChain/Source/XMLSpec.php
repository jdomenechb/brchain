<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Source;

use Jdomenechb\BRChain\Source\XML;
use PhpSpec\ObjectBehavior;

class XMLSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(XML::class);
    }

    public function it_processes_given_string()
    {
        $this->processString('<a/>')->shouldReturn("<?xml version=\"1.0\"?>\n<a>\n\t<b/>\n</a>");
    }
}