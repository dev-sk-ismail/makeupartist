<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get current URI path
        $uri = $request->getUri()->getPath(); // Use getPath() to get the URI path as a string

        // Skip filter for login-related routes
        if (in_array($uri, ['admin/login', 'admin/authenticate', 'admin/dashboard', 'admin/logout'])) {
            return;
        }

        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to(base_url('admin/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
