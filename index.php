<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $idade = $_POST["idade"];
    $formacao = $_POST["formacao"];
    $habilidades = $_POST["habilidades"];
    $experiencias = $_POST["experiencia"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Gerador de Currículo - Victor Serpeloni</title>
<style>
* {box-sizing: border-box;}
body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #e3f2fd, #ffffff); margin: 0; padding: 0; color: #333; }
header { background-color: #0d6efd; color: white; padding: 15px 30px; font-size: 20px; font-weight: 600; position: sticky; top: 0; z-index: 10; box-shadow: 0 2px 10px rgba(0,0,0,0.1);}
.container { display: flex; justify-content: center; align-items: flex-start; gap: 30px; padding: 40px; flex-wrap: wrap; }
form { flex: 1; min-width: 350px; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); animation: fadeIn 0.6s ease-in; }
h2 { color: #0d6efd; margin-bottom: 20px; text-align: center; }
label { display: block; margin-top: 12px; font-weight: 500; }
input, textarea {width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; margin-top: 5px; transition: 0.2s; font-size: 15px; }
input:focus, textarea:focus {border-color: #0d6efd; outline: none; box-shadow: 0 0 4px #0d6efd55; }
button { margin-top: 20px; background: #0d6efd; color: white; border: none; padding: 12px 20px; border-radius: 10px; font-size: 16px; cursor: pointer; transition: 0.3s; }
button:hover { background: #084298; }
.add-btn { background-color: #198754; margin-top: 10px; }
.add-btn:hover { background-color: #126b43; }
.curriculo {flex: 1; min-width: 350px; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); animation: fadeIn 0.8s ease-in; }
.curriculo h2 { text-align: center; color: #0d6efd; }
.curriculo section { margin-top: 20px; }
.curriculo h3 { color: #084298; border-bottom: 2px solid #0d6efd; padding-bottom: 4px; }
.botoes { text-align: center; margin-top: 20px; }
.pdf-btn { background: #dc3545; }
.pdf-btn:hover { background: #a71d2a; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
@media print {header, form,.botoes { display: none; } body { background: white; }.curriculo { box-shadow: none; border: none; width: 100%; } }

/* Tela Inicial */
#tela-inicial { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, #0d6efd, #42a5f5); display: flex; justify-content: center; align-items: center; flex-direction: column; color: white; text-align: center; z-index: 20; }
#tela-inicial h1 { font-size: 36px; margin-bottom: 20px; }
#tela-inicial p { font-size: 18px; margin-bottom: 30px; }
#tela-inicial button { padding: 15px 30px; font-size: 18px; border-radius: 10px; border: none; cursor: pointer; background-color: #ffc107; color: #333; transition: 0.3s; }
#tela-inicial button:hover { background-color: #e0a800; }
</style>
</head>
<body>

<!-- Tela Inicial -->
<div id="tela-inicial">
    <h1>Bem-vindo ao Gerador de Currículo</h1>
    <p>Preencha suas informações e gere seu currículo profissional de forma rápida e prática!</p>
    <button onclick="iniciar()">Começar</button>
</div>

<header>📄 Gerador de Currículo Profissional</header>
<div class="container">
<form method="POST" action="">
    <h2>Preencha suas informações</h2>
    <label>Nome Completo:</label>
    <input type="text" name="nome" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Telefone:</label>
    <input type="text" name="telefone" required>
    <label>Endereço:</label>
    <input type="text" name="endereco" required>
    <label>Idade:</label>
    <input type="number" name="idade" required>
    <label>Formação Acadêmica:</label>
    <textarea name="formacao" rows="3" required></textarea>
    <label>Experiências Profissionais:</label>
    <div id="experiencias">
        <textarea name="experiencia[]" rows="3" placeholder="Cargo, empresa, período..." required></textarea>
    </div>
    <button type="button" class="add-btn" onclick="adicionarExperiencia()">+ Adicionar Experiência</button>
    <label>Habilidades:</label>
    <textarea name="habilidades" rows="3" placeholder="Ex: HTML, CSS, PHP, Trabalho em equipe..." required></textarea>
    <button type="submit">Gerar Currículo</button>
</form>

<?php if (!empty($nome)): ?>
<div class="curriculo" id="curriculo">
    <h2><?= htmlspecialchars($nome)?></h2>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($email)?></p>
    <p><strong>Telefone:</strong> <?= htmlspecialchars($telefone)?></p>
    <p><strong>Endereço:</strong> <?= htmlspecialchars($endereco)?></p>
    <p><strong>Idade:</strong> <?= htmlspecialchars($idade)?> anos</p>
    <section>
        <h3>Formação</h3>
        <p><?= nl2br(htmlspecialchars($formacao))?></p>
    </section>
    <section>
        <h3>Experiências Profissionais</h3>
        <ul>
        <?php foreach ($experiencias as $exp): ?>
            <li><?= nl2br(htmlspecialchars($exp))?></li>
        <?php endforeach; ?>
        </ul>
    </section>
    <section>
        <h3>Habilidades</h3>
        <p><?= nl2br(htmlspecialchars($habilidades)) ?></p>
    </section>
    <div class="botoes">
        <button class="pdf-btn" onclick="window.print()">📄 Baixar PDF</button>
    </div>
</div>
<?php endif; ?>
</div>

<script>
function adicionarExperiencia() {
    const container = document.getElementById('experiencias');
    const novaExp = document.createElement('textarea');
    novaExp.name = 'experiencia[]';
    novaExp.rows = 3;
    novaExp.placeholder = "Cargo, empresa, período...";
    novaExp.required = true;
    novaExp.style.marginTop = '10px';
    container.appendChild(novaExp);
}

// Função para iniciar o formulário a partir da tela inicial
function iniciar() {
    document.getElementById('tela-inicial').style.display = 'none';
}
</script>

</body>
</html>
