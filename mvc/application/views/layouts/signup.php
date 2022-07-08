
<h1 class="text-center">Registration</h1>

<div class="row">
    <div class="col-4 offset-4">
        <form action="/index.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="userlogin">Login</label>
                <input type="text" name="userlogin" class="form-control" required id="userlogin">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required id="password">
            </div>
            <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
<!--            <button type="submit" class="btn btn-primary" name="login">Log in</button>-->
<!--            <a href="application/views/layouts/login.php" name="login">Log in</a>-->
        </form>

    </div>

</div>

