<div class="container d-flex justify-content-center">
    <div style="width: 400px; background-color: white;" class="shadow p-4 rounded">
        <h1 id="judul">Login</h1>
        <hr>
        <form action="<?= REDIRECT . 'login/loginCek' ?>" method="post"> 
            <div class="mb-3">
                <label for="username" class="form-label">Useraname</label>
                <input type="text" class="form-control" name="username" id="username"
                    placeholder="Masukan Username" required />
            </div>
            <div class="mb-4">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="pass"
                    placeholder="Masukan Password" required/>
            </div>
            <div>
                <button class="btn btn-primary w-100" type="submit" id="sub">Submit</button>
            </div>
        </form>
        <div id="hal"></div>
    </div>
</div>