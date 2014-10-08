      <!--sidebar start-->
      <aside>
        <div id="sidebar"  class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">

            <div class="centered"><span class="glyphicon glyphicon-user"></span></div>
            <h5 class="centered"><?php echo $this->session->userdata('nombre'); ?></h5>
<<<<<<< HEAD
=======
            
            <li class="sub-menu">
              <a href="javascript:;" >
                <span>Producto</span>
              </a>
              <ul class="sub">
                <li><a  href="<?php echo base_url('productos/registrar')?>">Agregar</a></li>
                <li><a  href="<?php echo base_url('productos/listar')?>">Ver</a></li>
                <li><a  href="#">Agendar</a></li>
              </ul>
            </li>
            <li class="sub-menu">
              <a href="javascript:;" >
                <span>Material</span>
              </a>
              <ul class="sub">
                <li><a  href="<?php echo base_url('materiales/agregar')?>">Agregar</a></li>
                <li><a  href="<?php echo base_url('materiales')?>">Ver</a></li>
              </ul>
            </li>
>>>>>>> UD-Usuario-Material
            <li class="sub-menu">
              <a href="<?php echo base_url('ventas/listar')?>" >
                <span>Ventas</span>
              </a>
            </li>
            <li class="sub-menu">
             <a  href="<?php echo base_url('productos/listar')?>">
               <span>Productos</span>
             </a>
             
           </li>
           <li class="sub-menu">
            <a href="<?php echo base_url('materiales/listar')?>" >
              <span>Materiales</span>
            </a>
            
          </li>

          <li class="sub-menu">
            <a href="javascript:;" >
              <span>Gastos</span>
            </a>
            <ul class="sub">
              <li><a  href="#">Compras</a></li>
              <li><a  href="#">Otros</a></li>
            </ul>
          </li>

          <li class="sub-menu mt">
            <a href="javascript:;">
              <span>Configuración</span>
            </a>
            <ul class="sub">
              <li>
                <a href="<?php echo base_url('usuarios') ?>">Usuarios</a>
                
              </li>
              <li>
                <a href="javascript:;">Puntos de venta</a>
              </li>
            </ul>
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
