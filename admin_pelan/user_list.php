<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$users = $conn->query("SELECT * FROM user");
?>
<html>

<head>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #1db954;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            animation: fadeIn 1.5s ease;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid #333;
            text-align: center;
        }

        th {
            background-color: #1db954;
            color: #121212;
        }

        td {
            background-color: #1f1f1f;
        }

        a {
            color: #1db954;
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #1db954;
            border-radius: 20px;
            transition: 0.3s;
            font-size: 14px;
        }

        a:hover {
            background-color: #1db954;
            color: #121212;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1db954;
            color: #121212;
            text-decoration: none;
            border-radius: 30px;
            transition: 0.3s;
            animation: fadeIn 2s ease;
        }

        .back-link:hover {
            background-color: #18a64f;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>



    <h2>All Users</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="dashboard.php">⬅ Back to Dashboard</a>
</body>

</html>