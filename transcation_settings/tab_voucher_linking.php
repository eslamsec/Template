<?php
if(!$option ) return;
$purchase_vouchers = (array)$option['purchase_vouchers'];
$pr_and_grn = (array)$option['all_vouchers_list'];
$po_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 9 AND status = '1'");
$lc_process_voucher = (int)$option['data']['purch_sugg_vid'];
$grn_process_voucher = (int)$option['data']['grn_sugg'];
$po_process_voucher = (int)$option['data']['po_sugg'];
$pr_process_voucher = (int)$option['data']['pr_sugg'];
$so_sugg_vid = (int)$option['data']['so_sugg_vid'];
$dn_sugg_vid = (int)$option['data']['dn_sugg_vid'];
$sales_sugg_vid = (int)$option['data']['sales_sugg_vid'];
$guid = (int)$option['guid'];
$data = $option['data'];
$voucher_guid = (int)$data['voucher_guid'];
$pfilter_vid = ($data['pfilter_vid']) ? unserialize($data['pfilter_vid']) : [];
$all_sales_vouchers = findQuery("SELECT id,title, voucher_guid as voucher_type FROM erp_transaction_settings WHERE voucher_guid IN (3,4,5) AND status = '1'");
$cardLedgers = findQuery("SELECT l.id as ledger_id,l.name as ledger,c.* FROM `card_master` c JOIN erp_ledgers l ON c.account_id = l.id;");
$branches = findQuery("SELECT id,name from erp_outlet ");
$aprovd_edit = $data['aprovd_edit'];
if($aprovd_edit == 1) $aprovd_edit = 'checked'; 
// print_r($pfilter_vid);
// echo $pfilter_vid['po'];
$wallet_gl_count = 0;
$cc_gl_count = 0;
$dc_gl_count = 0;
foreach($cardLedgers as $g){
    if($g['type'] == 1) $cc_gl_count++;
    if($g['type'] == 2) $dc_gl_count++;
    if($g['type'] == 3) $wallet_gl_count++;
}
?>
<div class="row">
    <div class="col-sm-4">
    <h6 class="text-info" > <i class="fas fa-link" ></i><i> Voucher Linking (Auto Selection)</i></h5>

            <div id="process_purchase_voucher_div2" class="mb-3 form-group" <?php if (in_array($voucher_guid, [9, 10,11])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
            <?php if($voucher_guid == 11) { ?><label for="lc_process_voucher2">LC Auto Posting Voucher <br> <i>(LC  to  Purchase) </i></label><?php } ?>   
            <?php if($voucher_guid == 10) { ?><label for="lc_process_voucher2">GRN Auto Posting Voucher <br> <i>(GRN  to  Purchase) </i></label><?php } ?>
                <?php if($voucher_guid == 9) { ?><label for="lc_process_voucher2">PO Auto Posting Voucher <br> <i>(PO  to  Purchase) </i></label> <?php } ?>
                <select name="purch_sugg_vid" id="lc_process_voucher2" class="form-control form-control-sm">
                    <option value="0">Select Purchase Voucher</option>
                    <?php
                    foreach ($purchase_vouchers as $vtype) {
                        $selected = ($vtype['id'] == $lc_process_voucher) ? 'selected' : '';
                        echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                    } ?>
                </select>
            </div>
            <div class="mb-3 form-group  process_po_voucher_div" <?php if (in_array($voucher_guid, [9])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label for="grn_sugg">PO Auto Posting Voucher <br> <i>(PO  to  GRN) </i></label>
                <select name="grn_sugg" id="grn_sugg" class="form-control form-control-sm">
                    <option value="0">Select GRN Voucher</option>
                    <?php
                    foreach ($pr_and_grn as $vtype) {
                        if ($vtype['type'] == 10) {
                            $selected = ($vtype['id'] == $grn_process_voucher) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="mb-3 form-group  related-fields 29" <?php if (in_array($voucher_guid, [29])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label >IR Auto Posting Voucher <br> <i>(IR  to  PR) </i></label>
                <select name="pr_sugg"  class="form-control form-control-sm">
                    <option value="0">Select PR Voucher</option>
                    <?php
                    foreach ($pr_and_grn as $vtype) {
                           if ($vtype['type'] != 15) continue;
                            $selected = ($vtype['id'] == $pr_process_voucher) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        
                    } ?>
                </select>
            </div>
            <!-- <div class="mb-3 form-group  related-fields 29" <?php if (in_array($voucher_guid, [29])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label >IR Auto Posting Voucher <br> <i>(IR  to  PO) </i></label>
                <select name="po_sugg"  class="form-control form-control-sm">
                    <option value="0">Select PO Voucher</option>
                    <?php
                    // foreach ($po_vouchers as $vtype) {
                    //         $selected = ($vtype['id'] == $po_process_voucher) ? 'selected' : '';
                    //         echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        
                    // }
                     ?>
                </select>
            </div> -->
            <div class="mb-3 form-group  related-fields 15 29" <?php if (in_array($voucher_guid, [15,29])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label for="po_sugg"><span class="pr-ir-span"><?= ($voucher_guid == 29 ) ? 'IR':'PR'  ?></span> Auto Posting Voucher <br> <i>(<span class="pr-ir-span"><?= ($voucher_guid == 29 ) ? 'IR' : 'PR' ?></span>  to  PO) </i></label>
                <select name="po_sugg" id="po_sugg" class="form-control form-control-sm">
                    <option value="0">Select PO Voucher</option>
                    <?php
                    foreach ($po_vouchers as $vtype) {
                            $selected = ($vtype['id'] == $po_process_voucher) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        
                    } ?>
                </select>
            </div>
            <?php if($guid){ 
                $header  = ($voucher_guid == 2) ? 'Quotation' : (($voucher_guid == 3) ? 'Sales Order' : 'Delivery Note');
                ?>
            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [2])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label for="so_process_voucher2">Auto Select Voucher in Process Form <br> <i>(<?= $header?> - Sales Order) </i></label>
                <select name="so_sugg_vid" id="so_process_voucher2" class="form-control form-control-sm">
                    <option value="0">Select SO Voucher</option>
                    <?php
                    foreach ($all_sales_vouchers as $vtype) {
                        if($vtype['voucher_type'] == 3 ){
                            $selected = ($vtype['id'] == $so_sugg_vid) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [3,2])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label for="so_process_voucher23">Auto Select Voucher in Process Form <br> <i>(<?= $header?> - Delivery Note) </i></label>
                <select name="dn_sugg_vid" id="so_process_voucher23" class="form-control form-control-sm">
                    <option value="0">Select DN Voucher</option>
                    <?php
                    foreach ($all_sales_vouchers as $vtype) {
                        if($vtype['voucher_type'] == 4 ){
                            $selected = ($vtype['id'] == $dn_sugg_vid) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [4,3,2])) echo 'style="display:block"'; else echo 'style="display:none"';  ?>>
                <label for="so_process_voucher24">Auto Select Voucher in Process Form <br> <i>(<?= $header?> - Sales ) </i></label>
                <select name="sales_sugg_vid" id="so_process_voucher24" class="form-control form-control-sm">
                    <option value="0">Select Sales Voucher</option>
                    <?php
                    foreach ($all_sales_vouchers as $vtype) {
                        if($vtype['voucher_type'] == 5 ){
                            $selected = ($vtype['id'] == $sales_sugg_vid) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            
        <?php } ?>
    </div>
    <?php if($guid){ ?>
    
   
    <div class="col-sm-4">
    <h6 class="text-primary" > <i class="fas fa-link" ></i><i> Voucher Linking (Filter)</i></h5>

            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [9, 10,12])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label><i> Purchase Requisition </i></label>
                <select name="purch_filter_vid[pr]"  class="form-control form-control-sm">
                    <option value="0">Select PR Voucher</option>
                    <?php
                    foreach ($pr_and_grn as $vtype) {
                        if ($vtype['type'] == 15) {
                        $selected = ($vtype['id'] == $pfilter_vid['pr']) ? 'selected' : '';
                        echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [ 10,15,12])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i> Purchase Order </i></label>
                <select name="purch_filter_vid[po]"  class="form-control form-control-sm">
                    <option value="0">Select PO Voucher</option>
                    <?php
                    foreach ($po_vouchers as $vtype) {
                        $selected = ($vtype['id'] == $pfilter_vid['po']) ? 'selected' : '';
                        echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                    } ?>
                </select>
            </div>
            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [9,15,12])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label><i> GRN </i></label>
                <select name="purch_filter_vid[grn]" class="form-control form-control-sm">
                    <option value="0">Select GRN Voucher</option>
                    <?php
                    foreach ($pr_and_grn as $vtype) {
                        if ($vtype['type'] == 10) {
                        $selected = ($vtype['id'] == $pfilter_vid['grn']) ? 'selected' : '';
                        echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    } ?>
                </select>
            </div>
            <div  class="mb-3 form-group" <?php if (in_array($voucher_guid, [9, 10,15])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i> Purchase </i></label>
                <select name="purch_filter_vid[pur]" class="form-control form-control-sm">
                    <option value="0">Select Purchase Voucher</option>
                    <?php
                    foreach ($purchase_vouchers as $vtype) {
                        $selected = ($vtype['id'] == $pfilter_vid['pur']) ? 'selected' : '';
                        echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                    } ?>
                </select>
            </div>
        
    </div>
    <?php } ?>
    <div class="col-sm-4">
            <h6 class="text-primary" > <i class="fas fa-link" ></i><i> Other Settings</i></h5>
        <div class="mb-2 mt-1 related-fields 15"  id="showPRApprovalBOX"   <?php if ($voucher_guid == 15) echo 'style="display:flex"'; ?>>
            <div class="mr-4 ml-2">
                <label>Edit Allowed Post Approval </label>
            </div>
            <div class="posCheckboxInner">
                <p style="margin: 0 8px;">No</p>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="aprovd_edit" class="custom-control-input" id="salesSwitches22" <?php echo $aprovd_edit ?>>
                    <label class="custom-control-label" for="salesSwitches22">Yes</label>
                </div>
            </div>
        </div>
        <div  class="mb-3 form-group related-fields 3" <?php if (in_array($voucher_guid, [3])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i> Purchase Req. </i></label>
                <select name="process_pr" class="form-control form-control-sm">
                    <option value="0">Select Purchase Req. Voucher</option>
                    <?php
                      foreach ($pr_and_grn as $vtype) {
                        if ($vtype['type'] == 15) {
                            $selected = ($vtype['id'] == $grn_process_voucher) ? 'selected' : '';
                            echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
                        }
                    }
                    ?>
                </select>
        </div>
            <div  class="mb-3 form-group related-fields 17" <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i> Price Checker </i></label>
                <select name="price_checker" class="form-control form-control-sm">
                    <option value="0">Select Branch to link to Price Checker</option>
                   <option value="10" <?= ($option['data']['price_checker'] == 10) ? 'selected' : '' ?>>Branch -10</option>
                   <option value="20" <?= ($option['data']['price_checker'] == 20) ? 'selected' : '' ?> >Branch - 20</option>
                   <option value="30" <?= ($option['data']['price_checker'] == 30) ? 'selected' : '' ?> >Branch - 30</option>
                </select>
            </div>
            <div  class="mb-3 form-group related-fields 17 18" <?php if (in_array($voucher_guid, [17,18])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i>  Credit Card Ledger  </i></label>
                <!-- <select name="creditc_gl" id="creditc_gl" class="form-control form-control-sm">
							<option value="0">Select Ledger</option>
							<?php
							// foreach ($cardLedgers as $CashGL) {
                            //     if($CashGL['type'] == 1){
							// 	$selected = ($CashGL['ledger_id'] == $data['creditc_gl']) ? 'selected' : '';
							// 	echo "<option value='" . $CashGL['ledger_id'] . "' $selected>" . $CashGL['ledger'] . "</option>";
							// }} 
                            ?>
						</select> -->
                        <?php 
                        $cc_cardArr = explode(',',$data['creditc_gl']); ?>
                        <div class="dropdown cardDropdwon">
						<button class="form-control dropdown-toggle text-left" type="button" data-toggle="dropdown">
							<span class="cdropdown-text text-dark"> <?php if (count($cc_cardArr) > 0) echo count($cc_cardArr) . " Ledger  Selected";
																	else echo "Select "; ?></span>
							<span class="caret"></span></button>
						<ul class="dropdown-menu " style="padding-left:5px;">
                            <li><label>
                                    <input style="zoom:1.5"type="checkbox" class="cselectall" <?php if ($cc_gl_count == count($cc_cardArr)) echo "checked"; ?> />
                                    <span class="cselect-text"> Select</span> All
                                </label>
                            </li>
							<li class="divider"></li>
							<?php

							foreach ($cardLedgers as $ledg) {
                                if($ledg['type'] !=1) continue;
								$checked = "";
								if (in_array($ledg['ledger_id'], $cc_cardArr)) {
									$checked = "checked";
								} ?>
								<li><label  for="creditc_gl<?=$ledg['ledger_id']?>">
                                        <input style="zoom:1.5" name='creditc_gl[]' id="creditc_gl<?=$ledg['ledger_id']?>"  type="checkbox" <?= $checked ?> class="cardOptions justone2 " value="<?= $ledg['ledger_id'] ?>" /> 
                                            <?= $ledg['ledger'] ?>
                                    </label>
                                </li>
							<?php } ?>
						</ul>
					</div>
            </div>
            <div  class="mb-3 form-group related-fields 17 18" <?php if (in_array($voucher_guid, [17,18])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i>  Debit Card Ledger  </i></label>
                <!-- <select name="debitc_gl" id="debitc_gl" class="form-control form-control-sm">
							<option value="0">Select Ledger</option>
							<?php
							// foreach ($cardLedgers as $CashGL) {
                            //     if($CashGL['type'] == 2){
							// 	$selected = ($CashGL['ledger_id'] == $data['debitc_gl']) ? 'selected' : '';
							// 	echo "<option value='" . $CashGL['ledger_id'] . "' $selected>" . $CashGL['ledger'] . "</option>";
							// }} 
                            ?>
						</select> -->
                        <?php 
                        $dc_cardArr = explode(',',$data['debitc_gl']); ?>
                        <div class="dropdown cardDropdwon">
						<button class="form-control dropdown-toggle text-left" type="button" data-toggle="dropdown">
							<span class="ddropdown-text text-dark"> <?php if (count($dc_cardArr) > 0) echo count($dc_cardArr) . " Ledger  Selected";
																	else echo "Select "; ?></span>
							<span class="caret"></span></button>
						<ul class="dropdown-menu " style="padding-left:5px;">
                            <li><label>
                                    <input style="zoom:1.5"type="checkbox" class="dselectall" <?php if ($dc_gl_count == count($dc_cardArr)) echo "checked"; ?> />
                                    <span class="dselect-text"> Select</span> All
                                </label>
                            </li>
							<li class="divider"></li>
							<?php

							foreach ($cardLedgers as $ledg) {
                                if($ledg['type'] !=2) continue;
								$checked = "";
								if (in_array($ledg['ledger_id'], $dc_cardArr)) {
									$checked = "checked";
								} ?>
								<li><label  for="debitc_gl<?=$ledg['ledger_id']?>">
                                        <input style="zoom:1.5" name='debitc_gl[]' id="debitc_gl<?=$ledg['ledger_id']?>"  type="checkbox" <?= $checked ?> class="dcardOptions justone3 " value="<?= $ledg['ledger_id'] ?>" /> 
                                            <?= $ledg['ledger'] ?>
                                    </label>
                                </li>
							<?php } ?>
						</ul>
					</div>
            </div>
            <div  class="mb-3 form-group related-fields 17 18" <?php if (in_array($voucher_guid, [17,18])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i> Wallet Ledger  </i></label>
                        <?php 
                        $wc_cardArr = explode(',',$data['wallet_gl']); ?>
                        <div class="dropdown cardDropdwon">
						<button class="form-control dropdown-toggle text-left" type="button" data-toggle="dropdown">
							<span class="wdropdown-text text-dark"> <?php if (count($wc_cardArr) > 0) echo count($wc_cardArr) . " Ledger  Selected";
																	else echo "Select "; ?></span>
							<span class="caret"></span></button>
						<ul class="dropdown-menu " style="padding-left:5px;">
                            <li><label>
                                    <input style="zoom:1.5"type="checkbox" class="wselectall" <?php if ($wallet_gl_count == count($wc_cardArr)) echo "checked"; ?> />
                                    <span class="wselect-text"> Select</span> All
                                </label>
                            </li>
							<li class="divider"></li>
							<?php

							foreach ($cardLedgers as $ledg) {
                                if($ledg['type'] !=3) continue;
								$checked = "";
								if (in_array($ledg['ledger_id'], $wc_cardArr)) {
									$checked = "checked";
								} ?>
								<li><label  for="wallet_gl<?=$ledg['ledger_id']?>">
                                        <input style="zoom:1.5" name='wallet_gl[]' id="wallet_gl<?=$ledg['ledger_id']?>"  type="checkbox" <?= $checked ?> class="wcardOptions justone4 " value="<?= $ledg['ledger_id'] ?>" /> 
                                            <?= $ledg['ledger'] ?>
                                    </label>
                                </li>
							<?php } ?>
						</ul>
					</div>
            </div>
             <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="sur_b2b_led">Surcharge B2B  Ledger</label>
                    <select name="sur_b2b_led[]" data-selected="<?= $data['sur_b2b_led'] ?>" id="sur_b2b_led" multiple="multiple" class="form-control form-control-sm   compliment-9gl compliment-gl-2">
                    </select>
                     <div class="text-warning">
                        <?php if($data['sur_b2b_led']){
                            // echo "SELECT  id,name from erp_ledgers where id IN ({$data['sur_b2c_led']})  ";
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['sur_b2b_led']})  ");
                            // print_r($selectedLedger);
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="sur_b2c_led">Surcharge B2C  Ledger</label>
                    <select name="sur_b2c_led[]" data-selected="<?= $data['sur_b2c_led'] ?>" id="sur_b2c_led" multiple="multiple" data-idattr="sur_b2c_led_hidden" class="form-control form-control-sm    compliment-9gl compliment-gl-2">
                        
                    </select>
                    <div class="text-warning">
                        <?php if($data['sur_b2c_led']){
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['sur_b2c_led']})  ");
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                           
                        }
                         echo '<input id="sur_b2c_led_hidden" type="hidden" value="'.$data['sur_b2c_led'].'" name="sur_b2c_led_hidden"/>';
                        ?>
                    </div>
                </div>
                <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="sur_exe_led">Surcharge Executive Ledger</label>
                    <select name="sur_exe_led[]" data-selected="<?= $data['sur_exe_led'] ?>" id="sur_exe_led" multiple="multiple" data-idattr="sur_exe_led_hidden" class="form-control form-control-sm   compliment-9gl compliment-gl-2">
                    </select>
                     <div class="text-warning">
                        <?php if($data['sur_exe_led']){
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['sur_exe_led']})  ");
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                                
                            }
                            
                        }
                        echo '<input type="hidden" id="sur_exe_led_hidden"  value="'.$data['sur_exe_led'].'" name="sur_exe_led_hidden"/>';
                        ?>
                    </div>
                </div>
                  <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="disc_b2b_led">Discount  B2B  Ledger</label>
                    <select name="disc_b2b_led[]" data-selected="<?= $data['disc_b2b_led'] ?>" id="disc_b2b_led" multiple="multiple" data-idattr="disc_b2b_led_hidden" class="form-control form-control-sm   compliment-9gl compliment-gl-2">
                    </select>
                     <div class="text-warning">
                        <?php if($data['disc_b2b_led']){
                            // echo "SELECT  id,name from erp_ledgers where id IN ({$data['sur_b2c_led']})  ";
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['disc_b2b_led']})  ");
                            // print_r($selectedLedger);
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                        }
                                                    echo '<input type="hidden" id="disc_b2b_led_hidden" value="'.$data['disc_b2b_led'].'" name="disc_b2b_led_hidden"/>';

                        ?>
                    </div>
                </div>
                <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="disc_b2c_led">Discount B2C  Ledger</label>
                    <select name="disc_b2c_led[]" data-selected="<?= $data['disc_b2c_led'] ?>" id="disc_b2c_led" multiple="multiple" class="form-control form-control-sm   compliment-9gl compliment-gl-2">
                    </select>
                     <div class="text-warning">
                        <?php if($data['disc_b2c_led']){
                            // echo "SELECT  id,name from erp_ledgers where id IN ({$data['sur_b2c_led']})  ";
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['disc_b2c_led']})  ");
                            // print_r($selectedLedger);
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="disc_exe_led">Discount Executive Ledger</label>
                    <select name="disc_exe_led[]" data-selected="<?= $data['disc_exe_led'] ?>" id="disc_exe_led" multiple="multiple" class="form-control form-control-sm   compliment-9gl compliment-gl-2">
                    </select>
                     <div class="text-warning">
                        <?php if($data['disc_exe_led']){
                            // echo "SELECT  id,name from erp_ledgers where id IN ({$data['sur_b2c_led']})  ";
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['disc_exe_led']})  ");
                            // print_r($selectedLedger);
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                        }
                        ?>
                    </div>
                </div>

                  <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="sur_inc_dip">Surcharge Income  B2C (D)  Ledger</label>
                    <select name="sur_inc_dip[]" data-selected="<?= $data['sur_inc_dip'] ?>" id="sur_inc_dip" multiple="multiple" data-idattr="sur_inc_dip_hidden" class="form-control form-control-sm    compliment-9gl compliment-gl-2">
                        
                    </select>
                    <div class="text-warning">
                        <?php if($data['sur_inc_dip']){
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['sur_inc_dip']})  ");
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                           
                        }
                         echo '<input id="sur_inc_dip_hidden" type="hidden" value="'.$data['sur_inc_dip'].'" name="sur_inc_dip_hidden"/>';
                        ?>
                    </div>
                </div>

                   <div class="mb-3 form-group related-fields 17 " <?php if (in_array($voucher_guid, [17])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                    <label for="sur_inc_exe">Surcharge Income  B2C (E)  Ledger</label>
                    <select name="sur_inc_exe[]" data-selected="<?= $data['sur_inc_exe'] ?>" id="sur_inc_exe" multiple="multiple" data-idattr="sur_inc_exe_hidden" class="form-control form-control-sm    compliment-9gl compliment-gl-2">
                        
                    </select>
                    <div class="text-warning">
                        <?php if($data['sur_inc_exe']){
                            $selectedLedger = findQuery("SELECT  id,name from erp_ledgers where id IN ({$data['sur_inc_exe']})  ");
                            foreach($selectedLedger as $sll){
                                echo '<p class="m-0" value="'.$sll['id'].'">'.$sll['name'].'</p>';
                            }
                           
                        }
                         echo '<input id="sur_inc_exe_hidden" type="hidden" value="'.$data['sur_inc_exe'].'" name="sur_inc_exe_hidden"/>';
                        ?>
                    </div>
                </div>
                

            <div  class="mb-3 form-group related-fields 22 3 9 11 5" <?php if (in_array($voucher_guid, [22,3,9,11,5])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i> Branch (Outlet) </i></label>
                     <select name="outlet_id" class="form-control form-control-sm">
                            <option value="0">Select Outlet</option>
                            <?php foreach($branches as $br){ ?>
                                <option value="<?=$br['id']?>" <?= ($option['data']['outlet_guid'] == $br['id']) ? 'selected' : '' ?>><?= $br['name']?></option>
                                <?php } ?>
                     </select>
			</div>
            <div  class="mb-3 form-group related-fields 18" <?php if (in_array($voucher_guid, [18])) echo 'style="display:block"';else echo 'style="display:none"';  ?>>
                <label ><i>Table Reservation Item</i> </label>
                <label class="ml-3 mr-2"><input type="radio" name="rsrv_item_type" value="0" <?= ($option['data']['rsrv_item_type'] ==0 ) ? 'checked' : '' ?>/> Service </label>
                <label class="ml-3 mr-2"><input type="radio" name="rsrv_item_type" value="1"  <?= ($option['data']['rsrv_item_type'] ==1 ) ? 'checked' : '' ?>/>Advance</label>
                     <select name="tb_rsrv_item" class="form-control form-control-sm">
                            <option value="0">Select Item</option>
                            <?php 
                            $products = findQuery("SELECT id,name from erp_products where non_inventory = 1");
                            foreach($products as $pr){ ?>
                                <option value="<?=$pr['id']?>" <?= ($option['data']['non_inv_item'] == $pr['id']) ? 'selected' : '' ?>><?= $pr['name']?></option>
                                <?php } ?>
                     </select>
			</div>
            </div>
    </div>

<script>
    $(document).on('click', '.cardDropdwon .dropdown-menu label', function (e) {
    e.stopPropagation();
});
</script>