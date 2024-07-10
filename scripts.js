document.addEventListener("DOMContentLoaded", function() {
    // Carrega o saldo ao carregar a página
    carregarSaldo();

    // Atualiza o saldo após adicionar uma transação
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();
        adicionarTransacao();
    });
});

function carregarSaldo() {
    fetch('carregar_transacoes.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('tabela-transacoes').innerHTML = data;
            atualizarSaldo();
        });
}

function adicionarTransacao() {
    const formData = new FormData(document.querySelector('form'));
    fetch('adicionar_transacao.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        carregarSaldo();
    })
    .catch(error => console.error('Erro:', error));
}

function atualizarSaldo() {
    fetch('carregar_transacoes.php')
        .then(response => response.text())
        .then(data => {
            const totalElement = document.querySelector("#tabela-transacoes tr:last-child td:last-child");
            document.getElementById('saldo').innerText = totalElement.innerText;
        });
}
document.addEventListener("DOMContentLoaded", function() {
    // Carrega o saldo ao carregar a página
    carregarSaldo();

    // Atualiza o saldo após adicionar uma transação
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();
        adicionarTransacao();
    });

    // Adicionar evento ao botão de exportar para PDF
    document.getElementById("btnExportarPDF").addEventListener("click", function() {
        exportarParaPDF();
    });
});

