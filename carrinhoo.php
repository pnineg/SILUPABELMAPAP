<?php

//Código para mostrar erros

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ob_start();
include('conexao.php');
session_start();
?>

<?php
// Obtenha o id do usuário da sessão
$id_user = $_SESSION['id_user'];

// Consulte os produtos no carrinho do usuário
$query_carrinho = "SELECT 
                      linhas_encm.id_encomenda,
                      linhas_encm.quantidade,
                      products.*
                  FROM 
                      linhas_encm 
                      INNER JOIN products ON linhas_encm.id_produto = products.id_produto 
                      INNER JOIN encomendas ON linhas_encm.id_encomenda = encomendas.id_encomenda
                  WHERE 
                      encomendas.id_user = '$id_user'
                  ORDER BY 
                      linhas_encm.id_encomenda DESC, 
                      products.id_produto";
$result_carrinho = mysqli_query($conn, $query_carrinho) or die('Query failed');


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
		<link rel="stylesheet" href="carrinho.css">
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
										<a href="serviços.php">Serviços</a>
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
                                        <a href="carrinho.php" class="current-page-item"> 
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
            </div>

          

            <br>
            <br>
            <br>
            

            <div class="carrinho">
    <center><h3 class="titleb">Seu Carrinho de Compras</h3></center>   
  </div>        


  <section class="carrinho">
        <h1 class="titlea">Produtos Adicionados</h1>

        <div class="box-container">

      <?php       
      // Inicialize a variável $id_encomenda_atual
      $id_encomenda_atual = null;

     // Verifique se há produtos no carrinho
    if (mysqli_num_rows($result_carrinho) > 0) {
      // Exibe os produtos no carrinho

       while ($fetch_cart = mysqli_fetch_assoc($result_carrinho)) {
        // Verifica se a encomenda mudou

        if ($fetch_cart['id_encomenda'] != $id_encomenda_atual) {
            // Atualiza o ID da encomenda atual
            $id_encomenda_atual = $fetch_cart['id_encomenda'];

            // Atualiza o valor total para a nova encomenda
            $valor_total_ultima_encomenda = 0;
        }

        // Adiciona o valor do produto ao valor total da encomenda
        $valor_total_ultima_encomenda += $fetch_cart['preço_uni'] * $fetch_cart['quantidade'];
        ?>

      <!-- DADOS -->
            <div class="box">
                <img src="uploaded_img/<?php echo $fetch_cart['foto']; ?>" alt="">
                 <!-- NOME -->
    <div class="nome">Nome: <?php echo $fetch_cart['name']; ?> </div>
        <!-- CAPACIDADE -->
    <div class="capacidade">Capacidade: <?php echo $fetch_cart['capacidade']; ?></div>
        <!-- COR -->
    <div class="cor">Cor: <?php echo $fetch_cart['cor']; ?></div>
        <!-- MARCA -->
    <div class="marca">Marca: <?php echo $fetch_cart['marca']; ?></div>
        <!-- TAMANHO -->
    <div class="dimensões">Dimensões: <?php echo $fetch_cart['dimensões']; ?></div>   
        <!-- QUANTIDADE ADICIONADA -->
    <div class="quantidade">Quantidade: <?php echo $fetch_cart['quantidade']; ?> </div>
        <!-- PREÇO TOTAL -->
        <div class="valor_total">Valor total: <?php echo $valor_total_ultima_encomenda; ?> </div>

          <!-- DELETAR DO CARRINHO -->
            <a href="carrinho.php?delete=<?php echo $fetch_cart['id_encomenda']; ?>"
                 onclick="return confirm('Deseja retirar esse produto do carrinho?');" 
                name="tirar-carrinho" class="buttonn">Retirar Produto do Carrinho</a>  

            <!-- FINALIZAR COMPRA -->
            <a href="carrinho.php"
                 onclick="return confirm('Deseja realizar a compra desse produto?');" 
                name="finalizar-compra" class="buttonn">Finalizar Compra</a>

            </div>

            

                 <?php
                 // DELETAR CARRINHO PHP

    if (isset($_GET['delete'])) {
    $delete_id_encomenda = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM linhas_encm WHERE id_encomenda = ?");
    $stmt->bind_param("i", $delete_id_encomenda); // Supondo que id seja um número inteiro (ajuste conforme o tipo de dados)

    if ($stmt->execute()) {
        header('Location: carrinho.php');
        exit();
    } else {
        die('Falha ao excluir a encomenda.');
    }
}
// DELETAR CARRINHO PHP FIM  
?>
               


  
            <?php
    }
} else {
    // Exibe mensagem de erro se nenhum produto for adicionado ao carrinho
    echo '<p class="empty">Nenhum Produto Foi Adicionado ao Carrinho</p>';
}
?>
     
        </div>
    </section>

    




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
    
    
        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/browser.min.js"></script>
            <script src="assets/js/breakpoints.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>
    
    </body>
    </html>


