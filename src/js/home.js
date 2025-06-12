document.querySelector('form').addEventListener('submit', function (e) {
        const nome = document.getElementById('nome').value.trim();
        const email = document.getElementById('email').value.trim();
        const senha = document.getElementById('senha').value;
        const senhaConfirm = document.getElementById('senha_confirm').value;
        let erros = [];

        if (nome === '') erros.push("Preencha o nome.");
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) erros.push("Email inválido.");
        if (senha.length < 6) erros.push("Senha deve ter no mínimo 6 caracteres.");
        if (senha !== senhaConfirm) erros.push("As senhas não conferem.");

        if (erros.length > 0) {
            e.preventDefault();
            alert(erros.join('\n'));
        }
    });