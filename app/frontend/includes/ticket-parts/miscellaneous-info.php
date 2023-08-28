<h3>Miscellaneous</h3>

<div class="row d-flex gap-0 miscRow dynamic-list pb-2">
    <div class="col-xs-6 col-lg-3">
        <label class="w-100">Description
            <input name="misc-descr" type="text" class="miscDescr form-control">
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Cost
            <input name="misc-cost" type="number" class="miscCost form-control" value="0" min="0">
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Price
            <input name="misc-price" type="number" class="miscPrice form-control" value="0" min="0">
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Quantity
            <input name="misc-quantity" type="number" class="miscQuantity form-control" value="0" min="0">
        </label>
    </div>
    <div class="col-xs-6 col-lg-2">
        <label class="w-100">Total
            <input name="misc-total" type="text" class="miscTotal form-control" step="any" value="0" disabled  min="0">
        </label>
    </div>
    <div class="col-xs-3 col-lg-1 btn-group d-flex m-auto">
        <button class="row-button add-group btn-round btn-round--blue">+</button>
        <button class="row-button remove-group btn-round btn-round--red">x</button>
    </div>
</div>

<div class="row">
    <div class="col-7">Sub-Total</div>
    <div class="col-5"><input name="misc-subtotal" type="text" id="miscSubtotal" class="form-control" value="80" disabled></div>
</div>