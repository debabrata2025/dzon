<?php
session_start();
require 'config.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Fetch current admin's info
try {
    $stmt = $conn->prepare("SELECT username, profile_image FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $user['username'];
    $profile_image = $user['profile_image'] ?: 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740';
} catch (Exception $e) {
    $username = 'Admin';
    $profile_image = 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>D-zone - Admin Registration Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f8faff;
            color: #222;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: clamp(0.6rem, 2vw, 0.8rem) clamp(1rem, 3vw, 2rem);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .logo {
            font-weight: 700;
            font-size: clamp(1.4rem, 4vw, 1.8rem);
            letter-spacing: 2px;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: clamp(0.3rem, 1vw, 0.5rem);
        }

        .profile-image {
            width: clamp(32px, 8vw, 40px);
            height: clamp(32px, 8vw, 40px);
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-username {
            font-weight: 600;
            font-size: clamp(0.85rem, 2.5vw, 1rem);
        }

        main {
            max-width: 95%;
            margin: clamp(1rem, 3vw, 1.5rem) auto clamp(2rem, 5vw, 3rem);
            padding: 0 clamp(0.5rem, 2vw, 1rem) clamp(1.5rem, 4vw, 2rem);
            flex-grow: 1;
            text-align: center;
        }

        .section-title {
            font-weight: 700;
            font-size: clamp(1.5rem, 5vw, 2rem);
            margin-bottom: clamp(0.8rem, 2.5vw, 1rem);
            color: #432275;
        }

        .register-btn {
            background-color: #6a11cb;
            color: white;
            border: none;
            padding: clamp(0.5rem, 1.5vw, 0.7rem) clamp(1rem, 3vw, 1.5rem);
            border-radius: clamp(20px, 5vw, 25px);
            cursor: pointer;
            font-weight: 600;
            font-size: clamp(0.9rem, 2.5vw, 1rem);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .register-btn:hover {
            background-color: #4f0f9f;
            transform: scale(1.05);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.55);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1200;
            padding: clamp(0.5rem, 2vw, 1rem);
            /* Prevent edge clipping */
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            width: clamp(280px, 90vw, 480px);
            max-height: clamp(400px, 85vh, 600px);
            border-radius: clamp(10px, 3vw, 15px);
            padding: clamp(1rem, 3vw, 2rem);
            position: relative;
            overflow-y: auto;
            /* Scroll if content exceeds max-height */
        }

        .modal-header {
            font-weight: 700;
            font-size: clamp(1.4rem, 4vw, 1.7rem);
            margin-bottom: clamp(0.8rem, 2.5vw, 1rem);
            color: #432275;
            text-align: center;
        }

        .close-button {
            position: absolute;
            top: clamp(8px, 2vw, 12px);
            right: clamp(8px, 2vw, 12px);
            background: none;
            border: none;
            font-size: clamp(1.2rem, 3vw, 1.5rem);
            color: #432275;
            cursor: pointer;
        }

        .admin-form {
            display: flex;
            flex-direction: column;
            gap: clamp(0.3rem, 1vw, 0.5rem);
        }

        label {
            font-weight: 600;
            margin: clamp(0.5rem, 1.5vw, 0.8rem) 0 clamp(0.2rem, 0.8vw, 0.4rem);
            color: #555;
            font-size: clamp(0.85rem, 2.2vw, 0.95rem);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="url"] {
            padding: clamp(0.5rem, 1.5vw, 0.7rem) clamp(0.8rem, 2vw, 1rem);
            border-radius: clamp(6px, 1.5vw, 8px);
            border: 1px solid #ccc;
            font-size: clamp(0.85rem, 2.2vw, 1rem);
            width: 100%;
        }

        input:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px #6a11cbaa;
            outline: none;
        }

        .submit-btn {
            margin-top: clamp(1rem, 3vw, 1.5rem);
            background-color: #6a11cb;
            color: white;
            border: none;
            padding: clamp(0.8rem, 2vw, 1rem);
            font-weight: 700;
            font-size: clamp(0.9rem, 2.5vw, 1rem);
            border-radius: clamp(25px, 6vw, 30px);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #4f0f9f;
        }

        .form-error {
            color: #e04545;
            font-size: clamp(0.75rem, 2vw, 0.9rem);
            margin-top: clamp(0.2rem, 0.5vw, 0.3rem);
        }

        .confirmation-message {
            text-align: center;
            font-size: clamp(0.95rem, 2.5vw, 1.1rem);
            font-weight: 600;
            color: #2575fc;
            margin-top: clamp(0.8rem, 2vw, 1rem);
            display: none;
        }

        footer {
            background-color: #432275;
            color: white;
            text-align: center;
            padding: clamp(0.8rem, 2vw, 1rem) clamp(1rem, 3vw, 2rem);
            font-size: clamp(0.75rem, 2vw, 0.9rem);
        }

        /* Tablet (≤ 1024px) */
        @media (max-width: 1024px) {
            header {
                padding: clamp(0.5rem, 1.5vw, 0.7rem) clamp(0.8rem, 2.5vw, 1.5rem);
            }

            .logo {
                font-size: clamp(1.2rem, 3.5vw, 1.6rem);
            }

            .profile-username {
                font-size: clamp(0.8rem, 2.2vw, 0.9rem);
            }

            main {
                margin: clamp(0.8rem, 2.5vw, 1.2rem) auto clamp(1.5rem, 4vw, 2.5rem);
                padding: 0 clamp(0.4rem, 1.5vw, 0.8rem) clamp(1.2rem, 3vw, 1.5rem);
            }

            .section-title {
                font-size: clamp(1.3rem, 4.5vw, 1.8rem);
            }

            .modal-content {
                width: clamp(260px, 85vw, 420px);
                max-height: clamp(350px, 80vh, 550px);
                padding: clamp(0.8rem, 2.5vw, 1.5rem);
            }
        }

        /* Mobile (≤ 768px) */
        @media (max-width: 768px) {
            header {
                flex-wrap: wrap;
                /* Allow wrapping if needed */
                padding: clamp(0.4rem, 1.2vw, 0.6rem) clamp(0.6rem, 2vw, 1rem);
                gap: clamp(0.3rem, 1vw, 0.5rem);
            }

            .logo {
                font-size: clamp(1rem, 3vw, 1.4rem);
            }

            .profile-container {
                flex-shrink: 0;
            }

            .profile-image {
                width: clamp(28px, 7vw, 32px);
                height: clamp(28px, 7vw, 32px);
            }

            .profile-username {
                font-size: clamp(0.7rem, 2vw, 0.85rem);
            }

            main {
                margin: clamp(0.5rem, 2vw, 1rem) auto clamp(1rem, 3vw, 2rem);
                padding: 0 clamp(0.3rem, 1vw, 0.5rem) clamp(0.8rem, 2.5vw, 1.2rem);
            }

            .section-title {
                font-size: clamp(1.2rem, 4vw, 1.5rem);
            }

            .register-btn {
                padding: clamp(0.4rem, 1.2vw, 0.6rem) clamp(0.8rem, 2.5vw, 1.2rem);
                font-size: clamp(0.8rem, 2.2vw, 0.9rem);
            }

            .modal-overlay {
                padding: clamp(0.3rem, 1vw, 0.5rem);
            }

            .modal-content {
                width: clamp(240px, 92vw, 360px);
                max-height: clamp(300px, 90vh, 500px);
                padding: clamp(0.6rem, 2vw, 1.2rem);
            }

            .modal-header {
                font-size: clamp(1.2rem, 3.5vw, 1.5rem);
            }

            .close-button {
                top: clamp(6px, 1.5vw, 10px);
                right: clamp(6px, 1.5vw, 10px);
                font-size: clamp(1rem, 2.5vw, 1.3rem);
            }

            label {
                font-size: clamp(0.8rem, 2vw, 0.9rem);
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="url"] {
                padding: clamp(0.4rem, 1.2vw, 0.6rem) clamp(0.6rem, 1.5vw, 0.8rem);
                font-size: clamp(0.8rem, 2vw, 0.9rem);
            }

            .submit-btn {
                margin-top: clamp(0.8rem, 2.5vw, 1.2rem);
                padding: clamp(0.6rem, 1.5vw, 0.8rem);
                font-size: clamp(0.85rem, 2.2vw, 0.95rem);
            }

            .form-error {
                font-size: clamp(0.7rem, 1.8vw, 0.85rem);
            }

            .confirmation-message {
                font-size: clamp(0.85rem, 2.2vw, 1rem);
            }

            footer {
                padding: clamp(0.6rem, 1.5vw, 0.8rem) clamp(0.8rem, 2.5vw, 1.5rem);
                font-size: clamp(0.7rem, 1.8vw, 0.85rem);
            }
        }
    </style>
</head>

<body>
    <header role="banner">
        <div class="logo">D-zone</div>
        <div class="profile-container">
            <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image" class="profile-image">
            <span class="profile-username"><?php echo htmlspecialchars($username); ?></span>
        </div>
    </header>
    <main role="main">
        <h1 class="section-title">Admin Registration Dashboard</h1>
        <button class="register-btn" id="openRegisterModal">Register New Admin</button>
    </main>
    <div id="adminRegisterModal" class="modal-overlay" role="dialog" aria-modal="true">
        <div class="modal-content">
            <button class="close-button" id="closeRegisterModal" aria-label="Close register form">×</button>
            <h2 class="modal-header">Register New Admin</h2>
            <form id="adminRegisterForm" class="admin-form">
                <label for="adminUsername">Username</label>
                <input type="text" id="adminUsername" name="username" placeholder="Username" required>
                <div class="form-error" id="errorAdminUsername"></div>
                <label for="adminEmail">Email</label>
                <input type="email" id="adminEmail" name="email" placeholder="you@example.com" required>
                <div class="form-error" id="errorAdminEmail"></div>
                <label for="adminPassword">Password</label>
                <input type="password" id="adminPassword" name="password" placeholder="Password" required>
                <div class="form-error" id="errorAdminPassword"></div>
                <label for="adminProfileImage">Profile Image URL (Optional)</label>
                <input type="url" id="adminProfileImage" name="profile_image" placeholder="https://example.com/image.jpg">
                <div class="form-error" id="errorAdminProfileImage"></div>
                <button type="submit" class="submit-btn">Register Admin</button>
            </form>
            <p id="confirmationMessage" class="confirmation-message"></p>
        </div>
    </div>
    <footer role="contentinfo">
        © 2025 D-zone. All rights reserved.
    </footer>
    <script>
        const adminRegisterModal = document.getElementById('adminRegisterModal');
        const openRegisterModal = document.getElementById('openRegisterModal');
        const closeRegisterModal = document.getElementById('closeRegisterModal');
        const adminRegisterForm = document.getElementById('adminRegisterForm');
        const confirmationMessage = document.getElementById('confirmationMessage');

        function clearFormErrors() {
            ['AdminUsername', 'AdminEmail', 'AdminPassword', 'AdminProfileImage'].forEach(field => {
                document.getElementById('error' + field).textContent = '';
            });
        }

        openRegisterModal.addEventListener('click', () => {
            adminRegisterModal.classList.add('active');
            adminRegisterForm.reset();
            clearFormErrors();
            confirmationMessage.style.display = 'none';
        });

        closeRegisterModal.addEventListener('click', () => {
            adminRegisterModal.classList.remove('active');
        });

        adminRegisterForm.addEventListener('submit', async e => {
            e.preventDefault();
            clearFormErrors();
            confirmationMessage.style.display = 'none';

            const username = adminRegisterForm.username.value.trim();
            const email = adminRegisterForm.email.value.trim();
            const password = adminRegisterForm.password.value;
            const profileImage = adminRegisterForm.profile_image.value.trim();

            // Client-side validation
            if (username.length < 3) {
                document.getElementById('errorAdminUsername').textContent = 'Username must be at least 3 characters.';
                return;
            }
            if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                document.getElementById('errorAdminUsername').textContent = 'Username can only contain letters, numbers, and underscores.';
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('errorAdminEmail').textContent = 'Please enter a valid email.';
                return;
            }
            if (password.length < 8 || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
                document.getElementById('errorAdminPassword').textContent = 'Password must be 8+ characters with at least one uppercase letter and one number.';
                return;
            }
            if (profileImage && !/^(https?:\/\/.*\.(?:png|jpg|jpeg|gif))$/i.test(profileImage)) {
                document.getElementById('errorAdminProfileImage').textContent = 'Please enter a valid image URL (png, jpg, jpeg, gif) or leave empty.';
                return;
            }

            try {
                const response = await fetch('api.php?action=register_admin', {
                    method: 'POST',
                    body: new URLSearchParams({
                        username,
                        email,
                        password,
                        profile_image: profileImage
                    })
                });
                const result = await response.json();
                if (result.success) {
                    adminRegisterForm.reset();
                    confirmationMessage.textContent = `Admin ${result.data.username} registered successfully!`;
                    confirmationMessage.style.display = 'block';
                    setTimeout(() => adminRegisterModal.classList.remove('active'), 3000);
                } else {
                    confirmationMessage.textContent = result.message;
                    confirmationMessage.style.color = '#e04545';
                    confirmationMessage.style.display = 'block';
                }
            } catch (error) {
                confirmationMessage.textContent = 'Error registering admin. Please try again.';
                confirmationMessage.style.color = '#e04545';
                confirmationMessage.style.display = 'block';
            }
        });

        window.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                adminRegisterModal.classList.remove('active');
            }
        });
    </script>
</body>

</html>
<?php $conn = null; ?>