      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered"><?php echo $this->session->userdata('nombre'); ?></h5>
                    
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Producto</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Agregar</a></li>
                          <li><a  href="ventas/listar">Ver</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Material</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Agregar</a></li>
                          <li><a  href="#">Ver</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Usuario</span>
                      </a>
                      <ul class="sub">
                          <li><a  href=<?php echo '"' . site_url("/usuarios/agregar") . '"' ?>>Agregar</a></li>
                          <li><a  href=<?php echo '"' . site_url("/usuarios") . '"' ?>>Ver</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Ventas</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Agregar</a></li>
                          <li><a  href="ventas/listar">Ver</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Compras</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Agregar</a></li>
                          <li><a  href="#">Ver</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Lugar</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Agregar</a></li>
                          <li><a  href="#">Ver</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Gastos</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#">Agregar</a></li>
                          <li><a  href="#">Ver</a></li>
                      </ul>
                  </li>
                  <li class="mt">
                      <a href="#">
                          <span>Asignar Producto</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>