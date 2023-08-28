<h3>Labour</h3>

<div class="row d-flex gap-0 labourRow dynamic-list pb-2">
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Staff
            <select name="staff" class="staffName form-control">
                <option value="" disabled selected hidden></option>
                <?php
                foreach ($staffNames as $staff) {
                    echo "<option value=" . $staff['id'] . ">". $staff['name'] . "</option>";
                }
                ?>
            </select>
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Position
            <select name="position" class="positionName form-control">
                <option value="" disabled selected hidden></option>
            </select>
        </label>
    </div>
    <div class="col-xs-6 col-lg-1">
        <label class="w-100">UOM
            <select name="labour-units" class="labourUnitsMeasure form-control">
                <option value="" disabled selected hidden></option>
            </select>
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="regularRate-wrapper w-100">Regular rate
            <input name="reg-rate" type="text" class="regularRate form-control" value="0" disabled>
        </label>
    </div>
    <div class="col-xs-6 col-lg-1">
        <label class="w-100">Reg Hours
            <input name="reg-hours" type="number" class="regHours form-control" min="0" value="0">
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="overtimeRate-wrapper w-100">Overtime rate
            <input name="overtime-rate" type="text" class="overtimeRate form-control" value="0" disabled>
        </label>
    </div>
    <div class="col-xs-3 col-lg-1">
        <label class="w-100">Overtime
            <input name="overtime-hours" type="number" class="overtimeHours form-control" min="0"  value="0">
        </label>
    </div>
    <div class="col-xs-3 col-lg-1 btn-group d-flex m-auto">
        <button class="row-button add-group btn-round btn-round--blue">+</button>
        <button class="row-button remove-group btn-round btn-round--red">x</button>
    </div>
</div>

<div class="row">
    <div class="col-7">Sub-Total</div>
    <div class="col-5"><input name="labour-total" type="text" id="labourSubtotal" class="form-control" value="0" disabled></div>
</div>