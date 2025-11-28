<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASEURL . 'css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'css/style.css' ?>">
    <link rel="shortcut icon" href="<?= BASEURL . 'img/icon.png'?>" type="image/png">
    <script src="<?= BASEURL . 'js/jquery.js' ?>"></script>
    <script src="<?= BASEURL . 'js/bootstrap.js' ?>"></script>
    <?php if (isset($data['css'])): ?>
        <link rel="stylesheet" href="<?= $data['css'] ?>">
    <?php endif; ?>
    <!-- icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex justify-content-between p-4">
                <div class="sidebar-logo">
                    <a href="<?= REDIRECT . 'dashboard' ?>">Laundry</a>
                </div>
                <button class="toggle-btn border-0" type="button">
                    <i id="icon" class="ri-arrow-right-double-fill"></i>
                </button>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="<?= REDIRECT . 'dashboard' ?>" class="sidebar-link">
                        <i class="ri-home-5-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item overflow-hidden">
                    <a href="<?= REDIRECT . 'pelanggan' ?>" class="sidebar-link">
                        <i class="ri-group-line"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= REDIRECT . 'transaksi' ?>" class="sidebar-link">
                        <i class="ri-exchange-dollar-line"></i>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= REDIRECT . 'laporan' ?>" class="sidebar-link">
                        <i class="ri-folder-chart-2-line"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed dropdown-toggle" role="button" data-bs-toggle="collapse"
                        data-bs-target="#sideDropdown" aria-expanded="false" aria-controls="sideDropdown">
                        <i class="ri-tools-fill"></i>
                        <span>Pengaturan</span>
                    </a>
                    <ul id="sideDropdown" class="dropdown-menu has-dropdown sidebar-dropdown collapase"
                        style="background-color: #0b0f19;">
                        <li class="sidebar-item">

                            <button type="button" class="sidebar-link" style="border:none;" data-bs-toggle="modal" data-bs-target="#hargaModal">
                                <i class="ri-currency-fill"></i>
                                <span>Ubah Harga</span>
                            </button>
                        </li>
                        <li class="sidebar-item">
                            <button type="button" class="sidebar-link" style="border:none;" data-bs-toggle="modal" data-bs-target="#pwModal">
                               <i class="ri-lock-password-line"></i>
                                <span>Ubah Password</span>
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a onclick="logOut()" class="sidebar-link text-danger">
                    <i class="ri-logout-box-line"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-5 d-flex justify-content-end shadow-sm" style="background-color: #fff;">
                <div class="profile">
                    <a onclick="profile()" role="button"
                        class="nav-icon pe-md-0 d-flex justify-content-center align-items-center gap-2 text-dark fw-medium">
                        <span><?= ucfirst($_SESSION['USER_LOGIN']) ?></span>
                        <img src="<?= BASEURL . 'img/' . $_SESSION['USER_PROFILE'] ?>" class="avatar img-fluid" alt="">
                    </a>
                </div>
            </nav>

            <div class="account">
                <div class="acc card rounded-3">
                    <div class="acc-header card-header bg-white d-flex justify-content-center align-item-center mt-2">
                        <div class="acc-img mb-3">
                            <img src="<?= BASEURL . 'img/' . $_SESSION['USER_PROFILE'] ?>" width="100px" height="100px"
                                alt="">
                        </div>
                    </div>
                    <div class="acc-body mb-2">
                        <table class="table">
                            <tr>
                                <th>Username</th>
                                <td><?= ucfirst($_SESSION['USER_LOGIN']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex flex-column acc-option mb-1">
                        <button id="logOut" onclick="logOut()">Log Out</button>
                        <button class="cancel" class="text-secondary">cancel</button>
                    </div>
                </div>
            </div>

            <div id="keluar">
                <div class="konfir">
                    <div class="ask">
                        <span>Apakah kamu ingin keluar?</span>
                    </div>
                    <div class="konfir-option">
                        <button class="cancel btn btn-secondary" class="text-secondary">cancel</button>
                        <a href="<?= REDIRECT . 'login/logOut' ?>">
                            <button id="logOut" class="btn btn-danger">Log Out</button>
                        </a>
                    </div>
                </div>
            </div>


            <!-- Modal harga -->
            <div class="modal fade" id="hargaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Harga</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= REDIRECT . 'pengaturan/ubahHarga'?>" method="post">
                        <div class="modal-body">
                            <input type="number" name="harga" id="harga" placeholder="Masukan Harga Baru" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- modal ubah password -->
            <div class="modal fade" id="pwModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                          <form action="<?= REDIRECT . 'pengaturan/ubahPassword'?>" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="oldpass" class="form-label">Password lama</label>
                                <input type="password" name="oldpass" id="oldpass" placeholder="Masukan password lama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="newpass" class="form-label">Password baru</label>
                                <input type="password" name="newpass" id="newpass" placeholder="Masukan password baru" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <style>
                .row .flash {
                    display: none;
                    position: absolute;
                    top: 70px;
                }
            </style>
            <div class="row">
                <div class="d-flex justify-content-center">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
            <script>
                function profile() {
                    $('.account').css({
                        'display': 'flex',
                        'justify-content': 'center',
                        'align-items': 'center'
                    })
                }

                function logOut() {
                    $('#keluar').css({
                        'display': 'flex',
                        'justify-content': 'center',
                        'align-items': 'center'
                    })
                }

                $('.cancel').click(function () {
                    $('.account').fadeOut();
                    $('#keluar').fadeOut();
                })

                $('.flash').delay(300).slideDown(400).delay(5000).slideUp(400);
            </script>