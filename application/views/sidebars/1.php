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
            <li class="sub-menu">
             <a  href="<?php echo base_url('productos/listar')?>">
               <span>Productos</span>
             </a>
             
           </li>

           <li class="sub-menu">
            <a href="<?php echo base_url('materiales')?>" >
              <span>Materiales</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="<?php echo base_url('productos/agendar')?>" >
              <span>Agendar</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="javascript:;" >
              <span>Gastos</span>
            </a>
            <ul class="sub">
              <li><a  href="<?php echo base_url('compras')?>">Compras</a></li>
              <li><a  href="<?php echo base_url('gastos')?>">Otros</a></li>
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
                <a href="<?php echo base_url('inicio/subcatalogos') ?>">Subcatalogos</a>
              </li>
              <li>
                <a href="<?php echo base_url('lugares')?>">Puntos de venta</a>
              </li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" >
              <span>Reportes</span>
            </a>
            <ul class="sub">
              <li><a  href=<?php echo '"' . base_url("/reportes/balance") . '"' ?>>Balance</a></li>
              <li><a  href="<?php echo base_url('reportes/reporte_ventas');?>">Ventas</a></li>
              <li><a  href="<?php echo base_url('reportes/reporte_gastos');?>">Compras y gastos</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
