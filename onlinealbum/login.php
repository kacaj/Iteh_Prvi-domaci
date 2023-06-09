<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script> 
    <title>Prijava</title>
</head>

<body>
    <div class="site-title">
        <br></br>
        <p> DOBRODOŠLI U NAŠ ONLINE PORODIČNI ALBUM </p>
        
    </div>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <form id="login-forma">
            <div class="mb-3">
                <label for="" class="form-label">Korisničko ime</label>
                <input type="text" class="form-control" name="korisnicko_ime" id="korisnicko_ime" placeholder="">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Šifra</label>
                <input type="password" class="form-control" name="sifra" id="sifra" placeholder="">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary ">Pristupi našem albumu!</button>
            </div>

        </form>
    </div>
</body>

</html>