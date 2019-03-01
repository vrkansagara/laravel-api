<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\Acl\Permission\PermissionRepositoryEloquent;
use App\Repositories\Acl\Role\RoleRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $userRepositoryEloquent;
    private $permissionRepositoryEloquent;
    private $roleRepositoryEloquent;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryEloquent $userRepositoryEloquent,
        PermissionRepositoryEloquent $permissionRepositoryEloquent,
        RoleRepositoryEloquent $roleRepositoryEloquent
    )
    {
        $this->middleware('auth');
        $this->userRepositoryEloquent = $userRepositoryEloquent;
        $this->roleRepositoryEloquent = $roleRepositoryEloquent;
        $this->permissionRepositoryEloquent = $permissionRepositoryEloquent;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = $this->userRepositoryEloquent->all()->count();
        $activeUsers = $this->userRepositoryEloquent->all()->where('active', '=', 1)->count();
        $inActiveUsers = $this->userRepositoryEloquent->all()->where('active', '=', 0)->count();
        $roles = $this->roleRepositoryEloquent->all()->count();
        $permissions = $this->permissionRepositoryEloquent->all()->count();

        $layoutData = [
            'totalUsers' => $users,
            'activeUsers' => $activeUsers,
            'inActiveUsers' => $inActiveUsers,
            'totalRoles' => $roles,
            'totalPermissions' => $permissions,
        ];

        return view('dashboard.dashboard', $layoutData);
    }
}
