<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body style="margin:0; font-family: Arial, sans-serif; background: linear-gradient(135deg, #6a11cb, #2575fc); height:100vh; display:flex; justify-content:center; align-items:center;">

    <div style="background:#fff; padding:40px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.2); width:350px;">
        <h2 style="text-align:center; color:#333; margin-bottom:30px;">Login</h2>

        <form method="POST" >
            @csrf

            <div style="margin-bottom:20px;">
                <label for="email" style="display:block; margin-bottom:5px; color:#555;">Email</label>
                <input type="email" name="email" id="email" required
                       style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
            </div>

            <div style="margin-bottom:25px;">
                <label for="password" style="display:block; margin-bottom:5px; color:#555;">Password</label>
                <input type="password" name="password" id="password" required
                       style="width:100%; padding:10px 15px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
            </div>

            <button type="submit" 
                    style="width:100%; padding:12px; background:#2575fc; color:#fff; border:none; border-radius:8px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s;">
                Login
            </button>

            <p style="text-align:center; margin-top:15px; font-size:14px; color:#888;">
                Don't have an account? <a href="#" style="color:#2575fc; text-decoration:none;">Sign up</a>
            </p>
        </form>
    </div>

</body>