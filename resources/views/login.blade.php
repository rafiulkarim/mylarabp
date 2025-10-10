<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --primary-color: #4e54c8;
            --secondary-color: #8f94fb;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .bg-animation span {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }

        .bg-animation span:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .bg-animation span:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .bg-animation span:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .bg-animation span:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .bg-animation span:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .bg-animation span:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .bg-animation span:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .bg-animation span:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .bg-animation span:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .bg-animation span:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 600;
        }

        .login-header p {
            margin: 5px 0 0;
            opacity: 0.9;
        }

        .login-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #ddd;
            border-radius: 0;
            padding: 10px 0;
            background: transparent;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom-color: var(--primary-color);
        }

        .form-label {
            position: absolute;
            top: 10px;
            left: 0;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #999;
        }

        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: -15px;
            font-size: 12px;
            color: var(--primary-color);
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 12px;
            border-radius: 30px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn-login:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-3px);
        }

        .facebook {
            background-color: #3b5998;
        }

        .google {
            background-color: #dd4b39;
        }

        .twitter {
            background-color: #1da1f2;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .signup-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link:hover {
            color: var(--secondary-color);
        }

        .floating-icon {
            position: absolute;
            font-size: 20px;
            top: 12px;
            right: 0;
            color: #999;
            transition: all 0.3s ease;
        }

        .form-control:focus~.floating-icon {
            color: var(--primary-color);
        }

        /* SweetAlert Custom Positioning */
        .swal2-popup {
            border-radius: 15px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
        }

        .swal2-container {
            padding: 20px !important;
            align-items: flex-start !important;
            justify-content: flex-end !important;
        }

        .swal2-top-end {
            margin-top: 20px;
            margin-right: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                margin: 20px;
            }

            .login-body {
                padding: 20px;
            }

            .swal2-container {
                padding: 10px !important;
            }

            .swal2-top-end {
                margin-top: 10px;
                margin-right: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="bg-animation">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Sign in to your account</p>
        </div>

        <div class="login-body">
            <form method="POST" action="{{ url('signin') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" 
                           id="email" placeholder="" value="{{ old('email') }}" required>
                    <label for="email" class="form-label">Email Address</label>
                    <span class="floating-icon"><i class="fas fa-envelope"></i></span>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" 
                           id="password" placeholder="" required>
                    <label for="password" class="form-label">Password</label>
                    <span class="floating-icon"><i class="fas fa-lock"></i></span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-login">Sign In</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Check for errors and show SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: '{{ $errors->first() }}',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    toast: true,
                    background: 'linear-gradient(135deg, var(--primary-color), var(--secondary-color))',
                    color: 'white',
                    customClass: {
                        popup: 'sweetalert-popup'
                    }
                });
            @endif

            @if(session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('status') }}',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    background: 'linear-gradient(135deg, #198754, #20c997)',
                    color: 'white'
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    background: 'linear-gradient(135deg, #198754, #20c997)',
                    color: 'white'
                });
            @endif
        });

        // Form submission handling
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // Remove preventDefault() to allow actual form submission
            // e.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            console.log('Form data:', data);

            // Check if CSRF token is present
            const csrfToken = document.querySelector('input[name="_token"]').value;
            console.log('CSRF Token:', csrfToken);

            // Show loading state
            const submitBtn = this.querySelector('.btn-login');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
            submitBtn.disabled = true;

            // The form will now submit normally since we removed preventDefault()
        });

        // Form validation before submission (optional)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            form.addEventListener('submit', function(event) {
                let isValid = true;

                // Basic validation
                if (!email.value.trim()) {
                    showError('Please enter your email address');
                    isValid = false;
                } else if (!isValidEmail(email.value)) {
                    showError('Please enter a valid email address');
                    isValid = false;
                }

                if (!password.value.trim()) {
                    showError('Please enter your password');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function showError(message) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: message,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    background: 'linear-gradient(135deg, #ffc107, #fd7e14)',
                    color: 'white'
                });
            }
        });
    </script>
</body>

</html>