<div class="row">
    <div class="col-lg-3">

        <div class="mb-1">
            <label>Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" required>
        </div>

        <div class="mb-1">
            <label>Code</label>
            <input type="text" name="code" id="code" class="form-control form-control-sm" required>
        </div>

        <div class="mb-1">
            <label>CR No.</label>
            <input type="text" name="cr_no" id="cr-number" class="form-control form-control-sm" required>
        </div>

        <div class="mb-1">
            <label>Address 1</label>
            <textarea name="address" id="address" class="form-control form-control-sm" required></textarea>
        </div>

        <div class="mb-1">
            <label>Address 2</label>
            <textarea name="address2" id="address2" class="form-control form-control-sm" required></textarea>
        </div>
        <div class="mb-1">
            <label>Address 3</label>
            <textarea name="address3" id="address3" class="form-control form-control-sm" required></textarea>
        </div>

        <div class="mb-1">
            <label>Email</label>
            <input type="text" name="email" id="email" class="form-control form-control-sm" required>
        </div>

        <div class="mb-1">
            <label>Website</label>
            <input type="text" name="website" class="form-control form-control-sm">
        </div>

        <div class="mb-1">
            <label>Whatsapp No.</label>
            <input type="text" name="whatsapp" class="form-control form-control-sm">
        </div>

    </div>

    <div class="col-lg-3">

        <div class="mb-3">
            <label>Company</label>
            <select name="company_guid" id="company" class="form-control form-control-sm">
                <option value="">Select</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Print Name</label>
            <input type="text" name="print_name" id="comp_print_name" class="form-control form-control-sm" required>
        </div>

        <div class="mb-3">
            <label>Country</label>
            <select name="countryName" id="country" class="form-control form-control-sm" required>
                <option value="">Select</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Country Code</label>
            <input type="text" name="countryCode" id="countrycode" class="form-control form-control-sm" readonly>
        </div>

        <div class="row formrow" style="padding-top:0px">
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Country Code</label>
                <input type="text" name="countryCode" id="countrycode" class="form-control form-control-sm" readonly>
            </div>
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Region</label>
                <input type="text" name="region" id="region" class="form-control form-control-sm" readonly>
            </div>
        </div>
        <div class="row formrow" style="padding-top:0px">
            <div class=" mb-3 col col-sm-6">
                <label for="validationCustom01">Currency Name</label>
                <input type="text" name="currency" id="currency" class="form-control form-control-sm" readonly>
            </div>
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Symbol</label>
                <input type="text" name="symbol" id="symbol" class="form-control form-control-sm" readonly>
            </div>
        </div>




        <div class=" mb-3">
            <label for="validationCustom01">International Currency Code</label>
            <input type="text" name="currency_code" id="currencyCode" class="form-control form-control-sm" readonly>
        </div>
        <div class="row formrow" style="padding-top:0px">
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Denomination</label>
                <input type="text" name="denomination" id="denomination" class="form-control form-control-sm"
                    readonly>
            </div>

            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">No. Of Decimals</label>
                <input type="text" name="decimals" id="decimals" class="form-control form-control-sm" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label>API Store ID (Zetca)</label>
            <input type="text" name="api_store" id="api_store" class="form-control form-control-sm">
        </div>

    </div>

    <div class="col-lg-3">

        <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" id="state" class="form-control form-control-sm" required>
        </div>

        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" id="city" class="form-control form-control-sm" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" id="location" class="form-control form-control-sm" required>
        </div>

        <div class="row formrow">
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Pin</label>
                <input type="text" name="pin" id="pin" class="form-control form-control-sm" required>
            </div>
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Mobile</label>
                <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" required>
            </div>
        </div>

        <div class=" mb-3">
            <label for="validationCustom01">Tax Registration Status</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input foc" type="radio" name="reg_tax_status" id="reg_tax_status"
                    value="1">
                <label class="form-check-label" for="inlineCheckbox2">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input foc" type="radio" name="reg_tax_status" id="reg_tax_status"
                    value="0">
                <label class="form-check-label" for="inlineCheckbox3">No</label>
            </div>
        </div>

        <div class=" mb-3">
            <label for="validationCustom01">Group VAT No.</label>
            <input type="text" name="group_vat_no" id="group_vat_no" class="form-control form-control-sm"
                required>
        </div>
        <div class=" mb-3">
            <label for="validationCustom01">Branch VAT No.</label>
            <input type="text" name="vat_tin_no" id="vat_tin_no" class="form-control form-control-sm" required>
        </div>


    </div>

    <div class="col-lg-3">

        <div class="mb-3">
            <label>Tax Registration Date</label>
            <input type="text" name="tax_reg_date" id="tax_reg_date"
                class="form-control form-control-sm datepicker" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" id="phone" class="form-control form-control-sm" required>
        </div>

        <div class="row formrow" style="padding-top:0px">
            <div class="mb-3 col-sm-6">
                <label for="validationCustom01"> Phone</label>
                <input type="text" name="phone" id="phone" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="validationCustom01">Fax</label>
                <input type="text" name="fax" id="fax" class="form-control form-control-sm" required>
            </div>
        </div>


        <div class="mb-3">
            <label>Book Beginning With</label>
            <input type="text" name="book_begining" id="book_begining"
                class="form-control form-control-sm datepicker" required>
        </div>

        <div class="row ">
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Opening Time</label>
                <input type="time" name="opening_time" id="opening_time" class="form-control form-control-sm"
                    required>
            </div>
            <div class=" mb-3 col-sm-6">
                <label for="validationCustom01">Closing Time</label>
                <input type="time" name="closing_time" id="closing_time" class="form-control form-control-sm"
                    required>
            </div>
        </div>
        <div class="mb-3">
            <label>Reservation Interval (Mins)</label>
            <input type="number" name="reservation_interval" id="reservation_interval"
                class="form-control form-control-sm" required>
        </div>

        <div class="mb-3">
            <label>Price List</label>
            <select class="form-control form-control-sm" name="pricelist_guid" id="pricelist_guid">
                <option value="">Select</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Promotion</label>
            <select class="form-control form-control-sm" name="promotion_guid" id="promotion_guid">
                <option value="">Select</option>
            </select>
        </div>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active">
            <label class="form-check-label">Is Active</label>
        </div>

    </div>
</div>
