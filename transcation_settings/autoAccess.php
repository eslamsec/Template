<?php
function updateRolesWithNewPermission($setting_guid) {
    $rolesList = findQuery("SELECT r.id, r.roles FROM erp_roles r JOIN erp_user u ON r.id= u.roles_guid WHERE  u.user_type = 3");
    $newPermissionKey = "transaction_$setting_guid";
    $newPermissionData = [
        "privilage" => "5",
    ];

    foreach ($rolesList as $role) {
        $id = $role['id'];
        $currentRolesSerialized = $role['roles'];
        
        $currentRoles = @unserialize($currentRolesSerialized);
        if (!is_array($currentRoles)) {
            continue;
        }
        $currentRoles[$newPermissionKey] = $newPermissionData;
        $updatedRolesSerialized = serialize($currentRoles);
        $escaped = addslashes($updatedRolesSerialized);
        $update = updateQuery("UPDATE erp_roles SET roles = '$escaped' WHERE id = '$id'");
    }
}
function updateOutletAccess($outlet_id) {
    $transactions = findQuery("SELECT id, counter_outlet_access FROM erp_user WHERE user_type = 3");
    $newOutletKey = "outlet_$outlet_id";
    $newOutletAccess = [
        "pos" => ["access" => 1],
        "fb" => ["access" => 1],
        "open" => ["access" => 1],
        "close" => ["access" => 1],
    ];

    foreach ($transactions as $row) {
        $id = $row['id'];
        $currentAccessSerialized = $row['counter_outlet_access'];
        $currentAccess = @unserialize($currentAccessSerialized);
        if (!is_array($currentAccess)) {
            $currentAccess = [];
        }
        $currentAccess[$newOutletKey] = $newOutletAccess;
        $updatedAccessSerialized = serialize($currentAccess);
        $escaped = addslashes($updatedAccessSerialized);

        $update = updateQuery("UPDATE erp_user  SET counter_outlet_access = '$escaped' WHERE id = '$id'");
    }
}
function updateCounterAccess($outlet_id) {
    $transactions = findQuery("SELECT id, counter_outlet_access FROM erp_user WHERE user_type = 3");
    $newOutletKey = "counter_$outlet_id";
    $newOutletAccess = [
        "pos" => ["access" => 1],
        "fb" => ["access" => 1]
    ];

    foreach ($transactions as $row) {
        $id = $row['id'];
        $currentAccessSerialized = $row['counter_outlet_access'];
        $currentAccess = @unserialize($currentAccessSerialized);
        if (!is_array($currentAccess)) {
            $currentAccess = [];
        }
        $currentAccess[$newOutletKey] = $newOutletAccess;
        $updatedAccessSerialized = serialize($currentAccess);
        $escaped = addslashes($updatedAccessSerialized);

        $update = updateQuery("UPDATE erp_user  SET counter_outlet_access = '$escaped' WHERE id = '$id'");
    }
}

function saveJournals($data,$settingID, $tallyid=0){
    $sv['jv0'] = $data['jv0'];
    $sv['jv1'] = $data['jv1'];
    $sv['cr_ledger00s'] = $data['cr_ledger00'];
    $sv['cr_ledger01w'] = $data['cr_ledger01'];
    $sv['cr_ledger02b'] = $data['cr_ledger02'];

    $sv['dr_ledger00hf100'] = $data['dr_ledger00'];
    $sv['dr_ledger01hf150'] = $data['dr_ledger01'];
    // $sv['dr_ledger02'] = $data['dr_ledger02'];

    
    $sv['cr_ledger11s'] = $data['cr_ledger11'];
    $sv['cr_ledger12w'] = $data['cr_ledger12'];
    $sv['cr_ledger13b'] = $data['cr_ledger13'];

    $sv['dr_ledger11b2cd'] = $data['dr_ledger11'];
    $sv['dr_ledger12b2ce0'] = $data['dr_ledger12'];
    $sv['dr_ledger13b2ce1'] = $data['dr_ledger13'];

    $sv['jv2'] = $data['jv2'];

    $sv['cr_ledger21s'] = $data['cr_ledger21'];
    $sv['cr_ledger22w'] = $data['cr_ledger22'];
    $sv['cr_ledger23b'] = $data['cr_ledger23'];

     $sv['dr_ledger21b2cd'] = $data['dr_ledger21'];
    $sv['dr_ledger22b2ce0'] = $data['dr_ledger22'];
    $sv['dr_ledger23b2ce1'] = $data['dr_ledger23'];


    $sv['setting_id'] = $settingID;
    $sv['add_date'] = date('Y-m-d');
    $id = saveArray("journal_settings",$sv, $tallyid);
    updateQuery("UPDATE erp_transaction_settings  set tallyid = $id where id = $settingID ");
}