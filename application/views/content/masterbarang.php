<button class="btn btn-primary" type="none" id='btntambah' onclick='tambah()'>Tambah</button>
<button class="btn btn-default" type="none" id='btnubah' onclick='ubah()'>Ubah</button>
<button class="btn btn-default" type="none" id='btnhapus' onclick='hapus()'>Hapus</button>

<br>
<br>
Cabang:
<!-- cmb cabang -->
<select id='cmbcabang' onchange='gridchange(this.value)'>
  <?php
    foreach ($list_cabang as $row) {
  ?>
      <option value='<?php echo $row['id']; ?>'><?php echo $row['nama_cabang']; ?></option>

  <?php
    }
  ?>
</select>

<br>
<br>


<table id="jqGrid"></table>
<div id="jqGridPager"></div>

<script src="<?php echo config_item('assets');?>js/masterbarang.js"></script>



<!-- modal -->
<div class="modal fade" id='modaldetailcabang'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Master Barang</h4>
      </div>
      <div class="modal-body">

		  <form>
        <div class="form-group">
          <label for="txtkdbarang" class="control-label">Kode Barang:</label>
          <input type="text" class="form-control" id="txtkdbarang">
        </div>

         <div class="form-group">
          <label for="txtnamabarang" class="control-label">Nama Barang:</label>
          <input type="text" class="form-control" id="txtnamabarang">
        </div>

        <!-- radio button -->
        <div class="form-group">
          <label class="control-label">Berdasarkan:</label>
          <input type="radio" name="optionsRadios" id="rjumlah" value="1"> Jumlah
          <input type="radio" name="optionsRadios" id="rberat" value="2">Berat
        </div>


        <div class="form-group" id='fieldjumlah'>
          <label for="txtjumlah" class="control-label">Jumlah:</label>
          <input type="text" class="form-control" id="txtjumlah" onblur='konversiangka(1)'>
        </div>

         <div class="form-group row" id='fieldberat'>

          <div class="col-lg-2 text-left">
            <label for="txtberatkg" class="control-label">Kg:</label>
            <input type="text" class="form-control" id="txtberatkg" onkeyup='konversikgtog()'>
          </div>

          <div class="col-lg-2 text-left">
            <label for="txtberat" class="control-label">Gram:</label>
            <input type="text" class="form-control" id="txtberat" onkeyup='konversigtokg()'>
          </div>
        
        </div>

         <div class="form-group">
          <label for="txtharga" class="control-label">Harga:</label>
          <input type="text" class="form-control" id="txtharga" onblur='konversiangka(3)'>
        </div>
      </form>


      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" onclick='do_save()'>Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->