</div> <!-- .container-fluid -->

</main> <!-- main -->
</div> <!-- .wrapper -->
<script src="<?= admin_url('') ?>js/popper.min.js"></script>
<script src="<?= admin_url('') ?>js/moment.min.js"></script>
<script type="text/javascript" src="<?= ass_url('plugins/moment/locale/') ?>id.js"></script>
<script src="<?= admin_url('') ?>js/bootstrap.min.js"></script>
<script src="<?= admin_url('') ?>js/simplebar.min.js"></script>
<script src='<?= admin_url('') ?>js/daterangepicker.js'></script>
<script src='<?= admin_url('') ?>js/jquery.stickOnScroll.js'></script>
<script src="<?= admin_url('') ?>js/tinycolor-min.js"></script>
<!-- Select2 -->
<script src="<?= admin_url('') ?>js/select2.min.js"></script>

<!-- datetime-picker -->
<script type="text/javascript" src="<?= ass_url('plugins/datetime-picker/build/js/') ?>tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= admin_url('') ?>js/config.js"></script>
<script src="<?= admin_url('') ?>js/apps.js"></script>
<!-- Page level custom scripts -->
<script src="<?= admin_url('js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= admin_url('js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= ass_url('plugins/summernote/summernote.min.js') ?>"></script>
<script src="<?= ass_url('plugins/summernote/summernote-bs4.min.js') ?>"></script>

<script>
  var sukses = "<?= $this->session->flashdata('success') ?>";
  var error = "<?= $this->session->flashdata('error') ?>";

  if (sukses) {
    new Noty({
      type: 'success',
      text: sukses,
    }).show();
  }

  if (error) {
    new Noty({
      type: 'error',
      text: error,
    }).show();
  }

  /**
   * @param String id Selector ID
   * @param String preview Selector Class
   */
  function ubahSourceGambar(id, preview) {
    const gambar = document.querySelector('#' + id);
    gambar.addEventListener('change', function() {
      const gambarLabel = gambar.nextElementSibling;
      const img = document.querySelector('.' + preview);

      // ganti tulisan di label, ambil data yang diupload
      gambarLabel.textContent = gambar.files[0].name;

      // preview
      if (img.classList.contains('d-none')) {
        img.classList.remove('d-none');
      }

      const filegambar = new FileReader();
      filegambar.readAsDataURL(gambar.files[0]);


      filegambar.onload = function(e) {
        img.src = e.target.result;
      }
    })
  }

  function ubahSourceGambarTanpaPreview(id) {
    const gambar = document.querySelector('#' + id);
    gambar.addEventListener('change', function() {
      const gambarLabel = document.querySelector('label[for="' + id + '"].custom-file-label');
      // ganti tulisan di label, ambil data yang diupload
      gambarLabel.textContent = gambar.files[0].name;

    })
  }

  $('.select2').select2({
    theme: 'bootstrap4',
    width: '100%'
  });

  // my show hide password
  $('.show-pwd').on('click', function() {
    $(this).toggleClass('show');
    if ($(this).hasClass('show')) {
      $(this).prev().attr('type', 'text');
      $(this).find('i').attr('class', 'fa fa-eye-slash');
    } else {
      $(this).prev().attr('type', 'password');
      $(this).find('i').attr('class', 'fa fa-eye');
    }
  });

  var tabel = $('.dataTable').dataTable({
    "dom": "<'row'<'col-sm-12'tr>><'row'<'col-sm-4'i><'col-sm-3 d-flex align-items-center'l><'col-sm-5'p>>",
    "language": {
      "search": "Cari :",
      "info": "Halaman <b>_PAGE_</b> dari <b>_PAGES_</b>, jumlah data : <b>_TOTAL_</b>",
      "paginate": {
        "first": "Awal",
        "last": "Akhir",
        "next": "Selanjutnya",
        "previous": "Sebelumnya"
      },
      "infoEmpty": "Halaman 1 dari 0 Data",
      "zeroRecords": "Data masih kosong",
    }
  });

  $('.table-responsive').prepend('<input type="text" class="form-control carik" placeholder="Masukkan keyword..." style="width: 100%" />')

  $('.carik').on('keyup', function() {
    // beda kalau pencarian manual, kalau DataTable search($(this).val()).draw()
    // tapi dataTable fnFilter($(this).val())
    tabel.fnFilter($(this).val());
  });

  $('.drgpicker').daterangepicker({
    singleDatePicker: true,
    timePicker: false,
    showDropdowns: true,
    autoUpdateInput: true,
    autoApply: true
  });

  $('.drgpicker').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY'));
  });

  $('.drgpicker').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });


  $('.hapusForm, .konfirmForm').on('click', function(e) {
    e.preventDefault();
    var me = $(this);
    if (!me.find('button').attr('disabled')) {
      var n = new Noty({
        text: 'Apa anda yakin',
        modal: true,
        layout: 'center',
        timeout: false,
        progressBar: false,
        animation: {
          open: 'animated fadeIn',
          close: 'animated fadeOut'
        },
        buttons: [
          Noty.button('YES', 'btn btn-success', function() {
            me.submit();
          }),

          Noty.button('NO', 'ml-3 btn btn-light', function() {
            n.close();
          })
        ]
      });
      n.show();

    }



  })

  function set_tt(el, pesan) {
    $(el).tooltip({
      title: pesan,
      placement: 'bottom',
      trigger: 'hover'
    })
  }

  $('button[type="reset"]').on('click', function() {
    $('.is-valid').removeClass('is-valid')
    $('.is-invalid').removeClass('is-invalid')
  })

  set_tt('.lihat', 'Lihat');
  set_tt('.edit', 'Edit');
  set_tt('.hapus', 'Hapus');
  set_tt('.konfirm', 'Konfirmasi')
</script>
</body>

</html>