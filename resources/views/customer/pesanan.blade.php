<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Sayuran - Sakura Hidroponik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3">
    <a href="index.html" class="navbar-brand fw-bold text-success">
      <i class="fas fa-leaf me-2"></i>Sakura Hidroponik
    </a>
    <div class="ms-auto">
      <a href="cart.html" class="btn btn-outline-success">
        <i class="fas fa-shopping-basket"></i>
      </a>
    </div>
  </nav>

  <!-- Title -->
  <div class="bg-light py-4 mb-4">
    <div class="container text-center">
      <h2 class="fw-bold">Keranjang Sayuran</h2>
      <p class="text-muted">Beranda / Keranjang</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container mb-5">
    <div class="row">
      <!-- Cart Table -->
      <div class="col-md-8">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>Produk</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Total Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- Item 1 -->
              <tr>
                <td><img src="https://via.placeholder.com/50" class="rounded" alt="Selada"></td>
                <td>Selada</td>
                <td>Rp 21.000</td>
                <td>
                  <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-success me-2"><i class="fas fa-minus"></i></button>
                    <span>2</span>
                    <button class="btn btn-sm btn-outline-success ms-2"><i class="fas fa-plus"></i></button>
                  </div>
                </td>
                <td>Rp 42.000</td>
                <td><button class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></button></td>
              </tr>
              <!-- Item 2 -->
              <tr>
                <td><img src="https://via.placeholder.com/50" class="rounded" alt="Pakcoy"></td>
                <td>Pakcoy</td>
                <td>Rp 21.000</td>
                <td>
                  <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-success me-2"><i class="fas fa-minus"></i></button>
                    <span>2</span>
                    <button class="btn btn-sm btn-outline-success ms-2"><i class="fas fa-plus"></i></button>
                  </div>
                </td>
                <td>Rp 42.000</td>
                <td><button class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Cart Summary -->
      <div class="col-md-4">
        <div class="p-4 bg-light rounded shadow-sm">
          <h5 class="fw-bold mb-3">Total Belanja</h5>
          <div class="d-flex justify-content-between mb-2">
            <span>Total:</span>
            <span class="fw-bold">Rp 84.000</span>
          </div>
          <small class="text-muted d-block mb-3">Harga diatas tidak termasuk ongkir</small>
          <a href="/konfirmasi" class="btn btn-success w-100">KONFIRMASI</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-light py-4">
    <div class="container">
      <div class="row align-items-center">
        <!-- Left Side -->
        <div class="col-md-6 d-flex align-items-start">
          <img src="https://via.placeholder.com/80" class="rounded me-3" alt="Logo">
          <div>
            <h5>Sakura Hidroponik</h5>
            <p class="text-muted mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
          </div>
        </div>
        <!-- Right Side -->
        <div class="col-md-6 mt-3 mt-md-0">
          <p class="mb-1"><strong>Alamat:</strong> Link. Kromasan Rt 02 Rw 07, Beru, Wlingi, Blitar</p>
          <p class="mb-1"><strong>Kontak:</strong> 089789455678</p>
        </div>
      </div>
      <hr>
      <p class="text-center small mb-0">© Copyright <strong>RPLutioners</strong>. All Rights Reserved. Designed by WonderWoman</p>
    </div>
  </footer>

</body>
</html>
