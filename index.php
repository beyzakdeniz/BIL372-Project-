<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

		#icon {
            width: 300px;
            height: 300px;
            margin-top: 20px;
        }
        
    </style>
</head>
<body>

    <h1>Mahmut Tuncer Kurs Merkezi'ne Hoşgeldiniz!</h1>

    <button onclick="redirectToAdmin()">Admin Girişi</button>
    <button onclick="redirectToTeacher()">Öğretmen Girişi</button>
    <button onclick="redirectToStudent()">Öğrenci Girişi</button>

    <div>
		<img id="icon" src="BIL372-Project-/favicon.jpg" alt="Icon">
		
    </div>

    <script>
        function redirectToAdmin() {
            window.location.href = 'BIL372-Project-/admin_login.php';
        }

        function redirectToTeacher() {
            window.location.href = 'BIL372-Project-/teacher_login.php';
        }

        function redirectToStudent() {
            window.location.href = 'BIL372-Project-/student_login.php';
        }
    </script>

</body>
</html>