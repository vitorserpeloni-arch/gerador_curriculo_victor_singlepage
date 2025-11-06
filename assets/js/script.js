// assets/js/script.js - Renderiza o currículo na mesma página
document.addEventListener('DOMContentLoaded', function() {
  const nascimento = document.getElementById('nascimento');
  const idadeInput = document.getElementById('idade');
  const addExpBtn = document.getElementById('addExp');
  const experiencias = document.getElementById('experiencias');
  const gerarBtn = document.getElementById('gerarBtn');
  const limparBtn = document.getElementById('limparBtn');
  const cvPreview = document.getElementById('cvPreview');
  const emptyPreview = document.getElementById('emptyPreview');
  const printBtn = document.getElementById('printBtn');
  const editarBtn = document.getElementById('editarBtn');
  const form = document.getElementById('cvForm');

  function calcIdade(value){
    if(!value) return '';
    const dataNasc = new Date(value);
    const hoje = new Date();
    let idade = hoje.getFullYear() - dataNasc.getFullYear();
    const m = hoje.getMonth() - dataNasc.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < dataNasc.getDate())) {
      idade--;
    }
    return idade;
  }

  if(nascimento){
    nascimento.addEventListener('change', function(){
      idadeInput.value = calcIdade(this.value);
    });
  }

  addExpBtn.addEventListener('click', function(){
    const block = document.createElement('div');
    block.className = 'experiencia space-y-2 pb-2 border-b mt-2';
    block.innerHTML = '<input type="text" class="empresa w-full border rounded px-2 py-1" placeholder="Empresa">'
                    + '<input type="text" class="cargo w-full border rounded px-2 py-1" placeholder="Cargo">'
                    + '<textarea class="descricao w-full border rounded px-2 py-1" placeholder="Descrição"></textarea>'
                    + '<div class="text-right"><button type="button" class="removeExp text-xs text-red-600 mt-1">Remover</button></div>';
    experiencias.appendChild(block);
    block.querySelector('.removeExp').addEventListener('click', function(){ block.remove(); });
  });

  gerarBtn.addEventListener('click', function(e){
    e.preventDefault();
    // coleta dados
    const nome = document.getElementById('nome').value.trim();
    const nasc = document.getElementById('nascimento').value;
    const idade = document.getElementById('idade').value;
    const email = document.getElementById('email').value.trim();
    const formacao = document.getElementById('formacao').value.trim();
    const habilidades = document.getElementById('habilidades').value.trim();
    // experiencias
    const empresas = Array.from(document.querySelectorAll('.empresa')).map(i=>i.value.trim()).filter(v=>v);
    const cargos = Array.from(document.querySelectorAll('.cargo')).map(i=>i.value.trim());
    const descricoes = Array.from(document.querySelectorAll('.descricao')).map(i=>i.value.trim());

    // montagem do CV (HTML simples e minimalista)
    let html = '';
    html += '<div class="p-4">';
    html += '<header class="mb-3">';
    html += '<h2 class="text-xl font-semibold">' + escapeHtml(nome) + '</h2>';
    html += '<p class="text-sm text-slate-600">' + escapeHtml(email) + (idade ? ' · ' + escapeHtml(idade) + ' anos' : '') + '</p>';
    html += '</header>';
    if(formacao){ html += '<section><h3 class="font-medium">Formação</h3><p>' + nl2br(escapeHtml(formacao)) + '</p></section>'; }
    if(empresas.length){
      html += '<section class="mt-3"><h3 class="font-medium">Experiência Profissional</h3><ul class="list-disc list-inside">';
      for(let i=0;i<empresas.length;i++){
        if(empresas[i]){
          html += '<li><strong>' + escapeHtml(empresas[i]) + '</strong>' + (cargos[i] ? ' - ' + escapeHtml(cargos[i]) : '') + '<br>' + (descricoes[i] ? nl2br(escapeHtml(descricoes[i])) : '') + '</li>';
        }
      }
      html += '</ul></section>';
    }
    if(habilidades){ html += '<section class="mt-3"><h3 class="font-medium">Habilidades</h3><p>' + escapeHtml(habilidades) + '</p></section>'; }
    html += '</div>';

    cvPreview.innerHTML = html;
    cvPreview.classList.remove('hidden');
    emptyPreview.classList.add('hidden');
    printBtn.classList.remove('hidden');
    editarBtn.classList.remove('hidden');

    // show print in no-print? print button visible
    printBtn.addEventListener('click', function(){ window.print(); });
    editarBtn.addEventListener('click', function(){ cvPreview.classList.add('hidden'); emptyPreview.classList.remove('hidden'); printBtn.classList.add('hidden'); editarBtn.classList.add('hidden'); });
  });

  limparBtn.addEventListener('click', function(){ form.reset(); idadeInput.value=''; });

  function nl2br(str){ return str.replace(/\n/g, '<br>'); }
  function escapeHtml(text){ if(!text) return ''; return text.replace(/[&"'<>]/g, function (a) { return {'&':'&amp;','"':'&quot;',"'":"&#39;",'<':'&lt;','>':'&gt;'}[a]; }); }
});
