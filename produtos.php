<?php

//Código para mostrar erros

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ob_start();
include('conexao.php');
session_start();
?>

<!--ADICIONAR AO CARRINHO-->


<?php

// Obter o user id
$id_user = $_SESSION['id_user'];

// Verifique se os campos necessários estão definidos
if (isset($_POST['id_produto'], $_POST['quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
    $preço_uni = $_POST['preço_uni'];

    // Calcular o valor total para enviar na encomenda
    $valor_total = $quantidade * $preço_uni;

    // Cria uma nova encomenda, o resultado dessa função ira ficar armazenado no id_encomenda; 
    // Recebe o valor retornado e associa ao carrinho 

        $id_encomenda = criarNovaEncomenda($conn, $id_user, $valor_total);
      


    // Verifique se o produto já está no carrinho
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM linhas_encm WHERE 
        id_produto = '$id_produto' AND id_encomenda = '$id_encomenda'") or die('Query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Já está adicionado ao carrinho';
    } else {
        // Adicione o produto ao carrinho
        mysqli_query($conn, "INSERT INTO linhas_encm (id_encomenda, id_produto, quantidade, valor_produto) 
        VALUES ('$id_encomenda', '$id_produto', '$quantidade', '$valor_total')") or die('Query failed');
        $message[] = 'Produto adicionado ao carrinho!';
    }
} else {
    $message[] = 'Campos obrigatórios não estão definidos.';
}

// Função para criar uma nova encomenda e retornar o id_encomenda e recebe os valores "conn"
function criarNovaEncomenda($conn, $id_user, $valor_total)
{
    // Data atual, obtem a data e coloca em uma variavel "ano-mes-dia" na tabela encomendas 
    $data_encomenda = date("Y-m-d");

    // Insira uma nova encomenda
    mysqli_query($conn, "INSERT INTO encomendas (data_encomenda, id_user, valor_total) 
        VALUES ('$data_encomenda', '$id_user', $valor_total)") or die('Query failed');

    // Obtenha o id_encomenda recém-criado e retorna o valor 
    $id_encomenda = mysqli_insert_id($conn);
    return $id_encomenda;
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
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="products.css">
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
                            <h1><a href="index.php" id="logo"><img
                                        src="https://silupa.pt/wp-content/uploads/2017/09/logo-footer.png"></a></h1>
                            <nav id="nav">
                                <a href="homepage.php">Início</a>
                                <a href="produtos.php" class="current-page-item">Produtos</a>
                                <a href="serviços.php">Serviços</a>
                                <!-- BOTAO ADMIN -->
                                <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                                    echo "<a href='admin_edit.php'>Admin</a>";

                                }
                                ?>
                                <!-- BOTAO ADMIN FIM -->

                                <a href="perfil.php">Perfil</a>
                                

                                <!-- Carrinho botão -->

                                <?php
                                $cart_rows_number = 0; // Inicialize a variável com 0
                                
                                if (isset($_SESSION['id_user'])) {
                                    $id_user = $_SESSION['id_user'];

                                    $select_cart_number = mysqli_query($conn, "SELECT * FROM linhas_encm 
                                   INNER JOIN encomendas ON linhas_encm.id_encomenda = encomendas.id_encomenda 
                                    WHERE encomendas.id_user = '$id_user'") or die('query failed');

                                    // Verifica se $select_cart_number está definido para evitar erro
                                    $cart_rows_number = $select_cart_number ? mysqli_num_rows($select_cart_number) : 0;
                                }
                                ?>
                                <a href="carrinho.php">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>
                                        (<?php echo $cart_rows_number; ?>)
                                    </span>
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

    <!-- Banner -->
    <div id="banner-wrapper"> <!--Ajeitar BANER-->
        <div class="container">

            <div id="banner">
                <h2>Desde 1837 a dar água quente nos lares portugueses</h2>
                <span>produto 100% reciclavel fabricado em Portugal</span>
            </div>

        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    



<!-- PESQUISAR PRODUTOS -->

    <section class="procurar-form">
        <form action="" method="post">
            <input type="text" name="procurar" placeholder="Procurar Produtos..."
            class="box">
            <input type="submit" name="submit" value="procurar" class="buttonn">
        </form>
    </section>    


    <section class="products" style="padding-top: 0;">
      <div class="box-container">
      <?php
      if (isset($_POST['submit'])) {
          $procurar_item = $_POST['procurar'];
      
          $select_products = mysqli_query($conn, "SELECT * FROM products 
             WHERE name LIKE '%$procurar_item%' 
               OR stock LIKE '%$procurar_item%' 
               OR capacidade LIKE '%$procurar_item%' 
               OR cor LIKE '%$procurar_item%' 
               OR marca LIKE '%$procurar_item%' 
               OR dimensões LIKE '%$procurar_item%' 
               OR preço_uni LIKE '%$procurar_item%'") or die('query_failed');
          if ($select_products) {
              if (mysqli_num_rows($select_products) > 0) {
                  while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                      ?>

                      <form action="" method="post" class="box">

<img src="uploaded_img/<?php echo $fetch_products['foto']; ?>" alt="">

<!-- NOME -->
<div class="nome">Nome:
    <?php echo $fetch_products['name']; ?>
</div>
<!-- stock -->
<div class="stock">Stock:
    <?php echo $fetch_products['stock']; ?>
</div>
<!-- CAPACIDADE -->
<div class="capacidade">Capacidade:
    <?php echo $fetch_products['capacidade']; ?>
</div>
<!-- COR -->
<div class="cor">Cor:
    <?php echo $fetch_products['cor']; ?>
</div>
<!-- MARCA -->
<div class="marca">Marca:
    <?php echo $fetch_products['marca']; ?>
</div>
<!-- TAMANHO -->
<div class="dimensões">Dimensões:
    <?php echo $fetch_products['dimensões']; ?>
</div>
<!-- PREÇO -->
<div class="preço_uni">Preço: €
    <?php echo $fetch_products['preço_uni']; ?>
</div>

<!-- DADOS ID PRODUTO E PREÇO -->
<input type="hidden" name="id_produto" value="<?php echo $fetch_products['id_produto']; ?>">
<input type="hidden" name="preço_uni" value="<?php echo $fetch_products['preço_uni']; ?>">

                        <!-- QUANTIDADE -->
                        <input type="number" min="1" name="quantidade" value="1" class="qnt">

                        <!-- BOTÃO CARRINHO -->
                        <input type="submit" name="add_no_carrinho" value="adicionar no carrinho" class="buttonn">

                      </form>

                      <?php
                  }
              } else {
                  echo '<p class="empty">Nenhum produto encontrado!</p>';
              }
          } else {
              echo '<p class="empty">Erro na consulta: ' . mysqli_error($conn) . '</p>';
          }
      } else {
          echo '<p class="empty">Procure por um produto!</p>';
      }
      ?>
      
      </div>
    </section>
    
<!-- PESQUISAR PRODUTOS FIM-->



<div id="linha">
</div>



<!-- MOSTRAR PRODUTOS -->
    <section class="products">
        <center><h3 class="titleb">Nossos Produtos</h3></center>
        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM products LIMIT 6")
                or die('query_failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>


                    <form action="" method="post" class="box">

                        <img src="uploaded_img/<?php echo $fetch_products['foto']; ?>" alt="">

                        <!-- NOME -->
                        <div class="nome">Nome:
                            <?php echo $fetch_products['name']; ?>
                        </div>
                        <!-- stock -->
                        <div class="stock">Stock:
                            <?php echo $fetch_products['stock']; ?>
                        </div>
                        <!-- CAPACIDADE -->
                        <div class="capacidade">Capacidade:
                            <?php echo $fetch_products['capacidade']; ?>
                        </div>
                        <!-- COR -->
                        <div class="cor">Cor:
                            <?php echo $fetch_products['cor']; ?>
                        </div>
                        <!-- MARCA -->
                        <div class="marca">Marca:
                            <?php echo $fetch_products['marca']; ?>
                        </div>
                        <!-- TAMANHO -->
                        <div class="dimensões">Dimensões:
                            <?php echo $fetch_products['dimensões']; ?>
                        </div>
                        <!-- PREÇO -->
                        <div class="preço_uni">Preço: €
                            <?php echo $fetch_products['preço_uni']; ?>
                        </div>


                        <!-- DADOS ID PRODUTO E PREÇO -->
                        <input type="hidden" name="id_produto" value="<?php echo $fetch_products['id_produto']; ?>">
                        <input type="hidden" name="preço_uni" value="<?php echo $fetch_products['preço_uni']; ?>">

                        <!-- QUANTIDADE -->
                        <input type="number" min="1" name="quantidade" value="1" class="qnt">

                        <!-- BOTÃO CARRINHO -->
                        <input type="submit" name="add_no_carrinho" value="adicionar no carrinho" class="buttonn">


                    </form>

                <?php
                }
            } else {
                echo '<p class="empty>Não exitem produtos adicionados!</p>';
            }
            ?>

    </section>



<div id="linha">
</div>



    <!-- SOBRE  -->
    <section class="about">
               
        <div class="flex">

            <div class="image">
                <img src="https://silupa.pt/wp-content/uploads/2017/09/slide1-1.png" width="500px" height="300px" alt="">
            </div>

            <div class="content">
                <h2>Sobre nós</h2>
                <p>A missão da Silupa, Lda. é oferecer aos seus clientes e mercado em geral uma vasta gama de produtos
                    no sector dos sistemas de produção de águas quentes e aquecimento, de elevada qualidade com
                    equipamentos
                    de marcas reconhecidas ao longo dos anos, como é o caso dos termoacumuladores eléctricos Belma
                    (marca portuguesa mais antiga)
                    com cuba em cobre. Comercializamos também termoacumuladores domésticos, industriais e para energias
                    alternativas com cuba em cobre ou aço-inox,
                    da marca Metalúrgica Videira.
                    Somos representantes oficiais das marcas Vulcano e Junkers-Bosh, tendo toda a gama de esquentadores
                    a gás, caldeiras a gás para aquecimento central
                    e águas sanitárias, sistemas solares para água quente, bombas de calor e ar-condicionado.
                    Temos como principais objectivos preços competitivos na solução final de cada cliente, rapidez na
                    entrega de produtos e todo o apoio técnico devido
                    e necessário para com os nossos clientes, sempre com um grau de qualidade e resposta elevados.
            </div>
            <a href="serviços.php" class="buttonn">Nossos Serviços</a>
        

    </section>



    <br>
    <br>
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
                        <img src="https://www.belma.pt/wp-content/uploads/2021/02/BELMA-300x108.png" width="100"
                            height="40">
                        <br>
                        <br>
                        <h2>A confiança e a certeza de uma marca portuguesa.</h2>
                        <div>
                            <div class="row">
                                <p>A Silupa, Lda. atua como representante oficial das marcas Vulcano e Junkers-Bosch,
                                    oferecendo uma ampla gama de produtos, como esquentadores a gás,
                                    caldeiras a gás para aquecimento central e água quente, sistemas solares para água
                                    quente,
                                    bombas de calor e ar-condicionado.</p>

                    </section>

                </div>
                <div class="col-4 col-12-medium">

                    <section>
                        <h2>Informações</h2>
                        <p><img src="http://silupa.pt/wp-content/uploads/2017/09/local.png" right="30" width="20">Rua
                            Santos Pousada, 471 | 4000-486 Porto</p>
                        <p><img src="https://w7.pngwing.com/pngs/799/5/png-transparent-telephone-symbol-icon-telephone-symbol-telephone-sign-miscellaneous-text-logo.png"
                                right="30" width="20">+351 225 374 784 (Chamada para a rede fixa nacional)</p>
                        <p><img src="https://icones.pro/wp-content/uploads/2021/03/icone-gmail.png" right="30"
                                width="20"> geral@silupa.pt</p>
                        <p><img src="https://w7.pngwing.com/pngs/998/289/png-transparent-instagram-icon-logo-grayscale-graphic-designer-instagram-customer-service-miscellaneous-angle-gdragon-thumbnail.png"
                                right="30" width="20"> @belmasilupa</p>
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
