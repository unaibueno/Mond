<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>


<section style="padding:20px;">
  <div class="row">
    <div class="col-8" style="height:90vh; border-radius:15px; ">
      <div class="row justify-content-left" style="height:90vh;">
        <div class="col-12">
          <div class=" pl-1">
            <h2 class="welcome-title pt-3 ">ALOHA, UNAI!</h2>
            <p>¿Preparado para una sesión de organización?</p>
            <?php echo session()->get('username'); ?>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>



<?= $this->endSection() ?>