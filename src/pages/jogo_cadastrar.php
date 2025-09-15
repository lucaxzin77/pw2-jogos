<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Jogo.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $data_lanc = $_POST['data_lanc'] ?? '';
        $genero = $_POST['genero'] ?? '';
        $dev = $_POST['dev'] ?? '';

        $jogo = new Jogo($conn);
        $jogo->titulo = $titulo;
        $jogo->data_lanc = $data_lanc;
        $jogo->genero = $genero;
        $jogo->dev = $dev;
        $resultado = $jogo->cadastrar();
    }
?>
    <div class="form-container">
        <h1>Cadastrar Jogo</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="data_lanc">Data Lançamento:</label>
                <input type="date" id="data_lanc" name="data_lanc" required>
            </div>
            <div class="form-group">
                <label for="genero">Genero:</label>
                <input type="text" id="genero" name="genero" required>
            </div>
            <div class="form-group">
                <label for="dev">Desenvolvedor:</label>
                <input type="text" id="dev" name="dev" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar jogo</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Jogo cadastrado com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao cadastrar jogo. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
