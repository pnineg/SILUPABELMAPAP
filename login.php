<!--LOGIN PHP-->

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados 
    $mysqli = new mysqli("localhost","root","","silupabelma");
    
    // Verificar a conexão
    if ($mysqli->connect_error) {
        die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
    }
    
    // Coletar dados 
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Consultar o banco de dados para verificar o user
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Verificar se o user é um administrador
                if ($row["admin"] == 1) {
                     //Armazenar dados do utilizador na sessão
                    $_SESSION["admin"] = 1;
                    $_SESSION["email"] = $email;
                    // Este é um administrador, redirecione para o painel de admin
                    header("Location: homepage.php");
                } else {
                    unset($_SESSION["admin"]);
                    //Armazenar dados do utilizador na sessão
                    $_SESSION["email"] = $email;
                    // Este é um utilizador, redireciona para a homepage
                    header("Location: homepage.php");
                }
            } else {
                echo "<script>alert('Email ou senha incorreto!'); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Utilizador não encontrado'); window.location.href = 'login.php';</script>";
        }
        
    } else {
        echo "Erro na autenticação.";

        // Fechar o statement
        $stmt->close();
        
        // Fechar a conexão com o banco de dados
        $conn->close();

    }}
    ?>


<!--LOGIN HTML-->


<!DOCTYPE html>
<html>
    <head>
		<title>Silupa - Belma</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="login.css" />
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
    
<div class="card">
    <div class="card2">
      <form class="form" action="login.php" method="POST">
      <p id="heading">Login</p>
      <div class="field">
        <input type="text" name="email" class="input-field" placeholder="Email" autocomplete="off">
      </div>
      <div class="field">
        <input type="password" name="password" class="input-field" placeholder="Senha"  > 
      </div>
      <div class="btn">
      <button class="button1">Login</button>
      </form>
      <a href="registo.php" class="button2">Registo</a>
      </div>
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
</body>
</html>
