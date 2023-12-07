<?php

//Código para mostrar erros

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include('conexao.php');
?>


<!DOCTYPE HTML>
<!--
	Minimaxing by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Silupa - Belma</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

		<link rel="icon" href="images/BELMA.png" type="image/png" sizes="16x16">
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<div class="container">
						<div class="row">
							<div class="col-12">

								<header id="header">
								<h1><a href="index.php" id="logo"><img src="https://silupa.pt/wp-content/uploads/2017/09/logo-footer.png"></a></h1>
									<nav id="nav">
										<a href="homepage.php">Início</a>
										<a href="produtos.php">Produtos</a>
										<a href="serviços.php" class="current-page-item">Serviços</a>
										<!-- BOTAO ADMIN -->
										<?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                                                echo "<a href='admin_edit.php'>Admin</a>";
                                            
                                        }
                                        ?>
                                         <!-- BOTAO ADMIN FIM-->

										<a href="perfil.php">Perfil</a>

										  <!-- Carrinho botão -->

										  <?php   
                                $cart_rows_number = 0; // Inicialize a variável com 0

                                if (isset($_SESSION['id_user'])) {
                                  $id_user = $_SESSION['id_user'];
    
                                $select_cart_number = mysqli_query($conn, "SELECT * FROM linhas_encm 
                                   INNER JOIN encomendas ON linhas_encm.id_encomenda = encomendas.id_encomenda 
                                    WHERE encomendas.id_user = '$id_user'") or die ('query failed');
    
                                // Verifica se $select_cart_number está definido para evitar erro
                                $cart_rows_number = $select_cart_number ? mysqli_num_rows($select_cart_number) : 0; 
                                }
                                ?>
                                        <a href="carrinho.php"> 
                                        <i class="fas fa-shopping-cart"></i> 
                                        <span>(<?php echo $cart_rows_number; ?>)</span>
                                        </a>

                                <!-- Fim carrinho -->

										<a href="logout.php">logout</a>
										
									</nav>
								</header>

							</div>
						</div>
					</div>
				</div>


				<!-- Banner -->
				<div id="banner-wrapper">
					<div class="container">

						<div id="banner">
							<h2>Desde 1837 a dar água quente nos lares portugueses</h2>
							<span>produto 100% reciclavel fabricado em Portugal</span>
						</div>

					</div>
				</div>



			<!-- Main -->
				<div id="main">
					<div class="container">
						<div class="row main-row">
							<div class="col-4 col-12-medium">


							<!-- informações da esquerda-->
							<section>
									<h2>Tipos de Termoaculadores</h2>
									<ul class="small-image-list">
										<li>
											<h4>Termoaculadores de Alta Pressão</h4>
											<p>Para a ligação direta à rede de água, onde não se exceda a 
											pressão efetiva de 6 bar* (se ultrapassar, é necessário montar uma válvula redutora de pressão).</p>
										</li>
										<li>
											<h4>Termoaculador de Baixa Pressão</h4>
											<p>Para ser alimentado por um depósito de água, onde a pressão no aparelho não exceda 1bar. 
											  Neste tipo, é indispensável colocar no topo do aparelho um tubo de respiro,
											 até a uma altura ligeiramente superior ao depósito.</p>
										</li>
									</ul>
								</section>


								<section>
									<h2>Esquema de termoaculadores</h2>
									<a class="link-list">
										<a href="#"> <img src="images/esquema.jpeg"  width="370px" height="300px" alt="" class="left" /></a>
								</section>


		<section>
            <style>
            .mapabox {
            position: relative;
            width: 400px; /* Ajuste o tamanho conforme necessário */
            height: 400px; /* Mantenha a mesma altura para criar um quadrado */
            float: left; /* Alinha à esquerda */
            }
            .mapabox iframe {
            width: 100%;
            height: 100%;
            }
            /* Limpa o float para evitar problemas de layout */
            section:after {
            content: "";
            display: table;
            clear: both;
            }
            </style>

                <h2>Localização e Informações de Contacto de Nossa Loja</h2>
                <div class="mapabox"> 
	                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3004.153626031683!2d-8.602440924742435!3d41.152999010502285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
	                1!3m3!1m2!1s0xd2464f17c7d66fd%3A0x1de1eef5c7551fc3!2sSilupa%20-%20Sistemas%20de%20%C3%81gua%20Quente%20e%20Aquecimento!5e0!3m2!1spt-PT!2spt!4v1701860143165!5m2!1spt-PT!2spt"
	                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<p><img src="https://w7.pngwing.com/pngs/799/5/png-transparent-telephone-symbol-icon-telephone-symbol-telephone-sign-miscellaneous-text-logo.png" right="30" width="20">+351 225 374 784 (Chamada para a rede fixa nacional)</p>
                <p><img src="https://icones.pro/wp-content/uploads/2021/03/icone-gmail.png" right="30" width="20">  geral@silupa.pt</p>
                <a href="https://www.instagram.com/belmasilupa/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA==" target="_blank">
                <img src="https://w7.pngwing.com/pngs/998/289/png-transparent-instagram-icon-logo-grayscale-graphic-designer-instagram-customer-service-miscellaneous-angle-gdragon-thumbnail.png" right="30" width="20" alt="Instagram">
                </a>	 
                </section>

            </div>
			<!-- informações da esquerda fim -->




				<div class="col-8 col-12-medium imp-medium">
					<section>
						<h2>Personalização</h2>
						<h4>Personalização do Seu Termoaculador (Cilindro)</h4>
						<p>Personalização Como fabricantes temos sempre a possibilidade de fabricar os
						nossos aparelhos conforme as necessidades dos nossos clientes,
						quer em termos de altura e diâmetro, como nas entradas e saídas
						de água. Também fazemos os suportes de fixação à parede na
						medida pretendida, caso queira aproveitar as fixações já existentes.
                        </p>
					</section>


					<section>
						<h2>Alguns Tipos de Avarias</h2>
						<h4>Termoaculador Elétrico (Cilindro)</h4>
						<p>Geralmente, o problema ocorre por falta de água quente. Se for um termoacumulador (cilindro) elétrico, pode ser a resistência ou o termostato.
						Também existem problemas relacionados ao excesso de pressão na rede de abastecimento de água nas casas, dependendo da região. 
						Esse excesso de pressão pode causar rupturas no interior da caldeira, resultando em vazamentos que, por vezes, provocam inundação.
						Essa situação pode ser resolvida instalando válvulas para controlar e reduzir a pressão excessiva.</p>

						<h4>Termoaculador a Gás (Cilindro)</h4>
						<p>Se for um equipamento a gás, geralmente, são os sistemas eletrônicos que avariam. No entanto, no caso do gás, é crucial verificar diversos fatores de segurança, 
						como a ventilação e extração de gases, de acordo com as normas de segurança. Além disso, é de extrema importância lidar com eventuais fugas de gás.</p>
					</section>

					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>

					<section>
					<h2>Assistência Técnica</h2>	
					<h4>Assistência Técnica</h4>
                       <p> Assistência Técnica Especializada que realiza serviços de instalação e
						reparo em todas as marcas de cilindros/termoacumuladores
						elétricos, esquentadores a gás, caldeiras para aquecimento central
						e águas sanitárias, sistemas solares (painéis e acumuladores), ar-condicionado e bombas de calor.
						Os nossos serviços ao domicílio são sempre oferecidos a preços justos, mantendo uma ótima relação entre qualidade e preço. São executados por técnicos devidamente
						credenciados e especializados em diversas áreas.</p>
					</section>	
			</div>
		</div>
	</div>
</div>

			




	<!-- Footer -->
<div id="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-8 col-12-medium">

                <section>
                    <img src="https://www.belma.pt/wp-content/uploads/2021/02/BELMA-300x108.png" width="100" height="40">
                    <br>
                    <br>
                    <h2>A confiança e a certeza de uma marca portuguesa.</h2>
                    <div>
                        <div class="row">
                    <p>A Silupa, Lda. atua como representante oficial das marcas Vulcano e Junkers-Bosch,
                         oferecendo uma ampla gama de produtos, como esquentadores a gás,
                         caldeiras a gás para aquecimento central e água quente, sistemas solares para água quente,
                          bombas de calor e ar-condicionado.</p>
                        
                    </section>

            </div>
            <div class="col-4 col-12-medium">

                <section>
                    <h2>Informações</h2>
                    <p><img src="http://silupa.pt/wp-content/uploads/2017/09/local.png" right="30" width="20">Rua Santos Pousada, 471 | 4000-486 Porto</p>
                    <p><img src="https://w7.pngwing.com/pngs/799/5/png-transparent-telephone-symbol-icon-telephone-symbol-telephone-sign-miscellaneous-text-logo.png" right="30" width="20">+351 225 374 784 (Chamada para a rede fixa nacional)</p>
                    <p><img src="https://icones.pro/wp-content/uploads/2021/03/icone-gmail.png" right="30" width="20">  geral@silupa.pt</p>
                    <p><img src="https://w7.pngwing.com/pngs/998/289/png-transparent-instagram-icon-logo-grayscale-graphic-designer-instagram-customer-service-miscellaneous-angle-gdragon-thumbnail.png" right="30" width="20">   @belmasilupa</p>
                </section>

            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div id="copyright">
                    <p>Feito por Pedro Gomes</p>
                </div>

            </div>
        </div>
    </div>
</div>

</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
