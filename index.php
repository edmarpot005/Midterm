<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-container,
        #register-student-section {
            min-height: 100vh;
            display: none;
        }

        .welcome-text {
            font-size: 1.5rem;
            margin-top: 20px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .card-body {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Login Form (Visible initially) -->
    <div id="login-form" class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            <div id="error-box" class="alert alert-danger d-none" role="alert">
                Please enter a valid email address and password.
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard with Logout Button -->
    <div id="dashboard"
        class="container dashboard-container d-flex flex-column align-items-center justify-content-center">
        <button class="btn btn-danger" id="logoutBtn"
            style="position: absolute; top: 20px; right: 20px;">Logout</button>
        <div class="welcome-text">
            Welcome to the System: <strong id="userEmail"></strong>
        </div>
        <div class="card-container">
            <div class="card shadow-sm" style="width: 18rem;">
                <div class="card-header">Add a Subject</div>
                <div class="card-body">
                    <p class="card-text">This section allows you to add a new subject in the system.</p>
                    <a href="#" class="btn btn-primary">Add Subject</a>
                </div>
            </div>
            <div class="card shadow-sm" style="width: 18rem;">
                <div class="card-header">Register a Student</div>
                <div class="card-body">
                    <p class="card-text">This section allows you to register a new student in the system.</p>
                    <a href="#" class="btn btn-primary" id="registerStudentBtn">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Student Section (Hidden initially) -->
    <div id="register-student-section" class="container mt-5">
        <button class="btn btn-secondary mb-4" id="backToDashboardBtn">Back to Dashboard</button>
        <h3 class="mb-4">Register a New Student</h3>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" id="breadcrumbDashboardLink">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register Student</li>
            </ol>
        </nav>

        <!-- Register Student Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="student-form">
                    <div class="mb-3">
                        <label for="studentId" class="form-label">Student ID</label>
                        <input type="text" id="studentId" class="form-control" placeholder="Enter Student ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" id="firstName" class="form-control" placeholder="Enter First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" id="lastName" class="form-control" placeholder="Enter Last Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </form>
            </div>
        </div>

        <!-- Student List Table -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student List</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody id="student-table-body">
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Show the dashboard after login
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const errorBox = document.getElementById('error-box');

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email) || !password) {
                errorBox.classList.remove('d-none');
            } else {
                errorBox.classList.add('d-none');
                document.getElementById('userEmail').textContent = email;
                document.getElementById('login-form').classList.add('d-none');
                document.getElementById('dashboard').classList.remove('d-none');
            }
        });

        // Handle Logout
        document.getElementById('logoutBtn').addEventListener('click', function () {
            document.getElementById('dashboard').classList.add('d-none');
            document.getElementById('login-form').classList.remove('d-none');
            document.getElementById('loginForm').reset();
        });

        // Navigate to Register Student section
        document.getElementById('registerStudentBtn').addEventListener('click', function () {
            document.getElementById('dashboard').classList.add('d-none');
            document.getElementById('register-student-section').style.display = 'block';
        });

        // Back to Dashboard from Register Student section
        document.getElementById('backToDashboardBtn').addEventListener('click', function () {
            document.getElementById('register-student-section').style.display = 'none';
            document.getElementById('dashboard').classList.remove('d-none');
        });

        // Breadcrumb link to Dashboard
        document.getElementById('breadcrumbDashboardLink').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('register-student-section').style.display = 'none';
            document.getElementById('dashboard').classList.remove('d-none');
        });

        // Add a student to the table
        document.getElementById('student-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const studentId = document.getElementById('studentId').value.trim();
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();

            const tableBody = document.getElementById('student-table-body');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${studentId}</td>
                <td>${firstName}</td>
                <td>${lastName}</td>
                <td>
                    <button class="btn btn-sm btn-info me-1">Edit</button>
                    <button class="btn btn-sm btn-danger me-1">Delete</button>
                    <button class="btn btn-sm btn-warning">Attach Subject</button>
                </td>
            `;
            tableBody.appendChild(row);

            // Clear form fields
            document.getElementById('student-form').reset();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>