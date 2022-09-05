<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function Permission()
    {
    	$student_permission = Permission::where('slug','create-tasks')->first();
		$manager_permission = Permission::where('slug', 'edit-users')->first();

		//RoleTableSeeder.php
		$student_role = new Role();
		$student_role->slug = 'student';
		$student_role->name = 'Student';
		$student_role->save();
		$student_role->permissions()->attach($student_permission);

		$manager_role = new Role();
		$manager_role->slug = 'manager';
		$manager_role->name = 'Assistant Manager';
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

		$student_role = Role::where('slug','student')->first();
		$manager_role = Role::where('slug', 'manager')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($student_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);

		$student_role = Role::where('slug','student')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$student_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();

		$developer = new User();
		$developer->name = 'Mahedi Hasan';
		$developer->email = 'student@gmail.com';
		$developer->password = bcrypt('student');
		$developer->save();
		$developer->roles()->attach($student_role);
		$developer->permissions()->attach($student_perm);

		$manager = new User();
		$manager->name = 'Hafizul Islam';
		$manager->email = 'manager@gmail.com';
		$manager->password = bcrypt('manager');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);


		return redirect()->back();
    }
}

