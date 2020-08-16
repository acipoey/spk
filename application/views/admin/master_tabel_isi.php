                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Tabel</th>
                    <th>Nama Tabel</th>
                    <th>Jenis Tabel</th>
                   <th colspan="2">Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
        <?php 

        $no = 1;
        foreach ($tabel as $tbl) : ?>

                  <tr>
                    <td><?php echo $no++ ?></a></td>
                    <td><?php echo $tbl->kode_tabel ?></td>
                    <td><?php echo $tbl->nama_tabel ?></td>
                    <td><?php if ($tbl->jenis_tabel = 1) {
                      echo 'Tabel Inti';
                    } elseif ($tbl->jenis_tabel = 2) {
                      echo 'Tabel Tambahan';
                    }  ?></td>           
                    <td><a class="tombol_hapus" href="<?php echo 'hapus_tabel/'.$tbl->id_tabel ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>             
                    <td><a class="input_master_tabel" href="<?php echo 'edit_tabel/'.$tbl->id_tabel ; ?>"><div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div></a></td> 
                  </tr>
         <?php endforeach; ?>
                  </tbody>
                </table>

<script>
  $('.input_master_tabel').on('click',function(e){

    e.preventDefault();
    var e = document.getElementById("mySelect");
    var idkec = e.options[e.selectedIndex].value;
    if (idkec){
    const href = $(this).attr('href');
    document.location.href = href;      
    } else{
      alert("Anda belum memilih Master Kecamatan");
    }

  });
</script>