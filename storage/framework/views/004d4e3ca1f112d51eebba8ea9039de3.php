<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Q-TRACK SPMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #c79634ff 0%, #8b6925ff 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #996600 0%, #7a5200 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #996600, #7a5200);
            border: none;
            padding: 12px;
        }
        .form-control:focus {
            border-color: #996600;
            box-shadow: 0 0 0 0.2rem rgba(153, 102, 0, 0.25);
        }
        .logo-section {
            padding: 2.5rem 2rem 1rem 2rem;
            text-align: center;
            background: white;
        }
        .logo-container {
            margin-bottom: 1rem;
        }
        .logo-img {
            max-width: 80px;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #996600;
            margin-bottom: 0.25rem;
        }
        .brand-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="login-card">
                    <!-- Logo Section -->
                    <div class="logo-section">
                        <div class="logo-container">
                            <img src="<?php echo e(asset('images/photos/25600_Logo-IKIP-warna.png')); ?>" alt="Q-TRACK Logo" class="logo-img">
                        </div>
                        <div class="brand-text">
                            <div class="brand-name">SPMI</div>
                            <div class="brand-subtitle">Sistem Penjaminan Mutu Internal</div>
                        </div>
                    </div>
                    
                    <!-- Login Form -->
                    <div class="p-4">
                        <form method="POST" action="<?php echo e(route('masuk.post')); ?>">
                            <?php echo csrf_field(); ?>
                            
                            
                            <?php
                                $redirectTo = session('login_redirect') ?? 
                                             (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '') ?? 
                                             route('dokumen-publik.index');
                            ?>
                            <input type="hidden" name="redirect_to" value="<?php echo e($redirectTo); ?>">
                            
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus
                                           placeholder="Masukkan email">
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="password" required autocomplete="current-password"
                                           placeholder="Masukkan password">
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger small"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </button>

                            <div class="text-center">
                                <a href="<?php echo e(route('landing.page')); ?>" class="text-decoration-none text-muted">
                                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set redirect URL dari sessionStorage jika ada
        document.addEventListener('DOMContentLoaded', function() {
            const redirectInput = document.querySelector('input[name="redirect_to"]');
            const loginRedirect = sessionStorage.getItem('login_redirect');
            
            if (loginRedirect && redirectInput) {
                redirectInput.value = loginRedirect;
                // Bersihkan sessionStorage setelah digunakan
                sessionStorage.removeItem('login_redirect');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\rahmawati\spmi_try\resources\views/auth/masuk.blade.php ENDPATH**/ ?>