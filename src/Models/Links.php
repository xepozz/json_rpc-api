<?php

declare(strict_types=1);

namespace Rpc\Models;

use Phalcon\Mvc\Model;

class Links extends Model
{
    public $id;
    public $uniqueId;
    public $link;
}
