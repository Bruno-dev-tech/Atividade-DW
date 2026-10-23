<?php 
/*
* Código de exemplo da utilização de PDO como persistencia
* Página reponsável pelo formulário de cadastro da entidade Pessoa
* @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
* @version 0.1
*
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?php include 'cabecalho.php'; ?>
<?php
include "pessoa_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">

        <form action="pessoa_acao.php" method="post">
            <fieldset>
                <legend>Cadastro de Pessoas</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="data_vencimento">data_vencimento</label>
                <input type="text" size="40" name="data_vencimento" id="data_vencimento" value="<?php if ($id != 0)
                    echo $dados['data_vencimento']; ?>" required><br>

                <label for="data_emissao">data_emissao</label>
                <input type="number" name="data_emissao" id="data_emissao" value="<?php if ($id != 0)
                    echo $dados['data_emissao']; ?>"><br>

                <label for="data_pagamento">data_pagamento</label>
                <input type="text" name="data_pagamento" id="data_pagamento" value="<?php if ($id != 0)
                    echo $dados['data_pagamento']; ?>"><br>

                    
                <label for="valor">valor</label>
                <input type="text" name="valor" id="valor" value="<?php if ($id != 0)
                    echo $dados['valor']; ?>"><br>

                    
                <label for="desconto">desconto</label>
                <input type="text" name="desconto" id="desconto" value="<?php if ($id != 0)
                    echo $dados['desconto']; ?>"><br>

                    <label for="juros">juros</label>
                <input type="number" name="juros" id="juros" value="<?php if ($id != 0)
                    echo $dados['juros']; ?>"><br>

                <label for="multa">multa</label>
                <input type="text" name="multa" id="multa" value="<?php if ($id != 0)
                    echo $dados['multa']; ?>"><br>

                    
                <label for="mora">mora</label>
                <input type="text" name="mora" id="mora" value="<?php if ($id != 0)
                    echo $dados['mora']; ?>"><br>

                    
                <label for="valor_pago"> valor_pago</label>
                <input type="text" name="valor_pago" id="valor_pago" value="<?php if ($id != 0)
                    echo $dados['valor_pago']; ?>"><br>

                <input class="primary" type="submit" name="acao" id="acao" value="<?php if ($id == 0)
                    echo "Salvar";
                else
                    echo "Alterar";
                ?>">
                <input type="reset" value="Cancelar" />

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>