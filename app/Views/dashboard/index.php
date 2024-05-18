<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

<!-- 
<section id="dashboard">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-8">
        <div class="card">
          <h2 class="welcome-title pt-3">ALOHA, UNAI!</h2>
          <p>¿Preparado para una sesión de organización?</p>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- 
<section id="dashboard">
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-8 p-3" style="background: #f6f6f8;border-radius:20px; height:100px;">timers</div>
      <div class="col-md-4">
        <div class="col-md-12" style="border-radius:20px; height:100px;">
          <div class="row justify-content-left" style="background:#f6f6f8;border-radius:20px; height:100px; ">
            <div class="col-md-8 p-2" style="border-radius:20px; height:100px; padding-top:20px;">
              <p>Contador del tiempo</p>
              <p style="margin-top: -10px;">Pulsa para iniciar el contador</p>
            </div>
            <div class="col-md-4" style="border-radius:20px; height:70px; padding-top:20px;">
              <div style="background:#222222; height:50px; border-radius:14px; width:50px;">
                <i class="fa-solid fa-play p-4"
                  style="color:white; font-size: 25px; margin-top:-10px; margin-left: -6px;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section> -->

<section>
  <div class="row">
    <div class="col-8" style="height:85vh; border-radius:15px; ">
      <div class="row justify-content-left">
        <div class="col-12">
          <div class=" pl-1">
            <h2 class="welcome-title pt-3 ">ALOHA, UNAI!</h2>
            <p>¿Preparado para una sesión de organización?</p>
          </div>
        </div>
        <div class="col-12 tareas-dashboard" style=" height:70vh;">
          <div class="col-12 tarea-dashboard">
            <div class="tarea">
              <div class="tarea-icon">
              </div>
              <div class="tarea-content">
              </div>
              <div class="tarea-timer">
                <button id="startButton" onclick="toggleContador()">
                  <div class="sign">
                    <i class="sing-icon fa-solid fa-play"></i>
                  </div>
                  <div class="text" id="contador">00:00:01</div>
                </button>
                <div id="count_click"></div>
                <button name="count_click">AÑADIR CLICK</button>
              </div>
            </div>
          </div>
          <div class="col-12 tarea-dashboard">
            <div class="tarea">
              <div class="tarea-icon">
              </div>
              <div class="tarea-content">

              </div>
              <div class="tarea-timer">
                <button id="btn-tareas" class="time-btn">
                  <div class="sign">
                    <i class="sing-icon fa-solid fa-play"></i>
                  </div>
                  <div class="text">00:00:01</div>
                </button>
              </div>
            </div>
          </div>
          <div class="col-12 tarea-dashboard">
            <div class="tarea">
              <div class="tarea-icon">
              </div>
              <div class="tarea-content">

              </div>
              <div class="tarea-timer">
                <button class="time-btn">
                  <div class="sign">
                    <i class="sing-icon fa-solid fa-play"></i>
                  </div>

                  <div class="text">00:00:01</div>
                </button>

              </div>
            </div>
          </div>
          <div class="col-12 tarea-dashboard">
            <div class="tarea">
              <div class="tarea-icon">
              </div>
              <div class="tarea-content">

              </div>
              <div class="tarea-timer">
                <button class="time-btn">
                  <div class="sign">
                    <i class="sing-icon fa-solid fa-play"></i>
                  </div>

                  <div class="text">00:00:01</div>
                </button>

              </div>
            </div>
          </div>
          <div class="col-12 tarea-dashboard">
            <div class="tarea">
              <div class="tarea-icon">
              </div>
              <div class="tarea-content">

              </div>
              <div class="tarea-timer">
                <button class="time-btn">
                  <div class="sign">
                    <i class="sing-icon fa-solid fa-play"></i>
                  </div>

                  <div class="text">00:00:01</div>
                </button>

              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="col-md-4 " style="height:85vh; border-radius:15px; ">
      <div class="col-12 vistazo-general">

      </div>
    </div>
  </div>
</section>



<?= $this->endSection() ?>