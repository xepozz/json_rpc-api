<?php

declare(strict_types=1);

namespace Api\Models;

use Phalcon\Mvc\Model;

class Links extends Model
{
    public $id;
    public $uniqueId;
    public $link;
}
