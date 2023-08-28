<h3>Truck</h3>

<div class="row d-flex gap-0 truckRow dynamic-list pb-2">
    <div class="col-xs-6 col-lg-3">
        <label class="w-100">Label
            <select name="truck-label" class="truckLabel form-control">
                <option value="" disabled selected hidden></option>
                <?php
                foreach ($trucks as $truck) {
                    echo "<option value=" . $truck['id'] . ">". $truck['name'] . "</option>";
                }
                ?>
            </select>
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Qty
            <input name="truck-quantity" type="number" class="truckQuantity form-control" min=0 value="0">
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">UOM
            <select name="truck-units" class="truckUnitsMeasure form-control">
                <option value="" disabled selected hidden></option>
            </select>
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="truckRate-wrapper w-100">Rate($)
            <input name="truck-rate" type="text" class="truckRate form-control" value="0" disabled>
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Total
            <input name="truck-total" type="text" class="truckTotal form-control" value="0" disabled>
        </label>
    </div>
    <div class="col-xs-6 col-lg-1 btn-group d-flex m-auto">
        <button class="row-button add-group btn-round btn-round--blue">+</button>
        <button class="row-button remove-group btn-round btn-round--red">x</button>
    </div>
</div>

<div class="row">
    <div class="col-7">Sub-Total</div>
    <div class="col-5"><input name="truck-subtotal" type="text" id="truckSubtotal" class="form-control" value="0" disabled></div>
</div>