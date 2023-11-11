
<!-- REGISTO PHP-->


<?php
include("conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar dados do formulário
    $email = $_POST["email"];
    $nome = $_POST["nome"]; // Adicione o campo 'nome'
    $morada = $_POST["morada"];
    $cod_postal = $_POST["cod_postal"];
    $NIF = $_POST["NIF"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    if (empty($email) || empty($nome) || empty($morada) || empty($cod_postal) || empty($NIF) || empty($password)) {
        echo "<script>alert('Credenciais vazias!'); window.location.href = 'registo.php';</script>";
    } else {
        // Preparar a consulta SQL
        $sql = "INSERT INTO users (id_user, email, nome, morada, cod_postal, NIF, password) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Verificar se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Vincular parâmetros à consulta
        $stmt->bind_param("ssssss", $email, $nome, $morada, $cod_postal, $NIF, $password);

        // Executar a consulta
        if ($stmt->execute()) {
            echo "<script>alert('Registado com sucesso!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Erro no Registo!'); window.location.href = 'registo.php';</script>";
        }

        // Fechar o statement
        $stmt->close();
    }
}
?>





<!-- REGISTO HTML -->


<!DOCTYPE html>
<html>
    <head>
		<title>Silupa - Belma</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="registo.css" />
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
										<a href="index.php">Início</a>
										<a href="registo.php" class="current-page-item">entrar</a>
										
									</nav>
								</header>

							</div>
						</div>
					</div>
				</div>
<body>

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


    <div class="card">
        <div class="card2">
          <form class="form" method="POST">
          <p id="heading">Registo</p>
          <!--email-->
          <div class="field">
              <input type="email"  name="email" class="input-field" placeholder="Email" autocomplete="off">
            </div>
            <!--nome-->
          <div class="field">
            <input type="text"  name="nome" class="input-field" placeholder="Nome" autocomplete="off">
          </div>
          <!--morada-->
          <div class="field">
            <input type="text"  name="morada" class="input-field" placeholder="Morada" autocomplete="off">
          </div>
          <!--codigo postal-->
          <div class="field">
            <input type="text"  name="cod_postal" class="input-field" placeholder="Código postal" autocomplete="off">
          </div>

          <!--NIF-->
          <div class="field">
            <input type="text"  name="NIF" class="input-field" placeholder="NIF" autocomplete="off">
          </div>
          
<!--pass-->
          <div class="field">
            <input type="password" name="password" class="input-field" placeholder="Senha">
          </div>
          <div class="btn2">
          <button class="button1" type="submit" name="submit">Registar</button>
          <a href="login.php" class="button2">Login</a>
          </div>
          
      </form>
        </div>
          </div>




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
</body>
</html>