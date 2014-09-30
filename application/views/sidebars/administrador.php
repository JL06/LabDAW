      <!--sidebar start-->
      <aside>
        <div id="sidebar"  class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">
            
            <div class="centered"><span class="glyphicon glyphicon-user"></span></div>
            <h5 class="centered"><?php echo $this->session->userdata('nombre'); ?></h5>
            
            <li class="sub-menu">
              <a href="javascript:;" >
                <span>Producto</span>
              </a>
              <ul class="sub">
                <li><a  href="<?php echo base_url('productos/register_form')?>">Agregar</a></li>
                <li><a  href="<?php echo base_url('productos/listar')?>">Ver</a></li>
                <li><a  href="#">Agendar</a></li>
              </ul>
            </li>
            <li class="sub-menu">
              <a href="javascript:;" >
                <span>Material</span>
              </a>
              <ul class="sub">
                <li><a  href="#">Agregar</a></li>
                <li><a  href="<?php echo base_url('materiales/listar')?>">Ver</a></li>
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
                <li><a  href="<?php echo base_url('ventas/register_form')?>">Agregar</a></li>
                <li><a  href="<?php echo base_url('ventas/listar')?>">Ver</a></li>
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
            <li class="sub-menu">
              <a href="javascript:;" >
                <span>Reportes</span>
              </a>
              <ul class="sub">
                <li><a  href=<?php echo '"' . site_url("/reportes/balance") . '"' ?>>Balance</a></li>
                <li><a  href="#">Otro</a></li>
              </ul>
            </li>
          </ul>
          <!-- sidebar menu end-->
        </div>
      </aside>