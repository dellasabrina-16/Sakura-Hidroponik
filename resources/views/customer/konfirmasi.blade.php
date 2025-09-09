<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Pesanan - Sakura Hidroponik</title>
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
      <h2 class="fw-bold">Konfirmasi Pesanan</h2>
      <p class="text-muted">Beranda / Checkout</p>
    </div>
  </div>

  <!-- Checkout Form + Order Table -->
  <div class="container mb-5">
    <div class="row">
      <!-- Form -->
      <div class="col-md-6 mb-4">
        <h5 class="fw-bold mb-3">Lengkapi Data Pesanan Anda</h5>
        <form>
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" placeholder="Nama Lengkap">
          </div>
          <div class="mb-3">
            <label class="form-label">No WhatsApp</label>
            <input type="text" class="form-control" placeholder="08xxxxxxx">
          </div>
          <div class="mb-3">
            <label class="form-label">Opsi Pengiriman / Pengambilan</label>
            <select class="form-select">
              <option>Pilih opsi</option>
              <option>Diantar</option>
              <option>Ambil di tempat</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" rows="3"></textarea>
          </div>
        </form>
      </div>

      <!-- Order Summary -->
      <div class="col-md-6">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th>Produk</th>
              <th>Harga</th>
              <th>Kuantitas</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Selada</td>
              <td>Rp 21.000</td>
              <td>2</td>
              <td>Rp 42.000</td>
            </tr>
            <tr>
              <td>Pakcoy</td>
              <td>Rp 21.000</td>
              <td>2</td>
              <td>Rp 42.000</td>
            </tr>
            <tr>
              <td colspan="3" class="text-end fw-bold">Total:</td>
              <td class="fw-bold">Rp 84.000</td>
            </tr>
          </tbody>
        </table>
        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#successModal">
          PESAN SEKARANG
        </button>
      </div>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
        <div class="mb-3">
          <i class="fas fa-check-circle fa-3x text-success"></i>
        </div>
        <h5 class="fw-bold">Pesanan Berhasil!</h5>
        <p class="mb-1">Terima kasih, pesananmu telah kami terima.</p>
        <p class="text-muted">Tunggu info selanjutnya melalui WhatsApp, ya!</p>
        <button class="btn btn-success" data-bs-dismiss="modal">Ok</button>
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
            <p class="text-muted mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
