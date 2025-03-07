<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Email;

class Auth extends BaseController
{
    protected $userModel;
    protected $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->email = \Config\Services::email();
    }

    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn') && session()->get('role') === 'admin') {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/login');
    }

    public function authenticate()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userData = $this->userModel->attemptLogin($username, $password);

        if ($userData) {
            $session->set($userData);
            return redirect()->to(base_url('admin/dashboard'));
        } else {
            $session->setFlashdata('msg', 'Invalid login credentials or account is inactive.');
            return redirect()->to(base_url('admin/login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }

    /**
     * Display forgot password form
     */
    public function forgotPassword()
    {
        return view('admin/forgot_password');
    }

    /**
     * Process forgot password form submission
     */
    public function forgotPasswordSubmit()
    {
        $email = $this->request->getPost('email');
        $user = $this->userModel->findUserByEmail($email);

        if (!$user) {
            session()->setFlashdata('error', 'No account found with that email address.');
            return redirect()->to(base_url('admin/forgot-password'));
        }

        // Create password reset token
        $token = $this->userModel->createPasswordResetToken($user['id']);

        // Send reset email
        $resetLink = base_url("admin/reset-password/{$token}");
        $this->sendPasswordResetEmail($user, $resetLink);

        session()->setFlashdata('success', 'Password reset instructions have been sent to your email.');
        return redirect()->to(base_url('admin/forgot-password'));
    }

    /**
     * Display reset password form
     */
    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to(base_url('admin/login'));
        }

        $user = $this->userModel->findUserByResetToken($token);

        if (!$user) {
            session()->setFlashdata('error', 'Invalid or expired password reset link.');
            return redirect()->to(base_url('admin/login'));
        }

        return view('admin/reset_password', ['token' => $token]);
    }

    /**
     * Process reset password form submission
     */
    public function resetPasswordSubmit()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        // Validate password
        if (strlen($password) < 8) {
            session()->setFlashdata('error', 'Password must be at least 8 characters long.');
            return redirect()->to(base_url("admin/reset-password/{$token}"));
        }

        // Validate password confirmation
        if ($password !== $passwordConfirm) {
            session()->setFlashdata('error', 'Passwords do not match.');
            return redirect()->to(base_url("admin/reset-password/{$token}"));
        }

        // Reset the password
        $success = $this->userModel->resetPassword($token, $password);

        if (!$success) {
            session()->setFlashdata('error', 'Failed to reset password. Please try again.');
            return redirect()->to(base_url("admin/reset-password/{$token}"));
        }

        session()->setFlashdata('msg', 'Password has been reset successfully. You can now log in with your new password.');
        return redirect()->to(base_url('admin/login'));
    }

    /**
     * Send password reset email
     */
    private function sendPasswordResetEmail($user, $resetLink)
    {
        $this->email->setFrom(config('Email')->fromEmail, config('Email')->fromName);
        $this->email->setTo($user['email']);
        $this->email->setSubject('Reset Your Password');
        
        $message = view('emails/reset_password', [
            'resetLink' => $resetLink
        ]);
        
        $this->email->setMessage($message);
        $this->email->setMailType('html');
        
        // Send email
        $this->email->send();
    }
}