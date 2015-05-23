
<button class="btn btn-primary" type="none" id='btntambah' onclick='tambah()'>Tambah</button>
<button class="btn btn-default" type="none" id='btnubah' onclick='ubah()'>Ubah</button>
<button class="btn btn-default" type="none" id='btnhapus' onclick='hapus()'>Hapus</button>

<br>
<br>

<table id="jqGrid"></table>
<div id="jqGridPager"></div>

<script src="<?php echo config_item('assets');?>js/mastercabang.js"></script>

<div class="modal fade" id='modaldetailcabang'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Cabang</h4>
      </div>
      <div class="modal-body">

      	<!--
      	<form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
		-->
		<form>
          <div class="form-group">
            <label for="txtnamacabang" class="control-label">Nama Cabang:</label>
            <input type="hidden" class="form-control" id="txtid">
            <input type="text" class="form-control" id="txtnamacabang">
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