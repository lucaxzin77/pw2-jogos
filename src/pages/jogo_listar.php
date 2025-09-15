<title>Listar jogos</title>
    </style>
    <div class="container">
        <h1>Listar jogos</h1>
        <form action="" method="post" class="search-form">
            <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($_POST['buscar'] ?? ''); ?>" placeholder="Buscar jogo...">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Data Lançamento</th>
                <th>Genero</th>
                <th>Desenvolvedor</th>
                <th>Data de Criação</th>
                <th style="width: 120px;">Ação</th>
            </tr>
            <?php
            require_once __DIR__ . '/../data/connection.php';
            require_once __DIR__ . '/../model/Jogo.php';
            // *** Se queiser saber mais, descomente as linhas abaixo para depuração (debugging)
            // var_dump($conn);
            // var_dump(__DIR__ . '/../data/connection.php');
            // var_dump(__DIR__ . '/../model/jogos.php');

            $jogo = new Jogo($conn);
            $lista = $jogo->consultarTodos(htmlspecialchars($_POST['buscar'] ?? ''));

            foreach ($lista as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                echo "<td>" . htmlspecialchars($item['titulo']) . "</td>";
                echo "<td>" . htmlspecialchars($item['data_lanc']) . "</td>";
                echo "<td>" . htmlspecialchars($item['genero']) . "</td>";
                echo "<td>" . htmlspecialchars($item['dev']) . "</td>";
                echo "<td>" . htmlspecialchars($item['data_cad']) . "</td>";
                echo "<td><a href='?page=editar&id=" . $item['id'] . "'>Editar</a> | <a href='?page=deletar&id=" . $item['id'] . "' onclick=\"return confirm('Tem certeza que deseja deletar esta jogo?');\">Deletar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>