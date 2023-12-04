<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
    <?php if (session('cod')==1) : ?>
      <?php if (session('msg')) : ?>
          <div class="alert alert-success mt-3"><?= session('msg') ?></div>
        <?php endif ?>
    <?php else: ?>
      <?php if (session('msg')) : ?>
          <div class="alert alert-danger mt-3"><?= session('msg') ?></div>
        <?php endif ?>
    <?php endif ?>
  <div class="col-3"></div>
  </div>
</div>
