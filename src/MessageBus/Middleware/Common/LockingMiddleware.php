<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Common;

use Exception;
use Zorachka\Framework\MessageBus\Middleware\Middleware;

/**
 * If another command is already being executed, locks the command bus and
 * queues the new incoming commands until the first has completed.
 */
final class LockingMiddleware implements Middleware
{
    /**
     * @var bool
     */
    private bool $isExecuting;

    /**
     * @var callable[]
     */
    private array $queue = [];

    /**
     * Execute the given command... after other running commands are complete.
     * @param object $input
     * @param callable $next
     * @return mixed
     * @throws Exception
     */
    public function process(object $input, callable $next): mixed
    {
        $this->queue[] = function () use ($input, $next) {
            return $next($input);
        };

        if ($this->isExecuting) {
            return null;
        }
        $this->isExecuting = true;

        try {
            $returnValue = $this->executeQueuedJobs();
        } catch (Exception $e) {
            $this->isExecuting = false;
            $this->queue = [];
            throw $e;
        }

        $this->isExecuting = false;
        return $returnValue;
    }

    /**
     * Process any pending commands in the queue. If multiple, jobs are in the
     * queue, only the first return value is given back.
     * @return mixed
     */
    private function executeQueuedJobs(): mixed
    {
        $returnValues = [];
        while ($resumeCommand = array_shift($this->queue)) {
            $returnValues[] = $resumeCommand();
        }

        return array_shift($returnValues);
    }
}
