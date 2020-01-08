<?php

namespace Rpc\Actions;

class ShortLinkDoAction extends AbstractAction
{
    public function shorten(string $link)
    {
        return $this->request(['link' => $link]);
    }

    public function getActionName(): string
    {
        return 'shorten';
    }
}
