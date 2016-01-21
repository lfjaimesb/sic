<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <style type="text/css">
    .xxx{ text-align: left; float: right; }
    .algo{
        cursor: pointer;
    }
    </style>
</head>
<body>
    <div class="container">
            <div class="col-md-2">
                <?= $this->Html->image("http://lorempixel.com/140/140/", ["alt" => "usuario", "class"=>"img-responsive img-rounded img-shw", "url"=>"/"]) ?>
            </div>
            <div id="nv-home" class="col-md-10">
                <div class="col-md-4">
					<p>Luis Fernando</p>
					<p>Persona física</p>
                </div>
				<div class="col-md-8">
					<nav>
						<ul>
							<li>
								<?= $this->Html->image("iconos/empresa.png", ["alt" => "Empresas", "class"=>"img-responsive", "url"=>"/empresas"]) ?>
                                <a href="empresas">Empresas</a>
							</li>
							<li>
                                <?= $this->Html->image("iconos/cuentas.png", ["alt" => "Cuentas", "class"=>"img-responsive", "url"=>"/cuentas"]) ?>
                                <a href="cuentas">Cuentas</a>
                            </li>
							<li>
                                <?= $this->Html->image("iconos/polizas.png", ["alt" => "Polizas", "class"=>"img-responsive", "url"=>"/polizas"]) ?>
                                <a href="polizas">Polizas</a>
							</li>
                            <li>
                                <?= $this->Html->image("iconos/papeles.png", ["alt" => "Papeles", "class"=>"img-responsive", "url"=>"/papeles"]) ?>
                                <a href="papeles">Papeles</a>
                            </li>
							<li>
                                <?= $this->Html->image("iconos/depreciacion.png", ["alt" => "Depreciacion", "class"=>"img-responsive", "url"=>"/depreciacion"]) ?>
                                <a href="depreciacion">Depreciacion</a>
                            </li>
							<li>
                                <?= $this->Html->image("iconos/reportes.png", ["alt" => "Reportes", "class"=>"img-responsive", "url"=>"/reportes"]) ?>
                                <a href="reportes">Reportes</a>
                            </li>
							<li>
                                <?= $this->Html->image("iconos/salir.png", ["alt" => "Salir", "class"=>"img-responsive", "url"=>"/salir"]) ?>
                                <a href="salir">Salir</a>
                            </li>
						</ul>
					</nav>
				</div>
                <div class="row col-md-12" id="sub-hd">
                    <strong>Periodo:</strong>
                </div>
            </div>
    </div>



    <?= $this->Flash->render() ?>

    <section class="container clearfix">
        <?= $this->fetch('content') ?>


    <div class="panel panel-success" id="ostia">
        <div class="panel-heading">Hola <strong class="xxx"> - + <b class="algo">X</b></strong> </div>
        <div class="panel-body">
             Prueba de ventana
        </div>
    </div>

    </section>


    <footer class="container-fluid navbar-fixed-bottom">
        <div class="row">
            <nav id="dock" class="col-md-8 col-md-offset-2">
                <li>
                    <?= $this->Html->image("iconos/cons.png", ["alt" => "Consilacion", "class"=>"img-responsive algo"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/balanza.png", ["alt" => "Balanza", "class"=>"img-responsive", "url"=>"/balanza"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/polizas.png", ["alt" => "Depreciacion", "class"=>"img-responsive", "url"=>"/depreciacion"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/empresa.png", ["alt" => "empresa", "class"=>"img-responsive", "url"=>"/empresa"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/papeles.png", ["alt" => "Papeles", "class"=>"img-responsive", "url"=>"/papeles"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/polizas.png", ["alt" => "Polizas", "class"=>"img-responsive", "url"=>"/polias"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/sat.png", ["alt" => "SAT", "class"=>"img-responsive", "url"=>"/sat"]) ?>
                </li>
                <li>
                    <?= $this->Html->image("iconos/tipoliza.png", ["alt" => "Tipo de Poliza", "class"=>"img-responsive","data-toggle"=>"modal","data-target"=>"#myModal"]) ?>
                </li>
            </nav>
        </div>
    </footer>


  
    <?= $this->Html->script(["jquery.js", "bootstrap.min.js"]) ?>
    <script type="text/javascript">
        $('#ostia').hide("fast");

        $(".algo").on("click", function() {
            if($('#ostia').is(':visible')){
                $('#ostia').hide('fast');
            }else{
                $('#ostia').show('fast');
            }           
        });
   
    </script>
</body>
</html>
