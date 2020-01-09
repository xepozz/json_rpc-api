<?php

declare(strict_types=1);

namespace Rpc\Models;

use Phalcon\Mvc\Model;

/**
 * EmailConfirmations
 * Stores the reset password codes and their evolution
 * @method static Links findFirstByCode(string $code)
 */
class Links extends Model
{
    public $id;
    public $uniqueId;
    public $link;
    public $createdAt;

    public function beforeValidationOnCreate()
    {
        $this->createdAt = time();
    }
}
