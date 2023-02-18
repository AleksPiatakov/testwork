<?php

namespace App\Classes\Bitbucket\Strategy;

class PushStrategy extends Strategy
{
    /**
     * @var string|null
     */
    private $currentDeployBranch;

    public function execute(...$arg)
    {
        foreach ($this->getBody()->push->changes as $change) {
            if (is_object($change->new) && $change->new->type == "branch" && $this->config->isBranchExist($change->new->name)) {
                $this->currentDeployBranch = $change->new->name;
                $this->deploy($this->currentDeployBranch);
            }
        }
    }

    public function minify()
    {
        file_get_contents('https://' . $this->currentDeployBranch . '.solomono.net/api/minification/index.php?secret=9955615397');
        file_get_contents('https://' . $this->currentDeployBranch . '.solomono.net/api/migration/index.php?secret=9955615397');
        file_get_contents('https://' . $this->currentDeployBranch . '.solomono.net/api/design_update/index.php?secret=9955615397');
    }
}
