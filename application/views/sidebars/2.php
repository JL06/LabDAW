      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                <div class="centered"><span class="glyphicon glyphicon-user"></span></div>
                <h5 class="centered"><?php echo $this->session->userdata('nombre'); ?></h5> 

                <li class="sub-menu">
                  <a href="<?php echo base_url('ventas/listar')?>" >
                    <span>Ventas</span>
                  </a>
                </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>