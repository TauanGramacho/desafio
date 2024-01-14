<?php

class Produto {
    protected $nome;
    protected $preco;
    protected $quantidade;

    public function setProduto($data) {
        // Verifica se o array $data possui todas as chaves necessárias e se os valores não são vazios
        if (isset($data['nome'], $data['preco'], $data['quantidade']) && $data['nome'] !== '' && $data['preco'] !== '' && $data['quantidade'] !== '') {
            $this->nome = $data['nome'];
            $this->preco = $data['preco'];
            $this->quantidade = $data['quantidade'];
            echo "Produto cadastrado com sucesso!\n";
        } else {
            echo "Erro ao cadastrar produto. Informações incompletas ou inválidas.\n";
        }
    }
    

    public function getProduto() {
        // Exibe as informações do produto atualmente cadastrado
        echo "Nome: {$this->nome}\n";
        echo "Preço: {$this->preco}\n";
        echo "Quantidade: {$this->quantidade}\n";
    }
}

class Venda extends Produto {
    private $quantidadeVendida = 0; // Inicializa com 0 por padrão
    private $desconto = 0.0; // Inicializa com 0.0 por padrão

    public function setVenda($quantidadeVendida, $desconto) {
        // Chama setProduto apenas se o produto ainda não estiver cadastrado
        if (empty($this->nome)) {
            $this->setProduto(['nome' => 'Produto Padrão', 'preco' => 0.0, 'quantidade' => 0]);
        }
    
        // Verifica se há estoque suficiente para a venda
        if ($this->quantidade >= $quantidadeVendida) {
            $this->quantidade -= $quantidadeVendida; // Atualiza o estoque
            $this->quantidadeVendida = $quantidadeVendida;
            $this->desconto = $desconto;
            echo "Venda registrada com sucesso!\n";
        } else {
            echo "Erro ao registrar venda. Estoque insuficiente.\n";
            // Remover as linhas abaixo se não quiser cadastrar o Produto Padrão em caso de erro
            $this->setProduto(['nome' => 'Produto Padrão', 'preco' => 0.0, 'quantidade' => 0]);
            $this->quantidadeVendida = 0; // Zera a quantidade vendida
            $this->desconto = 0.0; // Zera o desconto
        }
    }
    

    public function getVenda() {
        // Exibe as informações da última venda registrada
        echo "Última venda registrada:\n";
        echo "Nome: {$this->nome}\n";
        echo "Quantidade vendida: {$this->quantidadeVendida}\n";
        echo "Desconto aplicado: {$this->desconto}\n";
        echo "Estoque atual: {$this->quantidade}\n";
    }
}



// Exemplo de uso:

$produto = new Produto();
$produto->setProduto(['nome' => 'Produto A', 'preco' => 10.0, 'quantidade' => 50]);
$produto->getProduto();

$venda = new Venda();
$venda->setVenda(10, 2.0);
$venda->getVenda();
$produto->getProduto(); // Atualiza o estoque do produto após a venda

?>
