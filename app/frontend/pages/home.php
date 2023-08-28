<div class="container mt-5">
  
  <form id="submit-invoice" method="post">

    <div class="section">

      <?php include FRONTEND_BASE . 'includes/ticket-parts/project-info.php'; ?>

    </div>

    <div class="section mt-5">

      <?php include FRONTEND_BASE . 'includes/ticket-parts/description.php'; ?>

    </div>
    <div id="labour-section" class="section mt-5">

      <?php include FRONTEND_BASE . 'includes/ticket-parts/labour-info.php'; ?>

    </div>

    <div id="truck-section" class="section mt-5">

      <?php include FRONTEND_BASE . 'includes/ticket-parts/truck-info.php'; ?>

    </div>
    <div id="misc-section" class="mt-5 mb-5">

      <?php include FRONTEND_BASE . 'includes/ticket-parts/miscellaneous-info.php'; ?>

    </div>
    <div id="submit-section" class="text-end pb-5">
      <button id="submitBtn" type="submit" class="btn btn-secondary">FINISH</button>
    </div>

  </form>
</div>

