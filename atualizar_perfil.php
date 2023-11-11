<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
include("conexao.php");

$email = $_SESSION["email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email_post = $_POST["email"];
    $morada = $_POST["morada"];
    $cod_postal = $_POST["cod_postal"];
    $NIF = $_POST["NIF"];

    $sql = "UPDATE users SET nome = ?, email = ?, morada = ?, cod_postal = ?, NIF = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $nome, $email_post, $morada, $cod_postal, $NIF, $email);

    if ($stmt->execute()) {
        // Se a atualização for bem-sucedida, atualize a variável de sessão para refletir o novo email
        $_SESSION["email"] = $email_post;
        echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href = 'perfil.php';</script>";
    } else {
        echo "<script>alert('Erro na atualização!'); window.location.href = 'atualizar_perfil.php';</script>";
    }

    $stmt->close();
} else {
    // Consulta para obter os dados do usuário
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // continue o restante do seu código, como exibir o formulário com os dados atuais do usuário
    } else {
        echo "Utilizador não encontrado na base de dados.";
        exit;
    }

    $stmt->close();
}

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

          <br>
	      <br>
		  <br>
		  <br>
		  <br>
	
	<div class="card">
        <div class="card2">
          <form class="form" method="POST" action="atualizar_perfil.php">
          <p id="heading">Editar meu perfil</p>

          <!--email-->
           <span class="negrito">Email:</span>
		   <div class="field">
           <input type="email" name="email" class="input-field" value="<?php echo $row['email']; ?>">
            </div>

            <!--nome-->
           <span class="negrito">Nome: </span> 
		   <div class="field">
           <input type="text" name="nome" class="input-field" value="<?php echo $row['nome']; ?>">
          </div>

           <!--morada-->
          <span class="negrito">Morada:</span>
		  <div class="field">
          <input type="text" name="morada" class="input-field" value="<?php echo $row['morada']; ?>">
          </div>

           <!--codigo postal-->
           <span class="negrito">Código Postal:</span>
		  <div class="field">
          <input type="text" name="cod_postal" class="input-field" value="<?php echo $row['cod_postal']; ?>">
          </div>

           <!--NIF-->
           <span class="negrito">NIF:</span>
		  <div class="field">
          <input type="text" name="NIF" class="input-field" value="<?php echo $row['NIF']; ?>">
          </div>

          <div class="btn2">
          <button type="submit" class="button2">Salvar Alterações</button>
          <a href="perfil.php" class="button2">Perfil</a>
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