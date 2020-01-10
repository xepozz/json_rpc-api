<?php

namespace Api\Service;

use Api\Components\ErrorCollector;
use Api\Exceptions\ValidationFailedException;
use Api\Models\Links;
use Phalcon\Di\Injectable;

class UrlGenerator extends Injectable
{
    private const LENGTH = 10;

    public function generate(string $link)
    {
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
        return Links::count(
                [
                    'conditions' => 'uniqueId = :id:',
                    'bind' => [
                        'id' => $id,
                    ],
                ]
            ) > 0;
    }

    private function insert(string $id, string $link): void
    {
        $model = new Links(['uniqueId' => $id, 'link' => $link]);
        if (!$model->save()) {
            /* @var $collector \Api\Components\ErrorCollector */
            $collector = $this->getDI()->get(ErrorCollector::class);

            throw new ValidationFailedException($collector->collect($model));
        }
    }
}
