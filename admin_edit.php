
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

include('conexao.php');

// verificar se a sessão de admin esta ativa fazendo conexão com a BD 

if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
    $email = $_SESSION["email"];
} else {
    header("Location: login.php");
}
?>
 

<?php
if (isset($_POST["add_product"])) {

    $id_produto = $_POST['id_produto'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $stock = $_POST['stock']; 
    $preço_uni = $_POST['preço_uni']; 
    $foto = $_FILES['foto']['name']; 
    $foto_size = $_FILES['foto']['size']; 
    $foto_tmp_name = $_FILES['foto']['tmp_name']; 
    $foto_folder = 'uploaded_img/'.$foto;
    $capacidade = $_POST['capacidade']; 
    $cor = $_POST['cor']; 
    $marca = $_POST['marca']; 
    $dimensões = $_POST['dimensões']; 

    $select_product_name = mysqli_query($conn, "SELECT name FROM products WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Já existe um produto com esse Nome'; 
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO products (id_produto, name, stock, preço_uni, foto, capacidade, cor, marca, dimensões) VALUES ('$id', '$name', '$stock', '$preço_uni', '$foto', '$capacidade', '$cor', '$marca', '$dimensões')") 
        or die('query failed');
    }

    if ($add_product_query) {
        if ($foto_size > 2000000) {
            $message[] = 'Essa imagem é muito grande';
        } else {
            move_uploaded_file($foto_tmp_name, $foto_folder);
            echo "<script>alert('Produto adicionado com sucesso!'); window.location.href = 'admin_edit.php';</script>";
        }
    } else {
        echo "<script>alert('Não foi possivel adicionar o Produto!'); window.location.href = 'admin_edit.php';</script>";
    }
}

// DELETAR O PRODUTO 

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_foto_query = mysqli_query($conn, "SELECT foto FROM products WHERE id_produto = '$delete_id'") or die('query failed');
    
    $fetch_delete_foto = mysqli_fetch_assoc($delete_foto_query);
    $foto_name = $fetch_delete_foto['foto'];
    unlink('uploaded_img/' . $foto_name);

    mysqli_query($conn, "DELETE FROM products WHERE id_produto = $delete_id") or die('query failed');
    echo "<script>alert('Produto deletado com sucesso!'); window.location.href = 'admin_edit.php';</script>";
}

// ATUALIZAR PRODUTO PHP

if(isset($_POST['update_product'])){

    $update_p_id_produto = $_POST['update_p_id_produto'];
    $update_name = $_POST['update_name'];
    $update_stock = $_POST['update_stock'];
    $update_capacidade = $_POST['update_capacidade'];
    $update_cor = $_POST['update_cor'];
    $update_marca = $_POST['update_marca'];
    $update_tamanho = $_POST['update_dimensões'];
    $update_price = $_POST['update_preço_uni'];  // 

    // Correção da consulta SQL
    $sql = "UPDATE products 
            SET name = '$update_name', stock = '$update_stock', capacidade = '$update_capacidade', 
            cor = '$update_cor', marca = '$update_marca', dimensões = '$update_dimensões', preço_uni = '$update_price' 
            WHERE id_produto = '$update_p_id_produto'";

    mysqli_query($conn, $sql) or die ('query_failed');

    $update_foto = $_FILES['update_foto']['name'];
    $update_foto_tmp_name = $_FILES['update_foto']['tmp_name'];
    $update_foto_size = $_FILES['update_foto']['size'];
    $update_folder = 'uploaded_img/'.$update_foto;
    $update_old_foto = $_POST['update_old_foto'];

    if(!empty($update_foto)){
        if($update_foto_size > 2000000){
            $message[] = 'Essa imagem é muito grande';
        } else {
            // Correção da consulta SQL para atualizar a foto
            $sql = "UPDATE products 
                    SET foto = '$update_foto' 
                    WHERE id_produto = '$update_p_id_produto'";

            mysqli_query($conn, $sql) or die ('query_failed');
            move_uploaded_file($update_foto_tmp_name, $update_folder);
            unlink('uploaded_img/'.$update_old_foto);
        }
    }

    echo "<script>alert('Produto atualizado com sucesso!'); window.location.href = 'admin_edit.php';</script>";
}





// ENCOMENDAS FEITAS UPDATE E DELETE 

if (isset($_GET['delete'])) {
    $delete_id_encomenda = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM encomendas WHERE id_encomenda = ?");
    $stmt->bind_param("i", $delete_id_encomenda); // Supondo que id seja um número inteiro (ajuste conforme o tipo de dados)

    if ($stmt->execute()) {
        header('Location: admin_edit.php');
        exit();
    } else {
        die('Falha ao excluir a encomenda.');
    }
}



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
		<link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="admin.css">
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
                        
                                <?php
                                if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                                echo '<a href="admin_edit.php" class="current-page-item">Admin</a>';
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
            </div>
    <br>
    <br>
    <br>
    <br>
    <br>


    <!-- INICIO DASHBOARD -->

   <section class="dashboard"> 

   <h1 class="title">Painel de Controlo</h1>

<!-- PRODUTOS -->
<div class="box-container">
   <div class="box">
   <?php 
      $select_products = mysqli_query($conn, "SELECT * FROM products") or die ('query failed');
      $number_of_products = mysqli_num_rows($select_products);
      ?> 
      <h3> <?php echo $number_of_products; ?></h3>
      <p>produtos adicionados</p>
     </div>
<!-- USER NORMAIS -->

     <div class="box">
   <?php 
     $select_users = mysqli_query($conn, "SELECT * FROM users WHERE admin = 0") or die ('query failed');
      $number_of_users = mysqli_num_rows($select_users);
      ?> 
      <h3> <?php echo $number_of_users; ?></h3>
      <p>Utilizadores normais </p>
     </div>

<!-- USER ADMIN -->

     <div class="box">
   <?php 
     $select_users = mysqli_query($conn, "SELECT * FROM users WHERE admin = 1") or die ('query failed');
      $number_of_users = mysqli_num_rows($select_users);
      ?> 
      <h3> <?php echo $number_of_users; ?></h3>
      <p>Utilizadores Admin</p>
     </div>


     <!-- TOTAL de CONTAS CRIADAS-->

     <div class="box">
   <?php 
     $select_account = mysqli_query($conn, "SELECT * FROM users") or die ('query failed');
      $number_of_account = mysqli_num_rows($select_account);
      ?> 
      <h3> <?php echo $number_of_account; ?></h3>
      <p>Total de Utilizadores</p>
     </div>

     </div>
     
     <br>

<!-- TOTAL DE ENCOMENDAS -->

     <div class="box-container">
   <div class="box">
   <?php 
      $select_encomendas = mysqli_query($conn, "SELECT * FROM encomendas") or die ('query failed');
      $number_of_encomendas = mysqli_num_rows($select_encomendas);
      ?> 
      <h3> <?php echo $number_of_encomendas; ?></h3>
      <p>Total de Encomendas</p>
     </div>

     </div>

</section>

     <!-- FIM DASHBOARD -->




     <br>
     <br>
     <br>
     <br>


      <!-- ADICIONAR PRODUTOS INICIO  -->

   <section class="add-products">
    
   <h1 class="title">Adicionar Produtos</h1> 

   <form action="" method="post" enctype="multipart/form-data">
    <h3>Dados do Produto</h3>
    <!-- NOME --> 
    <input type="text" name="name" class="box" placeholder="Nome do produto" required>

    <!-- STOCK --> 
    <input type="number" name="stock" class="box" min="0" placeholder="Stock" required>

    <!-- PREÇO --> 
    <input type="text" min="0" name="preço_uni" class="box" placeholder="Preço do produto" required>

    <!-- FOTO --> 
    <input type="file" name="foto" accept="image/jpg, image/jpg, image/jpg" class="box" required>

    <!-- CAPACIDADE --> 
    <input type="text" name="capacidade" class="box" placeholder="Capacidade" required>

     <!-- COR --> 
     <input type="text" name="cor" class="box" placeholder="Cor" required>

     <!-- MARCA --> 
     <input type="text" name="marca" class="box" placeholder="Marca" required>

     <!-- dimensões --> 
     <input type="text" name="dimensões" class="box" placeholder="Dimensões" required>

    <input type="submit" value="adicionar" name="add_product" class="buttonn">

   </form>
   </section>
   <!-- ADICIONAR PRODUTOS FIM  -->




   <!-- MOSTRAR PRODUTOS INICIO -->

   <section class="show-products">

   <div class="box-container">
   <?php 
       $select_products = mysqli_query($conn, "SELECT * FROM products")
        or die ('query_failed'); 
        if(mysqli_num_rows($select_products) > 0) {
           while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
    <div class="box">
        <img src="uploaded_img/<?php echo $fetch_products['foto']; ?>" alt="">
        <!-- NOME -->
    <div class="name">Nome: <?php echo $fetch_products['name']; ?> </div>
        <!-- stock -->
    <div class="stock">Stock: <?php echo $fetch_products['stock']; ?> </div>
        <!-- CAPACIDADE -->
    <div class="capacidade">Capacidade: <?php echo $fetch_products['capacidade']; ?></div>
        <!-- COR -->
    <div class="cor">Cor: <?php echo $fetch_products['cor']; ?></div>
        <!-- MARCA -->
    <div class="marca">Marca: <?php echo $fetch_products['marca']; ?></div>
        <!-- dimensões -->
    <div class="dimensões">Dimensões: <?php echo $fetch_products['dimensões']; ?></div>    
      <!-- PREÇO -->
    <div class="preço_uni">Preço: €<?php echo $fetch_products['preço_uni']; ?>
    </div>  

        <!-- BOTÕES -->
     <a href="admin_edit.php?update=<?php echo $fetch_products['id_produto']; ?>" 
     class="option-btn">Editar Produto</a>

     <a href="admin_edit.php?delete=<?php echo $fetch_products['id_produto']; ?>" 
     class="delete-btn" onclick="return confirm('Apagar esse produto?');">Apagar Produto</a>
    </div>

    <?php 
        }
        } else {
            echo '<p class="empty>Não exitem produtos adicionados!</p>';
        }
    ?> 

</section>


<!-- MOSTRAR PRODUTO FIM -->-




<!-- EDITAR PRODUTO --> 

<section class="edit-product-form">

<?php 
    if(isset($_GET['update'])){
        $update_id_produto = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM products WHERE  id_produto = '$update_id_produto'") 
        or die ('query failed');
        if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
?>     
<form action="" method="post" enctype="multipart/form-data">

<br><br><br><br><br><br><br>

    <input type="hidden" name="update_p_id_produto" value="<?php echo $fetch_update['id_produto']; ?>">
    <input type="hidden" name="update_old_foto" value="<?php echo $fetch_update['foto']; ?>">
    <img src="uploaded_img/<?php echo $fetch_update['foto']; ?>" alt="">

    <!-- NOME -->
    <input type="text" name="update_name" value="<?php echo $fetch_update ['name']; ?>"
     class="box" required placeholder="Nome do Produto">
    <!-- STOCK -->
     <input type="text" name="update_stock" value="<?php echo $fetch_update ['stock']; ?>"
     class="box" required placeholder="Stock do Produto">
    <!-- CAPACIDADE --> 
    <input type="text" name="update_capacidade" value="<?php echo $fetch_update ['capacidade']; ?>"
     class="box" required placeholder="Capacidade do Produto">
    <!-- COR -->
    <input type="text" name="update_cor" value="<?php echo $fetch_update ['cor']; ?>"
     class="box" required placeholder="Cor do Produto">
    <!-- MARCA -->
    <input type="text" name="update_marca" value="<?php echo $fetch_update ['marca']; ?>"
     class="box" required placeholder="Marca do Produto">
    <!-- TAMANHO -->
    <input type="text" name="update_dimensões" value="<?php echo $fetch_update ['dimensões']; ?>"
     class="box" required placeholder="Dimensões do Produto">
    <!-- PREÇO -->
    <input type="text" name="update_preço_uni" value="<?php echo $fetch_update ['preço_uni']; ?>"
     class="box" min="0" required placeholder="Preço do Produto">

     <input type="file" class="box" name="update_foto" accept="image/jpg, image/jpeg, image/png">
     <input type="submit" value="Atualizar Produto" name="update_product" class="buttonn" >
     <input type="reset" value="Cancelar Atualização" id="close-update" class="buttonn" >
     <a href="admin_edit.php" class="buttonn">Voltar</a>
</form> 

<?php         
            }
        }
    }else{
       echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
?>

</section>







<!-- TOTAL ENCOMENDAS -->

<!-- FAZER CONTINUAÇÂO DO UPDATE COM O PHP E AJEITAR CSS -->
    <section class="encomendas-box-container">
    <div>
    <h1 class="title">Total Encomendas</h1>

        <?php
            $select_encomendas = mysqli_query($conn, "SELECT * FROM encomendas") or die('query failed');
            if (mysqli_num_rows($select_encomendas) > 0) {
                while ($fetch_encomendas = mysqli_fetch_assoc($select_encomendas)) {
        ?>

        <div class="box">
            <p>user id: <span><?php echo $fetch_encomendas['id_user']; ?></span></p>
            <p>id da encomenda: <span><?php echo $fetch_encomendas['id_encomenda']; ?></span></p>
            <p>data da encomenda: <span><?php echo $fetch_encomendas['data_encomenda']; ?></span></p>
            <p>valor total: <span><?php echo $fetch_encomendas['valor_total']; ?></span></p>

            <form action="" method="post">
                <input type="hidden" name="id_encomenda" value="<?php echo $fetch_encomendas['id_encomenda']; ?>">

                <select name="update_pagamento">
                    <option value="pendente">pendente</option>
                    <option value="completo">completo</option>
                </select>

                <input type="submit" value="atualizar" name="update_encomenda" class="buttonn">
                <a href="admin_edit.php?delete=<?php echo $fetch_encomendas['id_encomenda']; ?>"
                 onclick="return confirm('Deletar essa Encomenda?');" class="buttonn">apagar</a>
            </form>

        </div>

        <?php
            }
        } else {
            echo '<p class="empty">Não existem encomendas feitas!</p>';
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
</body>
</html>
</body>
</html>