<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'role',
        'username',
        'fname',
        'mname',
        'lname',
        'email',
        'phone',
        'password',
        'isactive',
        'last_login',
        'country',
        'state',
        'city',
        'address',
        'pin',
        'reset_token',
        'reset_token_expires_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Attempt to authenticate a user
     * @param string $username Username or email
     * @param string $password Password
     * @param string $role Required role (default: admin)
     * @return array|null User data if authenticated, null if not
     */
    public function attemptLogin($username, $password, $role = 'admin')
    {
        $user = $this->where('isactive', 1)
            ->where('role', $role)
            ->groupStart()
            ->where('username', $username)
            ->orWhere('email', $username)
            ->groupEnd()
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->updateLastLogin($user['id']);
            return $this->prepareUserData($user);
        }

        return null;
    }

    /**
     * Update user's last login timestamp
     * @param int $userId
     * @return bool
     */
    public function updateLastLogin($userId)
    {
        return $this->update($userId, [
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Prepare user data for session storage
     * @param array $user Raw user data
     * @return array Prepared user data
     */
    protected function prepareUserData($user)
    {
        return [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'fullname' => trim($user['fname'] . ' ' . $user['mname'] . ' ' . $user['lname']),
            'isLoggedIn' => TRUE
        ];
    }

    /**
     * Get user by ID with optional role check
     * @param int $userId
     * @param string|null $role
     * @return array|null
     */
    public function getUserById($userId, $role = null)
    {
        $query = $this->where('id', $userId)
            ->where('isactive', 1);

        if ($role) {
            $query->where('role', $role);
        }

        return $query->first();
    }

    /**
     * Check if username or email already exists
     * @param string $value
     * @param string $field
     * @param int|null $excludeId
     * @return bool
     */
    public function isUnique($value, $field, $excludeId = null)
    {
        $query = $this->where($field, $value);

        if ($excludeId) {
            $query->where('id !=', $excludeId);
        }

        return $query->countAllResults() === 0;
    }

    /**
     * Change user password
     * @param int $userId
     * @param string $newPassword
     * @return bool
     */
    public function changePassword($userId, $newPassword)
    {
        return $this->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);
    }

    /**
     * Find user by email
     * @param string $email
     * @return array|null
     */
    public function findUserByEmail($email)
    {
        return $this->where('email', $email)
            ->where('isactive', 1)
            ->first();
    }

    /**
     * Create password reset token for user
     * @param int $userId
     * @return string The generated token
     */
    public function createPasswordResetToken($userId)
    {
        // Generate a random token
        $token = bin2hex(random_bytes(32));

        // Set token expiration (30 minutes from now)
        $expiry = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        // Update user record with token
        $this->update($userId, [
            'reset_token' => $token,
            'reset_token_expires_at' => $expiry
        ]);

        return $token;
    }

    /**
     * Find user by reset token
     * @param string $token
     * @return array|null
     */
    public function findUserByResetToken($token)
    {
        $now = date('Y-m-d H:i:s');

        return $this->where('reset_token', $token)
            ->where('reset_token_expires_at >', $now)
            ->where('isactive', 1)
            ->first();
    }

    /**
     * Reset password using token
     * @param string $token
     * @param string $newPassword
     * @return bool
     */
    public function resetPassword($token, $newPassword)
    {
        $user = $this->findUserByResetToken($token);

        if (!$user) {
            return false;
        }

        // Update password and clear reset token
        return $this->update($user['id'], [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expires_at' => null
        ]);
    }
}
