<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php

        session_start();

         if (isset($_POST['register'])) {
            handleRegistration();
        } elseif (isset($_POST['login'])) {
            if ($_POST['login'] === 'yes') {
                showLoginForm();
            } else {
                echo '<div class="success-message">Goodbye!</div>';
                session_destroy();
            }
        } elseif (isset($_POST['doLogin'])) {
            handleLogin();
        } elseif (isset($_POST['verifyPin'])) {
            verifyPinCode();
        } else {
            showRegistrationForm();
        }

        //initialize user data array in session if not exists
        if (!isset($_SESSION['userData'])) {
            $_SESSION['userData'] = array();
        }
        
        //function to display registration form
        function showRegistrationForm() {
            echo '
            <h1>User Registration</h1>
            <form method="post">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                
                <div class="form-group">
                    <label for="course">Course</label>
                    <input type="text" id="course" name="course" required>
                </div>
                
                <div class="form-group">
                    <label for="yearLevel">Year Level</label>
                    <input type="text" id="yearLevel" name="yearLevel" required>
                </div>
                
                <div class="form-group">
                    <label for="section">Section</label>
                    <input type="text" id="section" name="section" required>
                </div>
                
                <div class="form-group">
                    <label for="userName">Username</label>
                    <input type="text" id="userName" name="userName" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="pinCode">Pin Code (max 8 digits)</label>
                    <input type="number" id="pinCode" name="pinCode" maxlength="8" required>
                </div>
                
                <button type="submit" name="register">Register</button>
            </form>';
        }
        
        //function to handle registration
        function handleRegistration() {

            if (strlen($_POST['pinCode']) > 8) {
                echo '<div class="error-message">PinCode must be maximum 8 digits long.</div>';
                showRegistrationForm();
                return;
            }

            $_SESSION['userData'] = array(
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'course' => $_POST['course'],
                'yearLevel' => $_POST['yearLevel'],
                'section' => $_POST['section'],
                'userName' => $_POST['userName'],
                'password' => $_POST['password'],
                'pinCode' => $_POST['pinCode']
            );
            
            echo '<div class="success-message">Registration completed successfully!</div>';
            showLoginPrompt();
        }
        
        //function to show login prompt
        function showLoginPrompt() {
            echo '
            <form method="post">
                <p style="text-align: center;">Would you like to login now?</p>
                <button type="submit" name="login" value="yes">Yes, Login</button>
                <button type="submit" name="login" value="no" style="background-color: #95a5a6; margin-top: 10px;">No, Exit</button>
            </form>';
        }
        
        //function to show login form
        function showLoginForm() {
            echo '
            <h1>User Login</h1>
            <form method="post">
                <div class="form-group">
                    <label for="loginUsername">Username</label>
                    <input type="text" id="loginUsername" name="loginUsername" required>
                </div>
                
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="loginPassword" required>
                </div>
                
                <button type="submit" name="doLogin">Login</button>
            </form>';
        }
        
        //function to handle login
        function handleLogin() {
            if ($_POST['loginUsername'] !== $_SESSION['userData']['userName'] || 
                $_POST['loginPassword'] !== $_SESSION['userData']['password']) {
                echo '<div class="error-message">Invalid username or password.</div>';
                showLoginForm();
                return;
            }
            
            //username and password are correct, now ask for pin code
            echo '
            <div class="success-message">Username and password verified. Please enter your Pin Code.</div>
            <form method="post">
                <div class="form-group">
                    <label for="loginPinCode">Pin Code</label>
                    <input type="number" id="loginPinCode" name="loginPinCode" required>
                </div>
                <input type="hidden" name="loginUsername" value="'.$_POST['loginUsername'].'">
                <input type="hidden" name="loginPassword" value="'.$_POST['loginPassword'].'">
                <button type="submit" name="verifyPin">Verify Pin Code</button>
            </form>';
        }
        
        //function to verify pin code
        function verifyPinCode() {
            if ($_POST['loginPinCode'] !== $_SESSION['userData']['pinCode']) {
                echo '<div class="error-message">Invalid Pin Code.</div>';
                handleLogin(); //show login form again
                return;
            }
            
            //if pin code is correct, show user info
            echo '
            <div class="success-message">Login successful!</div>
            <div class="user-info">
                <h2>User Information</h2>
                <p><strong>First Name:</strong> '.$_SESSION['userData']['firstName'].'</p>
                <p><strong>Last Name:</strong> '.$_SESSION['userData']['lastName'].'</p>
                <p><strong>Course:</strong> '.$_SESSION['userData']['course'].'</p>
                <p><strong>Year Level:</strong> '.$_SESSION['userData']['yearLevel'].'</p>
                <p><strong>Section:</strong> '.$_SESSION['userData']['section'].'</p>
                <p><strong>Username:</strong> '.$_SESSION['userData']['userName'].'</p>
            </div>';
        }
        ?>
    </div>
</body>
</html>