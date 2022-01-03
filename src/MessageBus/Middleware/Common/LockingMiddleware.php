<?php

declare(strict_types=1);

namespace Zorachka\Framework\MessageBus\Middleware\Common;

use Zorachka\Framework\MessageBus\Middleware\Broker\Broker;
use Zorachka\Framework\MessageBus\Middleware\Input;
use Zorachka\Framework\MessageBus\Middleware\Middleware;
use Zorachka\Framework\MessageBus\Middleware\Output;

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
     * @param Input $input
     * @param Broker $next
     * @return Output|null
     * @throws \Exception
     */
    public function process(Input $input, Broker $next): ?Output
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
        } catch (\Exception $e) {
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
