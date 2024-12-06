// Variáveis de controle de status
let pendentesCount = 0;
let marcadosCount = 0;
let terminadosCount = 0;

// Array para armazenar os agendamentos
let agendamentos = [];

// Função para atualizar os contadores de status
function atualizarStatus() {
    document.getElementById('pendentes-count').textContent = pendentesCount;
    document.getElementById('marcados-count').textContent = marcadosCount;
    document.getElementById('terminados-count').textContent = terminadosCount;
}

// Função para adicionar agendamento
function adicionarAgendamento(nome, data, descricao) {
    const agendamento = {
        nome: nome,
        data: data,
        descricao: descricao,
        status: 'Pendente' // Status inicial
    };

    agendamentos.push(agendamento);
    pendentesCount++;
    atualizarStatus();
    exibirListaAgendamentos(); // Atualiza a lista de agendamentos após adicionar
}

// Função para exibir a lista de agendamentos na página de lista
function exibirListaAgendamentos() {
    const listaAgendamentos = document.getElementById('lista-agendamentos');
    listaAgendamentos.innerHTML = '';
    
    agendamentos.forEach(function(agendamento, index) {
        let li = document.createElement('li');
        li.textContent = `${agendamento.nome} - ${agendamento.data} - ${agendamento.descricao} (${agendamento.status})`;

        // Botões de Aprovar e Rejeitar para cada agendamento
        let aprovarBtn = document.createElement('button');
        aprovarBtn.textContent = 'Aprovar';
        aprovarBtn.onclick = () => aprovarAgendamento(index);
        
        let rejeitarBtn = document.createElement('button');
        rejeitarBtn.textContent = 'Rejeitar';
        rejeitarBtn.onclick = () => rejeitarAgendamento(index);
        
        li.appendChild(aprovarBtn);
        li.appendChild(rejeitarBtn);
        
        listaAgendamentos.appendChild(li);
    });
}

// Função para aprovar o agendamento
function aprovarAgendamento(index) {
    agendamentos[index].status = 'Marcado';
    marcadosCount++;
    pendentesCount--;
    atualizarStatus();
    exibirListaAgendamentos(); // Atualiza a lista de agendamentos
}

// Função para rejeitar o agendamento
function rejeitarAgendamento(index) {
    agendamentos[index].status = 'Terminado';
    terminadosCount++;
    pendentesCount--;
    atualizarStatus();
    exibirListaAgendamentos(); // Atualiza a lista de agendamentos
}

// Função de agendamento (simula a adição de novo agendamento)
function agendar() {
    const nome = prompt('Informe o nome do agendamento');
    const data = prompt('Informe a data do agendamento');
    const descricao = prompt('Informe a descrição do agendamento');
    
    if (nome && data && descricao) {
        adicionarAgendamento(nome, data, descricao);
    }
}

// Integração do menu lateral
const sidebar = document.querySelector('.sidebar');
const submenuItems = document.querySelectorAll(".submenu-item");
const toggleSidebar = document.getElementById('toggleSidebar');
const profileToggle = document.getElementById("profileToggle");

// Alternar visibilidade do menu lateral
toggleSidebar.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
});

// Alternar submenu de perfil
profileToggle.addEventListener("click", function (event) {
    event.preventDefault();
    submenuItems.forEach(item => {
        item.style.display = item.style.display === "none" ? "block" : "none";
    });
});

// Fechar submenu ao clicar fora
document.addEventListener("click", function (event) {
    if (!profileToggle.contains(event.target) && !Array.from(submenuItems).some(item => item.contains(event.target))) {
        submenuItems.forEach(item => {
            item.style.display = "none";
        });
    }
});

// Funções de ação dos botões (para simular fluxo)
document.getElementById('btn-agendar')?.addEventListener('click', agendar);
document.getElementById('btn-aprovar')?.addEventListener('click', () => {
    if (pendentesCount > 0) {
        aprovarAgendamento(0); // Aprova o primeiro agendamento pendente
    }
});
document.getElementById('btn-rejeitar')?.addEventListener('click', () => {
    if (pendentesCount > 0) {
        rejeitarAgendamento(0); // Rejeita o primeiro agendamento pendente
    }
});

// Inicializar com valores padrão
atualizarStatus();
