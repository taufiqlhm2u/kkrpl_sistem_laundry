$(function () {
  $("#btnTambah").on("click", function () {
    // mengubah judul modal
    $("#modalMain .modal-title").html(`Tambah Transaksi`);

    // mengubah nama button
    $(".modal-footer button[type=submit]").html("Simpan");

    // mengubah aksi
    $(".modal-content form").attr(
      "action",
      `http://localhost/laundrymvc/transaksi/tambah`
    );

    // mennyembunyikan elemen yang hanya dipakai saat update
    $(".modal-body .hilang").css({ display: "none" });
    $(".modal-body .pakaianUpdate").empty();

    // menghilangkan data
    $(".modal-body #pelanggan").val("");
    $(".modal-body #tglTransaksi").val("");
    $(".modal-body #berat").val("");
    $(".modal-body #harga").val("");
    $(".modal-body #status").val("");
    $(".modal-body #tglSelesai").val("");
  });

  $(".btnUbah").on("click", function () {
    // mengubah judul modal
    $("#modalMain .modal-title").html(`Edit Transaksi`);

    // mengubah nama button
    $(".modal-footer button[type=submit]").html("Edit");

    // mengubah aksi
    $(".modal-content form").attr(
      "action",
      `http://localhost/laundrymvc/transaksi/update`
    );

    // mengambil id transaksi
    const id = $(this).data("id");

    // proses menampilkan data untuk update
    $.ajax({
      url: `http://localhost/laundrymvc/transaksi/getTransaksiId`,
      method: "post",
      data: { id: id },
      dataType: "json",
      success: function (data) {
        // mengisi data
        console.log(data);
        $(".modal-body #idUbah").val(data.transaksi.transaksi_id);
        $(".modal-body #pelanggan").val(data.transaksi.pelanggan_id);
        $(".modal-body #tglTransaksi").val(data.transaksi.transaksi_tgl);
        $(".modal-body #berat").val(data.transaksi.transaksi_berat);
        $(".modal-body #harga").val(data.transaksi.transaksi_harga);
        $(".modal-body #status").val(data.transaksi.transaksi_status);
        $(".modal-body #tglSelesai").val(data.transaksi.transaksi_tgl_selesai);

        // menampilkan element
        $(".modal-body .hilang").css({ display: "block" });
        $(".modal-body .formjenis").css({ display: "hidden" });

        // menampilkan data pakaian
        var tbody = $(".modal-body .pakaianUpdate");
        tbody.empty();
        $.each(data.pakaian, function (index, item) {
          var row = `
                                       <tr> <td><input type="text" placeholder="Masukan Jenis" class="form-control"
                                                name="jenisUpdate[]" value="${item.pakaian_jenis}" ></td>
                                        <td width="5%" class="d-flex gap-2"><input type="number" class="form-control" style="width: 50px;"
                                                placeholder="0" name="jumlahUpdate[]" value="${item.pakaian_jumlah}" > <a class="text-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus data pakaian ini?')" href="http://localhost/laundrymvc/transaksi/hapuspakaian/${item.pakaian_id}"><i class="ri-close-large-line"></i></a></td></tr>
                                                <input type="hidden" name="idPakaian[]" value="${item.pakaian_id}" >
                                    `;

          tbody.append(row);
        });
      },
    });

  });
});
