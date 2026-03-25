<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StaffModel;

class Users extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $adminModel = new AdminModel();
        $staffModel = new StaffModel();

        $data['username'] = session()->get('username');
        $data['users'] = [];

        foreach ($adminModel->getAllAdmins() as $admin) {
            $admin['role'] = 'admin';
            $data['users'][] = $admin;
        }

        foreach ($staffModel->getAllStaff() as $staff) {
            $staff['role'] = 'staff';
            $data['users'][] = $staff;
        }

        usort($data['users'], static function ($a, $b) {
            $roleA = (string) ($a['role'] ?? '');
            $roleB = (string) ($b['role'] ?? '');
            if ($roleA === $roleB) {
                return ((int) ($a['id'] ?? 0)) <=> ((int) ($b['id'] ?? 0));
            }
            return $roleA <=> $roleB;
        });

        return view('admin/users', $data);
    }

    public function create()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $role = strtolower(trim((string) $this->request->getPost('role')));
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if (!in_array($role, ['admin', 'staff'], true)) {
            return redirect()->to('/users')->with('error', 'Invalid role selected.');
        }

        if ($username === '' || $password === '') {
            return redirect()->to('/users')->with('error', 'Username and password are required.');
        }

        if ($role === 'admin') {
            $adminModel = new AdminModel();

            $existing = $adminModel->where('username', $username)->first();
            if ($existing) {
                return redirect()->to('/users')->with('error', 'Admin username already exists.');
            }

            $adminModel->insert([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'is_active' => 1,
            ]);

            return redirect()->to('/users')->with('success', 'Admin user created.');
        }

        $staffModel = new StaffModel();

        $existing = $staffModel->where('username', $username)->first();
        if ($existing) {
            return redirect()->to('/users')->with('error', 'Staff username already exists.');
        }

        $staffModel->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'is_active' => 1,
        ]);

        return redirect()->to('/users')->with('success', 'Staff user created.');
    }

    public function toggle(string $role, int $id)
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $role = strtolower($role);
        if (!in_array($role, ['admin', 'staff'], true)) {
            return redirect()->to('/users')->with('error', 'Invalid role.');
        }

        if ($role === 'admin') {
            $currentAdminId = (int) session()->get('admin_id');
            if ($id === $currentAdminId) {
                return redirect()->to('/users')->with('error', 'You cannot deactivate your own admin account.');
            }

            $adminModel = new AdminModel();
            $admin = $adminModel->find($id);

            if (!$admin) {
                return redirect()->to('/users')->with('error', 'Admin user not found.');
            }

            $isActive = (int) ($admin['is_active'] ?? 1);
            $adminModel->update($id, ['is_active' => $isActive ? 0 : 1]);

            return redirect()->to('/users')->with('success', 'Admin status updated.');
        }

        $staffModel = new StaffModel();
        $staff = $staffModel->find($id);

        if (!$staff) {
            return redirect()->to('/users')->with('error', 'Staff user not found.');
        }

        $isActive = (int) ($staff['is_active'] ?? 1);
        $staffModel->update($id, ['is_active' => $isActive ? 0 : 1]);

        return redirect()->to('/users')->with('success', 'Staff status updated.');
    }

    public function edit(string $role, int $id)
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $role = strtolower($role);
        if (!in_array($role, ['admin', 'staff'], true)) {
            return redirect()->to('/users')->with('error', 'Invalid role.');
        }

        $data['role'] = $role;
        $data['id'] = $id;

        if ($role === 'admin') {
            $adminModel = new AdminModel();
            $user = $adminModel->find($id);
            if (!$user) {
                return redirect()->to('/users')->with('error', 'Admin user not found.');
            }
            $data['user'] = $user;
        } else {
            $staffModel = new StaffModel();
            $user = $staffModel->find($id);
            if (!$user) {
                return redirect()->to('/users')->with('error', 'Staff user not found.');
            }
            $data['user'] = $user;
        }

        return view('admin/user_edit', $data);
    }

    public function update(string $role, int $id)
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $role = strtolower($role);
        if (!in_array($role, ['admin', 'staff'], true)) {
            return redirect()->to('/users')->with('error', 'Invalid role.');
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if ($username === '') {
            return redirect()->to('/users/edit/' . $role . '/' . $id)->with('error', 'Username is required.');
        }

        if ($role === 'admin') {
            $adminModel = new AdminModel();
            $user = $adminModel->find($id);
            if (!$user) {
                return redirect()->to('/users')->with('error', 'Admin user not found.');
            }

            $existing = $adminModel->where('username', $username)->where('id !=', $id)->first();
            if ($existing) {
                return redirect()->to('/users/edit/' . $role . '/' . $id)->with('error', 'Admin username already exists.');
            }

            $updateData = ['username' => $username];
            if (trim($password) !== '') {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $adminModel->update($id, $updateData);

            return redirect()->to('/users')->with('success', 'Admin updated.');
        }

        $staffModel = new StaffModel();
        $user = $staffModel->find($id);
        if (!$user) {
            return redirect()->to('/users')->with('error', 'Staff user not found.');
        }

        $existing = $staffModel->where('username', $username)->where('id !=', $id)->first();
        if ($existing) {
            return redirect()->to('/users/edit/' . $role . '/' . $id)->with('error', 'Staff username already exists.');
        }

        $updateData = ['username' => $username];
        if (trim($password) !== '') {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $staffModel->update($id, $updateData);

        return redirect()->to('/users')->with('success', 'Staff updated.');
    }
}
