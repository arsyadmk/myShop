<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    protected array $roleMap = [
        'admin_super' => 0,
        'admin' => 1,
        'cashier' => 2,
    ];

    // Default menu
    protected array $menu_default = [
        // Navbar items:
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],
    ];

    protected array $menu_super_admin = [
        // Sidebar items:
        [
            'text' => 'Users',
            'url' => 'admin/users',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'Clients',
            'url' => 'admin/clients',
            'icon' => 'fas fa-fw fa-user-tie',
        ],
        [
            'text' => 'Guests',
            'url' => 'admin/guests',
            'icon' => 'fas fa-fw fa-users',
        ],
        [
            'text' => 'Attendances',
            'url' => 'admin/attendances',
            'icon' => 'fas fa-fw fa-id-card',
        ],
    ];

    protected array $menu_client = [
        // Sidebar items:
        [
            'text' => 'Guests',
            'url' => 'admin/guests',
            'icon' => 'fas fa-fw fa-users',
        ],
        [
            'text' => 'Attendances',
            'url' => 'admin/attendances',
            'icon' => 'fas fa-fw fa-id-card',
        ],
    ];

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // Convert word roles to numeric values
        $allowedJenis = array_map(function ($role) {
            return $this->roleMap[$role] ?? null;
        }, $roles);

        if (!in_array($user->jenis, $allowedJenis)) {
            return abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
