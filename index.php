<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Kelontong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="card mx-auto" style="width: 380px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Login Toko</h3>
            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="admin" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="12345" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="pemilik">Pemilik</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>