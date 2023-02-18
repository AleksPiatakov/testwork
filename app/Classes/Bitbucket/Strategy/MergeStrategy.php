<?php

namespace App\Classes\Bitbucket\Strategy;

class MergeStrategy extends Strategy
{

    public function execute(...$arg)
    {
        $this->deploy($this->deployBranch());
    }

    private function deployBranch(): string
    {
        return $this->body->pullrequest->destination->branch->name;
    }
}
