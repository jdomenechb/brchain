<?php

declare(strict_types=1);

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Test;

/**
 * Class extending the default ObjectBehaviour to provide more matchers.
 *
 * @method shouldUseTrait(string $trait)
 */
class ObjectBehavior extends \PhpSpec\ObjectBehavior
{
    /**
     * Extended matchers to provide to the spec.
     *
     * @return array
     */
    public function getMatchers(): array
    {
        return [
            /*
             * Checks if the class or its parents use an specific trait
             */
            'useTrait' => function ($subject, $traitName) {
                $className = \get_class($subject);
                $uses = \class_uses(\get_class($subject));

                if (\in_array($traitName, $uses, true)) {
                    return true;
                }

                $parents = \class_parents($className);

                foreach ($parents as $parent) {
                    $uses = \class_uses($parent);

                    if (\in_array($traitName, $uses, true)) {
                        return true;
                    }
                }

                return false;
            },
        ];
    }
}
