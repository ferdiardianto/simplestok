<h3>Laporan Sisa Stok</h3>
<br>
<br>
<script src="<?php echo config_item('assets');?>js/jquery-ui.js"></script>
<script src="<?php echo config_item('assets');?>js/laporan.js"></script>

 <div class="row">
    <div class="col-lg-1 text-left">
        Periode:
    </div>
    <div class="col-lg-2 text-left">
        <!-- cmb cabang -->
		<select id='cmbcabang' class="form-control input-sm" >
		  <?php
		    foreach ($list_cabang as $row) {
		  ?>
		      <option value='<?php echo $row['id']; ?>'><?php echo $row['nama_cabang']; ?></option>

		  <?php
		    }
		  ?>
		</select>
    </div>
    <div class="col-lg-2 text-left">
        <input type="text" name="txtperiode1" id="txtperiode1" class="form-control input-sm">
    </div>
    <div class="col-lg-2 text-left">
        <input type="text" name="txtperiode2" id="txtperiode2" class="form-control input-sm">
    </div>
    <div class="col-lg-2 text-left">
        <button type="none" class="btn btn-primary" onclick="cari()">Cari Data</button>
    </div>
</div>

<br>
<div id="tbldata" style="overflow:scroll;width:auto; height:400px;"></div>
