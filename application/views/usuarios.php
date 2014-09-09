<section id="main-content">
	<section class="wrapper site-min-height">
		<h3><i class="fa fa-angle-right"></i>Usuarios</h3>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="col-md-12 mt">
                    <div class="content-panel">
                        <table class="table table-hover">
                            <h4></h4>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Genero</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($usuarios as $usuario) {
                                    echo "<tr>";
                                    echo "<td>".$usuario->nom."</td>";
                                    echo "<td>".$usuario->genero."</td>";
                                    echo "<td>".$usuario->email."</td>";
                                    echo "<td>".$usuario->telefono."</td>";
                                    echo "<td>".$usuario->tipo."</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</section>
</section>