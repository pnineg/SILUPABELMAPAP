<?php
session_start();

// conexão com o banco de dados 
include("conexao.php");

$email = $_SESSION["email"]; 

// Consulta SQL para buscar os dados do user pelo ID
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se a consulta retornou um resultado
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado na base de dados.";
    exit;
}

// Fechando a conexão com a bd
$conn->close();
?>




<!-- HTML PERFIL-->


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
        <link rel="stylesheet" href="perfil.css" />
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
										<a href="homepage.php">Início</a>
										<a href="produtos.php">Produtos</a>
										<a href="serviços.php">Serviços</a>
										<?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                                                echo "<a href='admin_edit.php'>Admin</a>";
                                            
                                        }
                                        ?>
										<a href="perfil.php" class="current-page-item">Perfil</a>

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
	</head>
		
	      <br>
	      <br>
		  <br>
		  <br>
		  <br>
	
	<div class="card">
        <div class="card2">
          <form class="form" method="POST">
          <p id="heading">Meu perfil</p>
          <!--email-->
           <span class="negrito">Email:</span>
		   <div class="field">
		  <p><?php echo $row['email']; ?></p>
            </div>

            <!--user-->
           <span class="negrito">Nome: </span> 
		   <div class="field">
		 <p><?php echo $row['nome']; ?></p>
          </div>

           <!--morada-->
          <span class="negrito">Morada:</span>
		  <div class="field">
		   <p><?php echo $row['morada']; ?></p> 
          </div>
		  <!--codigo postal-->
          <span class="negrito">Código Postal:</span>
		  <div class="field">
		   <p><?php echo $row['cod_postal']; ?></p> 
          </div>
		  <!--NIF-->
          <span class="negrito">NIF:</span>
		  <div class="field">
		   <p><?php echo $row['NIF']; ?></p> 
          </div>

          <div class="btn2">
          <a href="atualizar_perfil.php" class="button2">Editar perfil</a>
          </div>
          
      </form>
        </div>
          </div>

		  <br>
		  <br>
		  <br>
		  <br>

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