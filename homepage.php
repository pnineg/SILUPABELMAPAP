<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

include("conexao.php");
/*
$email = $_SESSION["email"];
// Consultar o banco de dados para verificar o usuário
$sql = "SELECT * FROM users WHERE email=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $email);


// Executar a consulta
$stmt->execute();

// Pegar o resultado da consulta
$result = $stmt->get_result();

$row = $result->fetch_assoc();




<a href="index.php"><?php echo $row["username"];?></a>
*/
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
										<a href="homepage.php" class="current-page-item">Início</a>
										<a href="produtos.php">Produtos</a>
										<a href="serviços.php">Serviços</a>
                                        <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                                                echo "<a href='admin_edit.php'>Admin</a>";
                                            
                                        }
                                        ?>
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
				<div id="banner-wrapper"> <!--Ajeitar BANER-->
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

                        <section>
                            <h2>Um pouco de sua história</h2>
                            <p >A Belma,  Belmiro Pinto Mesquita fundou a Belma nos anos 1930, inicialmente como uma oficina de caldeiraria que produzia alambiques e peças de cobre. Posteriormente, a empresa entrou na fabricação de cilindros elétricos para aquecimento de água.
                                 A ênfase na qualidade e segurança fez da Belma uma marca consagrada em Portugal, 
                                e ela também se destacou como pioneira em certificações e se expandiu para dispositivos de energia alternativa, como acumuladores para painéis solares. 
                                Com 80 anos de história, a Belma agradece a seus clientes por sua confiança contínua.</p>
                        </section>
                        <img src="https://silupa.pt/wp-content/uploads/2017/09/Confianca_1.png">
                    </div>
                    <div class="col-4 col-6-medium col-12-small">

                        <section>
                            <h2>Confiança</h2>
                            <ul class="small-image-list">
                                    <p>A ênfase na qualidade contínua dos produtos é uma parte fundamental da identidade da nossa empresa. 
                                        Isso se reflete em nossos colaboradores, que são altamente qualificados nas áreas de serviço que oferecemos, e é um fator-chave para a fidelização dos nossos clientes.
                                      Nossos termoacumuladores Belma são notáveis por sua durabilidade excepcional, 
                                      graças à sua construção com cuba em cobre.</p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    
                                

                                    <img src="https://silupa.pt/wp-content/uploads/2017/09/Historia_1.png">
                        </section>

                    </div>
                    <div class="col-4 col-6-medium col-12-small">

                        <section>
                            <h2>Qualidade e segurança  </h2>
                            <p>
                                Os termoacumuladores Belma se destacam por sua construção com cuba inteiramente em cobre e pela inclusão de um sistema de termossifão interno. 
                                Esse sistema impede que o aparelho seja esvaziado em caso de falha no fornecimento de água, eliminando o risco de ruptura ou explosão.
                                Além disso, todos os nossos aparelhos de alta pressão são equipados com um sistema de termossifão interno semelhante, proporcionando segurança adicional 
                                ao manter a água no interior do aparelho em situações de falha no fornecimento de água.
                            </p>
                        </section>
                     <br>
                     <br>
                     <br>
                     <img src="https://silupa.pt/wp-content/uploads/2017/09/Qualidade_1.png">
                    </div>
                    
                    <br>
                    <br>


							<div class="col-6 col-12-medium">

								<section>
									<h2>Boas razões para eleger um aparelho de cobre Belma</h2>
									<h3>Durabilidade</h3>
									<p>Os cilindros Belma se destacam pela durabilidade excepcional quando instalados corretamente e em águas com pH entre 6.5 e 8.5, com uma vida útil que pode ultrapassar 20 anos. Ao contrário de produtos feitos de outros materiais,
                                         os cilindros Belma, feitos de cobre, podem ser reparados em caso de ruptura, enquanto outros têm uma vida útil de apenas 3 a 5 anos e não podem ser reparados.
                                        Os termoacumuladores Belma em cobre não requerem inspeções anuais como os de outros materiais, pois não possuem ânodo de magnésio que exige verificação anual e incorre em custos adicionais para o cliente. 
                                        Embora os cilindros Belma possam ter um custo inicial mais alto em comparação com outros aparelhos, essa diferença é compensada rapidamente devido à sua durabilidade. Além disso, o cobre é reciclável, o que o torna uma opção ecologicamente vantajosa para aqueles preocupados com o meio ambiente.
                                        Uma vantagem para as pessoas que se preocupam com a proteção do meio ambiente.
                                        A experiência ao longo do tempo demonstrou plena eficácia do cobre, o que garante a tranquilidade total.</p>
									<br>
							        <br>
									<ul class="big-image-list">
										<li>
								</section>
                            
							</div>
							<div class="col-6 col-12-medium">

								<article class="blog-post">
                                    <br>
									<br>
                                    <br>
									<h3>Vantagens</h3>
									<p> Os aparelhos fabricados em cobre da Belma permitem em pouco tempo uma recuperação económica relativamente a outros aparelhos como os de aço-vitrificado, 
                                        esmaltado ou ceramificados etc., uma vez que o cobre tem uma condução térmica elevada, permitindo assim que em poucos meses, a diferença de valor na compra dum aparelho 
                                        Belma em cobre se dilua em relação a outras matérias primas referidas anteriormente. Os termoacumuladores BELMA possuem a caldeira em cobre.
                                        O cobre é um material de alta qualidade, puro e natural, utilizado há milénios.
                                        Oferece boas condições sanitárias, sendo altamente resistente ao calor e à pressão.
                                        É duro, resistente e versátil. Qualquer instalador qualificado pode solucionar qualquer problema com toda a garantia.
                                        Ao ser reciclável, o cobre conserva o seu valor. Uma vantagem para as pessoas que se preocupam com a proteção do meio ambiente.
                                        A experiência ao longo do tempo demonstrou plena eficácia do cobre, o que garante a tranquilidade total.
                                        Também possuem termóstato para ajuste de temperatura e um corta-circuito térmico pré-configurado que desliga automaticamente em caso de excesso de temperatura.</p>
									</footer>
								</article>

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