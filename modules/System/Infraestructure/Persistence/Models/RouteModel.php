<?php

namespace System\Infraestructure\Persistence\Models;

use \App\Models\BaseModel;
use \System\Infraestructure\Persistence\Entity\Route;

/**
 * Description of User
 *
 * @author Romário Beckman
 */
class RouteModel extends BaseModel {

    /**
     * Anyone can access
     */
    const ACCESS_PUBLIC = 'public';

    /**
     * Anyone can access with authentication
     */
    const ACCESS_PROTECTED = 'protected';

    /**
     * Required authentication and permission
     */
    const ACCESS_PRIVATE = 'private';

    protected $table = 'sys_route';
    protected $allowedFields = [
        'controller', 'method', 'access', 'name', 'group'
    ];

    protected $returnType = Route::class;
}
