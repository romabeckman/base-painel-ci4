<?php

namespace Authorization\Models;

use \CodeIgniter\Model;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class RouteModel extends Model {

    protected $table = 'auth_route';
    protected $allowedFields = [
        'route', 'access'
    ];

}
