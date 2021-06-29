<!-- tambahan css -->
<style type="text/css">
 .pricing .card {
    border: none;
    border-radius: 1rem;
    transition: all 0.2s;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
  }
  .pricing hr {
    margin: 1.5rem 0;
  }
  .pricing h6 {
      padding-bottom: 30px;
    color: #121212;
  }
  .pricing h5 {
    color: #7571f9;
    font-weight: bold;
    font-size: 30px;
  }
  .pricing .card-title {
    margin: 0.5rem 0;
    font-size: 2rem;
    letter-spacing: .1rem;
  }
  .pricing .card-price {
    font-size: 3rem;
    margin: 0;
  }
  .col-lg-6{
    padding-bottom: 20px;
  }

  .pricing .card-price .period {
    font-size: 0.8rem;
  }

  .pricing ul li {
    margin-bottom: 1rem;
    color: #121212;
  }
  .pricing .fa-check{
      color: #1cc88a;
  }
  .pricing .fa-times{
      color: #e74a3b;
  }
  .pricing .text-muted {
    opacity: 0.7;
  }
  .pricing .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    opacity: 0.7;
    transition: all 0.2s;
  }
  /* Hover Effects on Card */

  @media (min-width: 992px) {
    .pricing .card:hover {
      margin-top: -.25rem;
      margin-bottom: .25rem;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
    }
    .pricing .card:hover .btn {
      opacity: 1;
    }
  }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
             <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 style="color: #292929;" class="m-0 font-weight-bold">Belanja Paket Mitra</h3>
                </div>
                <div class="card-body">
                    <div class="row pricing">
                        <!-- PAKET 1 -->
                        <div class="col-lg-6">
                          <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                              <h5 class="card-titletext-uppercase text-center">Paket POC 1 Liter</h5>
                              <hr>
                              <h6 class="card-price text-center">Rp. 2.700.000 </h6>
                              <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 20 Botol Pupuk Kilat 1 Liter</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free 5 Botol Pupuk Kilat 500ml</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Ongkir Rp. 100.000</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan Kaos Mitra</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 4 Baju Petani</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapat Banner, Brosur, dan Petunjuk Teknis untuk keperluan promosi</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Konsultasi Agro Konsultan</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></i></span>Reward Tahunan Honda Beat Target 2.000 Botol POC 1 Liter</li>
                              </ul>
                              <?php 
                              //form untuk memproses belanjaan
                              echo form_open(base_url('mitra/add')); 
                              //elemen yang dibawa
                              echo form_hidden('id', 'POC');
                              echo form_hidden('id_produk', 'POC');
                              echo form_hidden('id_promo', null);
                              echo form_hidden('qty', 1);
                              echo form_hidden('jumlah', 20);
                              echo form_hidden('bonus', 5);
                              echo form_hidden('price', 2700000);
                              echo form_hidden('name', 'Pupuk Kilat 1L');
                              echo form_hidden('nama', 'Paket POC 1 Liter');
                              echo form_hidden('gambar', 'POC.jpg');
                              echo form_hidden('option', 1);
                              //elemen redirect
                              echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                              ?>
                              <button class="btn btn-block btn-primary text-uppercase"><i class="fa fa-shopping-cart"></i>  Beli Sekarang</button>
                            <?php echo form_close(); ?>
                            </div>
                          </div>
                        </div>
                        <!-- PAKET 2 -->
                        <div class="col-lg-6">
                          <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                              <h5 class="card-titletext-uppercase text-center">Paket POC 500ml</h5>
                              <hr>
                              <h6 class="card-price text-center">Rp. 3.200.000</h6>
                              
                              <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 40 Botol Pupuk Kilat 1 Liter</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free 5 Botol Pupuk Kilat 500ml</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Ongkir Rp. 100.000</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan Kaos Mitra</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 4 Baju Petani</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapat Banner, Brosur, dan Petunjuk Teknis untuk keperluan promosi</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Konsultasi Agro Konsultan</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></i></span>Reward Tahunan Honda Beat Target 4.000 Botol POC 500ml</li>
                              </ul>
                              <?php 
                              //form untuk memproses belanjaan
                              echo form_open(base_url('mitra/add')); 
                              //elemen yang dibawa
                              echo form_hidden('id', 'POC500');
                              echo form_hidden('id_produk', 'POC500');
                              echo form_hidden('id_promo', null);
                              echo form_hidden('qty', 1);
                              echo form_hidden('jumlah', 40);
                              echo form_hidden('bonus', 5);
                              echo form_hidden('price', 3200000);
                              echo form_hidden('name', 'Pupuk Kilat 500ml');
                              echo form_hidden('nama', 'Paket POC 500ml');
                              echo form_hidden('gambar', 'POC.jpg');
                              echo form_hidden('option', 1);
                              //elemen redirect
                              echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                              ?>
                              <button class="btn btn-block btn-primary text-uppercase"><i class="fa fa-shopping-cart"></i>  Beli Sekarang</button>
                              <?php echo form_close() ?>
                            </div>
                          </div>
                        </div>
                        <!-- PAKET 3 -->
                        <div class="col-lg-6">
                          <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                              <h5 class="card-titletext-uppercase text-center">Paket Nutrisi Ternak</h5>
                              <hr>
                              <h6 class="card-price text-center">Rp. 3.400.000</h6>
                              
                              <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 40 Botol Nutrisi Ternak</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free 5 Botol Nutrisi Ternak</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Ongkir Rp. 100.000</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan Kaos Mitra</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 4 Baju Petani</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapat Banner, Brosur, dan Petunjuk Teknis untuk keperluan promosi</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Konsultasi Agro Konsultan</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></i></span>Reward Tahunan Honda Beat Target 4.000 Botol Nutrisi Ternak</li>
                              </ul>
                              <?php 
                              //form untuk memproses belanjaan
                              echo form_open(base_url('mitra/add')); 
                              //elemen yang dibawa
                              echo form_hidden('id', 'NUTRISITERNAK');
                              echo form_hidden('id_produk', 'NUTRISITERNAK');
                              echo form_hidden('id_promo', null);
                              echo form_hidden('qty', 1);
                              echo form_hidden('jumlah', 20);
                              echo form_hidden('bonus', 5);
                              echo form_hidden('price', 2700000);
                              echo form_hidden('name', 'Nutrisi Ternak');
                              echo form_hidden('nama', 'Paket Nutrisi Ternak');
                              echo form_hidden('gambar', 'ternak.webp');
                              echo form_hidden('option', 1);
                              //elemen redirect
                              echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                              ?>
                              <button href="#" class="btn btn-block btn-primary text-uppercase"><i class="fa fa-shopping-cart"></i>  Beli Sekarang</button>
                              <?php echo form_close() ?>
                            </div>
                          </div>
                        </div>
                        <!-- PAKET 3 -->
                        <div class="col-lg-6">
                          <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                              <h5 class="card-titletext-uppercase text-center">Paket Nutrisi Ikan</h5>
                              <hr>
                              <h6 class="card-price text-center">Rp. 3.400.000</h6>
                              
                              <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 40 Botol Nutrisi Ikan</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free 5 Botol Nutrisi Ikan</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Ongkir Rp. 100.000</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan Kaos Mitra</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapatkan 4 Baju Petani</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Mendapat Banner, Brosur, dan Petunjuk Teknis untuk keperluan promosi</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Konsultasi Agro Konsultan</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></i></span>Reward Tahunan Honda Beat Target 4.000 Nutrisi Ikan</li>
                              </ul>
                              <?php 
                              //form untuk memproses belanjaan
                              echo form_open(base_url('mitra/add')); 
                              //elemen yang dibawa
                              echo form_hidden('id', 'NUTRISIIKAN');
                              echo form_hidden('id_produk', 'NUTRISIIKAN');
                              echo form_hidden('id_promo', null);
                              echo form_hidden('qty', 1);
                              echo form_hidden('jumlah', 20);
                              echo form_hidden('bonus', 5);
                              echo form_hidden('price', 3400000);
                              echo form_hidden('name', 'Nutrisi Ikan');
                              echo form_hidden('nama', 'Paket Nutrisi Ikan');
                              echo form_hidden('gambar', 'ikan.webp');
                              echo form_hidden('option', 1);
                              //elemen redirect
                              echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                              ?>
                              <button class="btn btn-block btn-primary text-uppercase"><i class="fa fa-shopping-cart"></i>  Beli Sekarang</button>
                              <?php echo form_close() ?>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->