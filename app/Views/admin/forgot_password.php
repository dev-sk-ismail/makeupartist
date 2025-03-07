<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>
            <p class="mb-4 text-gray-600 text-sm">Enter your email address and we'll send you a link to reset your password.</p>
            
            <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
            <?php endif; ?>
            
            <form action="<?= base_url('admin/forgot-password-submit') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email Address
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email"
                        type="email"
                        name="email"
                        required
                        placeholder="Enter your email address">
                </div>
                
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                        type="submit">
                        Send Reset Link
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <a href="<?= base_url('admin/login') ?>" class="text-sm text-blue-500 hover:text-blue-700">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>