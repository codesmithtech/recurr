<?php

/*
 * Copyright 2014 Shaun Simmons
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Recurr\Transformer\Constraint;

use Recurr\Transformer\Constraint;

class BetweenConstraint extends Constraint
{

    protected $stopsTransformer = false;

    /** @var \DateTimeInterface */
    protected $before;

    /** @var \DateTimeInterface */
    protected $after;

    /** @var bool */
    protected $inc;

    /**
     * @param \DateTimeInterface $after
     * @param \DateTimeInterface $before
     * @param bool               $inc Include date if it equals $after or $before.
     */
    public function __construct(\DateTimeInterface $after, \DateTimeInterface $before, $inc = false)
    {
        $this->after  = $after;
        $this->before = $before;
        $this->inc    = $inc;
    }

    /**
     * Passes if $date begins or ends between $this->after or $this->before
     *
     * {@inheritdoc}
     */
    public function test(\DateTimeInterface $date, \DateInterval $duration = null)
    {
        if ($duration) {
            $eventEnd = clone $date;
            $eventEnd->add($duration);
            
            return
            ($this->before <= $date && $date <= $this->after)
             ||
            ($this->before <= $eventEnd && $eventEnd <= $this->after);
        }
    }
}
