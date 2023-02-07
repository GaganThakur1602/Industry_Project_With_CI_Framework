<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
      .container{
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: center;
        margin-top: 10vh;
        width: 50vw;
      }
    </style>
  </head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <div class="container">
    <h1 style="text-align:center;">Admin service desk Login</h1>
    <!-- <form method="post" action="admin_validation.php"> -->
    <?php echo validation_errors(); ?>
    <?php echo form_open('service/admin_validation') ?>    
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="a_email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3" style="margin-left: 30px;">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="a_password">
        </div>
        <div>
        <button type="submit" class="btn btn-primary"style="margin-left: 20vw;width:10vw;">LogIn</button>

        </div>
    </div>
    </form>
</body>
</html>