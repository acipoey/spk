<div class="conten-wrapper">
	    <section class="content-header">
      <h1>
        Data User
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>
    <section class="content">
    	<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Tambah Data User</button>
    <div class="flash-data" data-flashdata="<?php if($this->session->flashdata('flash')){
      echo $this->session->flashdata('flash');}
      else{
        echo 'kosong';
      }; ?>">
    </div>
      <div class="table-responsive">
    	<table class="table">
    		<tr>
    			<th>No.</th>
    			<th>Username</th>
    			<th>First Name</th>
    			<th>E-mail</th>
          <th colspan="2">Aksi</th>     			
    		</tr>
    		<?php 

    		$no = 1;
    		foreach ($user as $usr) : ?>
    			<tr>
    				<td><?php echo $no++ ?></td> 
    				<td><?php echo $usr->username ?></td>
    				<td><?php echo $usr->first_name ?></td>
    				<td><?php echo $usr->email ?></td>
            <td><a class="tombol_hapus" href="<?php echo 'KCA/hapus_buku/'.$usr->id ?>"><div class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></div></a></td>
            <td><?php echo anchor('admin/user/edit/'.$usr->id,'<div class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></div>') ?></td>
          </tr>
    		
    		 <?php endforeach; ?>
    	</table>
    </div>
    </section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" align="center"><b>FORM INPUT DATA USER</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <?php echo form_open_multipart('admin/user/tambah_user'); ?>
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control">		
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control">		
		</div>
		<div class="form-group">
			<label>Nama Depan</label>
			<input type="text" name="first_name" class="form-control">		
		</div>			
		<div class="form-group">
			<label>Nama Belakang</label>
			<input type="text" name="last_name" class="form-control">		
		</div>		
		<div class="form-group">
			<label>Nomor Handphone</label>
			<input type="text" name="phone" class="form-control">		
		</div>
		<div class="form-group">
			<label>E-mail</label>
			<input type="email" name="email" class="form-control">		
		</div>
    <div class="form-group">
      <label>Unit Kerja</label>
      <select name="id_satker" class="form-control">
        <option value="" selected disabled hidden>Choose here</option>
        <option value="0">Kepala BPS Kabupaten/Kota</option>
        <option value="1">Seksi Tata Usaha</option>
        <option value="2">Seksi Statistik Sosial</option>
        <option value="3">Seksi Statistik Produksi</option>
        <option value="4">Seksi Statistik Distribusi</option>
        <option value="5">Seksi Nerwilis</option>
        <option value="6">Seksi IPDS</option>
        <option value="7">KSK</option>
      </select>    
    </div>
    <div class="form-group">
      <label>Upload Foto</label>
      <input type="file" name="photo" class="form-control">    
    </div>
	      <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      <button type="submit" class="btn btn-primary">Simpan</button>
	  	  </div>

    <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

</div>