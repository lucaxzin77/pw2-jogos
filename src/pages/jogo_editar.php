<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Jogo.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? '';
        $data_lanc = $_POST['data_lanc'] ?? '';
        $genero = $_POST['genero'] ?? '';
        $dev = $_POST['dev'] ?? '';

        $jogo = new Jogo($conn);
        $jogo->id = $id;
        $jogo->titulo = $titulo;
        $jogo->data_lanc = $data_lanc;
        $jogo->genero = $genero;
        $jogo->dev = $dev;
        $resultado = $jogo->editar();
    }

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de jogo inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $jogo = new Jogo($conn);
    $jogo_atual = $jogo->consultarPorId( $id);

    if (!$jogo_atual) {
        echo '<p style="color: red; text-align: center;">Jogo não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de jogos</a></p>';
        exit;
    }
    
?>
    
    <div class="form-container">
        <h1>Editar jogo</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($jogo_atual['id']); ?>">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($jogo_atual['titulo']) ?>" required>
            </div>
            <div class="form-group">
                <label for="data_lanc">Data Lançamento:</label>
                <input id="data_lanc" type="date" name="data_lanc" required><?php echo htmlspecialchars($jogo_atual['data_lanc']); ?></input>
            </div>
            <div class="form-group">
                <label for="genero">Genero:</label>
                <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($jogo_atual['genero']) ?>" required>
            </div>
            <div class="form-group">
                <label for="dev">Desenvolvedor:</label>
                <input type="text" id="dev" name="dev" value="<?php echo htmlspecialchars($jogo_atual['dev']) ?>" required>
            </div>
            <div class="form-group">
                <button type="submit">Editar jogo</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Jogo alterado com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao alterar jogo. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
