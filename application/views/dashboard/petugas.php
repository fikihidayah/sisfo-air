<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-md-6 col-xl-3 mb-4 pl-0">
        <div class="card shadow bg-white text-dark border-0">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <span class="circle circle-sm bg-primary">
                  <i class="fe fe-16 fe-anchor text-light mb-0"></i>
                </span>
              </div>
              <div class="col pr-0">
                <p class="small text-muted mb-0">Satuan</p>
                <span class="h3 mb-0 text-dark"><?= $satuan ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-3 mb-4 pl-0">
        <div class="card shadow bg-white text-dark border-0">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <span class="circle circle-sm bg-primary">
                  <i class="fe fe-16 fe-command text-light mb-0"></i>
                </span>
              </div>
              <div class="col pr-0">
                <p class="small text-muted mb-0">Kategori</p>
                <span class="h3 mb-0 text-dark"><?= $kategori ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3 mb-4 pl-0">
        <div class="card shadow bg-white text-dark border-0">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <span class="circle circle-sm bg-primary">
                  <i class="fe fe-16 fe-check-square text-light mb-0"></i>
                </span>
              </div>
              <div class="col pr-0">
                <p class="small text-muted mb-0">Konfirmasi Anggaran</p>

                <div class="row align-items-center no-gutters">
                  <div class="col-auto">
                    <span class="h3 mr-2 mb-0"> <?= $anggaran_konfirmasi ?>% </span>
                  </div>
                  <div class="col-md-12 col-lg">
                    <div class="progress progress-sm mt-2" style="height:3px">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?= $anggaran_konfirmasi ?>%" aria-valuenow="<?= $anggaran_konfirmasi ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3 mb-4 pl-0">
        <div class="card shadow bg-white text-dark border-0">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-3 text-center">
                <span class="circle circle-sm bg-primary">
                  <i class="fe fe-16 fe-check-square text-light mb-0"></i>
                </span>
              </div>
              <div class="col pr-0">
                <p class="small text-muted mb-0">Konfirmasi Aliran</p>

                <div class="row align-items-center no-gutters">
                  <div class="col-auto">
                    <span class="h3 mr-2 mb-0"> <?= $aliran_konfirmasi ?>% </span>
                  </div>
                  <div class="col-md-12 col-lg">
                    <div class="progress progress-sm mt-2" style="height:3px">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?= $aliran_konfirmasi ?>%" aria-valuenow="<?= $aliran_konfirmasi ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col pl-0">
        <div class="card shadow">
          <div class="card-header bg-info d-flex align-items-center text-white"><i class="fe fe-info fe-24 mr-3"></i> Petunjuk</div>

          <div class="card-body">
            <ol class="pl-3">
              <li>Isikan Data Mulai dari Menu Atribut Dahulu</li>
              <li>Anda bisa mengkonfirmasi status surat aliran atau anggaran pipa</li>
              <li>Anda bisa menambahkan kantor anggaran dan kantor aliran, tetapi hati-hati karena anda tidak bisa menghapus data pada semua menu</li>
            </ol>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>