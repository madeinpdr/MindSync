// Seleção dos elementos da página
const pacientForm = document.getElementById("PacientForm");
const pacientTableBody = document.getElementById("PacientTableBody");
let pacientes = JSON.parse(localStorage.getItem("pacientes")) || [];

// Quando o formulário for submetido
pacientForm.addEventListener("submit", (e) => {
  e.preventDefault();

  // Coletando os dados do formulário
  const name = document.getElementById("name").value;
  const date = document.getElementById("date").value;
  const description = document.getElementById("description").value;
  const nextConsult = document.getElementById("nextConsult").value;
  const phone = document.getElementById("phone").value;
  const value = document.getElementById("value").value;
  const status = document.getElementById("status").value;

  // Criando um objeto para o paciente
  const paciente = {
    name,
    date,
    description,
    nextConsult,
    phone,
    value,
    status
  };

  // Adicionando o paciente ao array de pacientes
  pacientes.push(paciente);

  // Salvando a lista de pacientes no localStorage
  localStorage.setItem("pacientes", JSON.stringify(pacientes));

  // Atualizando a tabela com os pacientes
  loadPacientes();

  // Resetando o formulário após adicionar
  pacientForm.reset();
});

// Função para carregar os pacientes da lista e exibir na tabela
function loadPacientes() {
  pacientTableBody.innerHTML = ""; // Limpando a tabela

  // Percorrendo os pacientes e criando as linhas da tabela
  pacientes.forEach((paciente, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${paciente.name}</td>
      <td>${paciente.date}</td>
      <td>${paciente.description}</td>
      <td>${paciente.nextConsult}</td>
      <td>${paciente.phone}</td>
      <td>${paciente.value}</td>
      <td class="status" data-status="${paciente.status}">${paciente.status}</td>
      <td>
        <button class="edit" onclick="editPaciente(${index})">Editar</button>
        <button class="delete" onclick="deletePaciente(${index})">Excluir</button>
      </td>
    `;
    pacientTableBody.appendChild(tr); // Adicionando a linha à tabela
  });
}

// Função para excluir um paciente
function deletePaciente(index) {
  pacientes.splice(index, 1); // Removendo o paciente do array
  localStorage.setItem("pacientes", JSON.stringify(pacientes)); // Atualizando o localStorage
  loadPacientes(); // Atualizando a tabela
}

// Função para editar um paciente
function editPaciente(index) {
  const paciente = pacientes[index]; // Pegando os dados do paciente a ser editado

  // Preenchendo o formulário com os dados do paciente
  document.getElementById("name").value = paciente.name;
  document.getElementById("date").value = paciente.date;
  document.getElementById("description").value = paciente.description;
  document.getElementById("nextConsult").value = paciente.nextConsult;
  document.getElementById("phone").value = paciente.phone;
  document.getElementById("value").value = paciente.value;
  document.getElementById("status").value = paciente.status;

  // Excluindo o paciente antes de editá-lo para evitar duplicação
  deletePaciente(index);
}

// Carregando a lista de pacientes ao carregar a página
loadPacientes();