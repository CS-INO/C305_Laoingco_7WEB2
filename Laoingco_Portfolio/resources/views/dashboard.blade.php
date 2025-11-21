<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Portfolio Dashboard</title>

    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #ff7e5f, #feb47b);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            width: 80%;
            height: 90vh;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2d3a4f;
            color: white;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
            border-radius: 10px 0 0 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .logo h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            margin: 15px 0;
            text-align: center;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ddd;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #ff7e5f;
        }

        /* Main */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background: #f3f3f3;
            border-radius: 0 10px 10px 0;
            overflow-y: auto;
        }

        header h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Stats */
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: #fff;
            padding: 20px;
            width: 30%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .stat-card h3 {
            font-size: 18px;
            color: #333;
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #ff7e5f;
        }

        /* Projects */
        .projects {
            margin-top: 40px;
        }

        .projects h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .project-card {
            display: flex;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .project-card:hover {
            transform: scale(1.03);
        }

        .project-thumbnail img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .project-details {
            padding: 20px;
            flex-grow: 1;
        }

        .project-details h4 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .project-details p {
            font-size: 16px;
            color: #666;
        }
    </style>

</head>
<body>

    <div class="container">

        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo">
                <h2>Your Logo</h2>
            </div>

            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Skills</a></li>
                <li><a href="#">About Me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">

            <header>
                <h1>Welcome to Your Portfolio Dashboard</h1>
            </header>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Projects</h3>
                    <p>12</p>
                </div>
                <div class="stat-card">
                    <h3>Skills</h3>
                    <p>Laravel, JS, PHP</p>
                </div>
                <div class="stat-card">
                    <h3>Messages</h3>
                    <p>4</p>
                </div>
            </div>

            <section class="projects">
                <h2>Your Latest Projects</h2>

                <div class="project-card">
                    <div class="project-thumbnail">
                        <img src="https://via.placeholder.com/150" alt="Project">
                    </div>
                    <div class="project-details">
                        <h4>Portfolio Website</h4>
                        <p>A modern personal portfolio site built with Laravel.</p>
                    </div>
                </div>

                <div class="project-card">
                    <div class="project-thumbnail">
                        <img src="https://via.placeholder.com/150" alt="Project">
                    </div>
                    <div class="project-details">
                        <h4>Task Manager App</h4>
                        <p>A full-stack task manager with user accounts and roles.</p>
                    </div>
                </div>

            </section>

        </div>

    </div>

</body>
</html>
