<?php

namespace Authorization\Entity;

use \CodeIgniter\Entity;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class Log extends Entity {

    protected $casts = [
        'description' => 'json-array'
    ];

}
