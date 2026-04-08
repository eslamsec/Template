<?php
if(!$option ) return;
$guid = (int)$option['guid'];
$data = $option['data'];
$voucher_guid = (int)$data['voucher_guid'];
$storeArray = $option['storeArray'];
$trf = $data['trf_guid'];
$rec = $data['recv_guid'];
$trfVoucher = $data['trf_voucher'];
$stVoucher  = get_option("erp_transaction_settings", "title", "  voucher_guid  =19 and status = '1' ");
// print_r($data);
?>
<div class="row mt-4">
    <div class="col-sm-4">
        <div class="sp-bw-center">
                <label>Auto Stock Transfer </label>
                <select class="form-control form-control-sm" style="width:10pc" name="trf_voucher">
                    <!-- <option value="0">Select Store</option> -->
                    <?php echo array_options($stVoucher, $trfVoucher);	?>
                </select>
        </div>
    </div>   
    <div class="col-sm-4">
        <div class="sp-bw-center">
                <label>Transfer Store</label>
                <select class="form-control form-control-sm" style="width:10pc" name="trf_guid">
                    <!-- <option value="0">Select Store</option> -->
                    <?php echo array_options($storeArray, $trf);	?>
                </select>
        </div>
    </div>
    <div class="col-sm-4">
    <div class="sp-bw-center">
                <label>Receiving Store</label>
                <select class="form-control form-control-sm" style="width:10pc" name="recv_guid">
                    <!-- <option value="0">Select Store</option> -->
                    <?php echo array_options($storeArray, $rec);	?>
                </select>
        </div>
    </div>
</div>