<?php
/*
 * Código de exemplo da utilização de PDO como persistencia
 * Classe abstrata para persistencia de Pessoa
 * @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
 * @version 0.1
 *
 */
include_once __DIR__ . "/PessoaDAO.php";
class PDOPessoaDAO extends PessoaDAO
{
    private static $instance = NULL;
    private $conn = NULL;
    function PDOPessoaDAO()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDOPessoaDAO();        
        return self::$instance;
    }

    /*
     * Método faz a conexao com o recurso usado
     * @return void
     */
    function connect()
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
        }
    
    }
    /*
     * Método que insere dados no sistema de persistencia
     * @param $objeto Pessoa objeto que será inserido 
     * @return void
     */
  function inserir($objeto)
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('INSERT INTO boleto (data_vencimento, data_emissao, data_pagamento, valor, desconto, juros, multa, mora, valor_pago) 
                 VALUES (:data_vencimento, :data_emissao, :data_pagamento, :valor, :desconto, :juros, :multa, :mora, :valor_pago)');
            $stmt->execute(
                array(
                    ':data_vencimento' => $objeto->data_vencimento,
                    ':data_emissao' => $objeto->data_emissao,
                    ':data_pagamento' => $objeto->data_pagamento,
                    ':valor' => $objeto->valor,
                    ':desconto' => $objeto->desconto,
                    ':juros' => $objeto->juros,
                    ':multa' => $objeto->multa,
                    ':mora' => $objeto->mora,
                    ':valor_pago' => $objeto->valor_pago
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            // Dica: Comente temporariamente o header no salvar() se quiser ver este erro na tela
            print 'Error: ' . $e->getMessage();
            exit; // Para a execução para você conseguir ler o erro se ocorrer novamente
        }
    }
    /*
     * Método que altera dados no sistema de persistencia
     * @param $objeto Pessoa objeto que será inserido 
     * @return void
     */
    function alterar($objeto)
    {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('UPDATE boleto SET 
                data_vencimento = :data_vencimento,
                data_emissao = :data_emissao,
                data_pagamento = :data_pagamento,
                valor = :valor,
                desconto = :desconto,
                juros = :juros,
                multa = :multa,
                mora = :mora,
                valor_pago = :valor_pago 
                WHERE id = :id');
            
            $stmt->execute(
                array(
                    ':id' => $objeto->id,
                    ':data_vencimento' => $objeto->data_vencimento,
                    ':data_emissao' => $objeto->data_emissao,
                    ':data_pagamento' => $objeto->data_pagamento,
                    ':valor' => $objeto->valor,
                    ':desconto' => $objeto->desconto,
                    ':juros' => $objeto->juros,
                    ':multa' => $objeto->multa,
                    ':mora' => $objeto->mora,
                    ':valor_pago' => $objeto->valor_pago
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
            exit;
        }
    }
    /*
     * Método que exclui dados no sistema de persistencia
     * @param $id int identificador do registro 
     * @return void
     */
    function excluir($id)
    {
        try {      
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->conn->prepare('DELETE FROM boleto WHERE id=:id');
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }

    }
    /*
     * Método que lista dados no sistema de persistencia
     * @return array array de dados
     */
    function listar()
    {
        $dados = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM boleto");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $boleto = array();
                $boleto['id'] = $linha['id'];
                $boleto['data_vencimento'] = $linha['data_vencimento'];
                $boleto['data_emissao'] = $linha['data_emissao'];
                $boleto['data_pagamento'] = $linha['data_pagamento'];
                 $boleto['valor'] = $linha['valor'];
                  $boleto['desconto'] = $linha['desconto'];

                   $boleto['juros'] = $linha['juros'];
                $boleto['multa'] = $linha['multa'];
                 $boleto['mora'] = $linha['mora'];
                  $boleto['valor_pago'] = $linha['valor_pago'];
                array_push($dados, $boleto);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;

    }
    /* Método que lista dados com filtro no sistema de persistencia
     * @param $filtro String filtro para dados     
     * @return array array de dados
     */
    function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $this->conn->query("SELECT * FROM boleto " + filtro);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
               $boleto = array();
                $boleto['id'] = $linha['id'];
                $boleto['data_vencimento'] = $linha['data_vencimento'];
                $boleto['data_emissao'] = $linha['data_emissao'];
                $boleto['data_pagamento'] = $linha['data_pagamento'];
                 $boleto['valor'] = $linha['valor'];
                  $boleto['desconto'] = $linha['desconto'];

                   $boleto['juros'] = $linha['juros'];
                $boleto['multa'] = $linha['multa'];
                 $boleto['mora'] = $linha['mora'];
                  $boleto['valor_pago'] = $linha['valor_pago'];
                array_push($dados, $boleto);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }


        return $dados;

    }
    /*
     * Método que obtem dados no sistema de persistencia
     * @param $id int identificador do registro 
     * @return array objeto em array
     */
    function obter($id)
    {
        $boleto = array();
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/pessoas.db');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         //   $result = $this->conn->query("SELECT * FROM pessoa WHERE id=?");
             $result = $this->conn->prepare("SELECT * FROM boleto WHERE id=?");
             $result->execute([$id]);

            if ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
               $boleto['id'] = $linha['id'];
                $boleto['data_vencimento'] = $linha['data_vencimento'];
                $boleto['data_emissao'] = $linha['data_emissao'];
                $boleto['data_pagamento'] = $linha['data_pagamento'];
                 $boleto['valor'] = $linha['valor'];
                  $boleto['desconto'] = $linha['desconto'];

                   $boleto['juros'] = $linha['juros'];
                $boleto['multa'] = $linha['multa'];
                 $boleto['mora'] = $linha['mora'];
                  $boleto['valor_pago'] = $linha['valor_pago'];
             
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $boleto;
    }
}
?>