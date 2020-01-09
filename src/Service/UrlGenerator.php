<?php

namespace Rpc\Service;

use Phalcon\Di\Injectable;
use Rpc\Models\Links;

class UrlGenerator extends Injectable
{
    private const LENGTH = 10;

    public function generate(string $link)
    {
        $db = $this->getDI()->getService('db');

        do {
            $id = $this->generateUniqueIdentifier();
        } while ($this->exist($id));
        $this->insert($id, $link);

        return $id;
    }

    private function generateUniqueIdentifier()
    {
        $bytes = random_bytes(self::LENGTH);

        return bin2hex($bytes);
    }

    private function exist(string $id): bool
    {
        return Links::count(['uniqueId' => $id]) > 0;
    }

    private function insert(string $id, string $link)
    {
        $model = new Links(['uniqueId' => $id, 'link' => $link]);
        if (!$model->save()) {
            var_dump($model);
            exit();
        }
    }
}
