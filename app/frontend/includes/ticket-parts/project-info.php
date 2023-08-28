<h3>Project</h3>
<div class="row">
    <div class="col-xs-12 col-md-6 col-lg-5">
        <p class="d-flex justify-content-between gap-3">
            <label for="customerName">Customer name:</label>
            <select name="customer" id="customerName" class="form-control w-xs-100 w-md-60">
                <option value="" disabled selected hidden></option>
                <?php
                foreach ($customerNames as $customerName) {
                    echo "<option value=" . $customerName['id'] . ">". $customerName['name'] . "</option>";
                }
                ?>
            </select>
        </p>
        <p class="d-flex justify-content-between gap-3">
            <label for="jobName">Job name:</label>
            <select name="job" id="jobName" class="form-control w-xs-100 w-md-60">
                <option value="" disabled selected hidden></option>
                <?php
                foreach ($jobNames as $jobName) {
                    echo "<option value=" . $jobName['id'] . ">". $jobName['name'] . "</option>";
                }
                ?>
            </select>
        </p>
        <p class="d-flex justify-content-between gap-3">
            <label for="statusName">Status:</label>
            <select name="status" id="statusName" class="form-control w-xs-100 w-md-60">
                <?php
                foreach ($statusNames as $status) {
                    echo "<option value=" . $status['id'] . ">". $status['status'] . "</option>";
                }
                ?>
            </select>
        </p>
        <p class="d-flex justify-content-between gap-3">
            <label for="locationName">Location/LSD:</label>
            <select name="location" id="locationName" class="form-control w-xs-100 w-md-60">
                <option value="" disabled selected hidden></option>
                <?php
                foreach ($locationsNames as $locationsName) {
                    echo "<option value=" . $locationsName['id'] . ">". $locationsName['name'] . "</option>";
                }
                ?>
            </select>
        </p>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-5 offset-lg-2">
        <p class="d-flex justify-content-between gap-3">
            <label for="orderedBy">Ordered By:</label>
            <input name="orderedBy" type="text" id="orderedBy" class="form-control w-xs-100 w-md-60">
        </p>
        <p class="d-flex justify-content-between gap-3">
            <label for="date">Date:</label>
            <input name="date" type="date" id="date" class="form-control w-xs-100 w-md-60" value="<?php echo date("Y-m-d"); ?>">
        </p>
        <p class="d-flex justify-content-between gap-3">
            <label for="area">Area/Field:</label>
            <input  name="area" type="text" id="area" class="form-control w-xs-100 w-md-60">
        </p>
    </div>
</div>