<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html?error=access_denied");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mind Sync Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Estilos básicos */
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: url('fundo3.jpeg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .main-container {
            display: flex;
            flex: 1;
            background: rgba(255, 255, 255, 0.85);
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #013104;
            color: white;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .sidebar.hidden {
            width: 0;
        }

        .sidebar header {
            font-size: 22px;
            text-align: center;
            line-height: 70px;
            background: #022004;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar ul li a:hover {
            background: #057a55;
        }

        .submenu-item {
            padding-left: 40px;
            font-size: 16px;
        }

        /* Conteúdo principal */
        .content {
            flex: 1;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .content iframe {
            flex: 1;
            width: 100%;
            height: calc(100vh - 40px);
            border: none;
        }

        .content h2 {
            padding: 20px;
            margin: 0;
            background: #f8f9fa;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        /* Botão de alternância da sidebar */
        .toggle-sidebar {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #013104;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 18px;
            z-index: 200;
            border-radius: 5px;
        }

        .toggle-sidebar:hover {
            background: #057a55;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <header>Mind Sync</header>
            <ul>
                <li><a href="#atendimento"><i class="fas fa-phone"></i> Atendimento</a></li>
                <li><a href="#planilha"><i class="fas fa-stream"></i> Agendamento</a></li>
                <li><a href="#pacientes"><i class="fas fa-calendar-week"></i> Pacientes</a></li>
                <li><a href="#financas"><i class="far fa-envelope"></i> Financeiro</a></li>
                <li>
                    <a href="#" id="profileToggle"><i class="bi bi-person-circle"></i> Perfil</a>
                </li>
                <li class="submenu-item" style="display: none;">
                    <a href="#editperfil" id="editProfileBtn"><i class="bi bi-person-fill-gear"></i> Editar perfil</a>
                </li>
                <li class="submenu-item" style="display: none;">
                    <a href="logout.php" id="logoutBtn"><i class="bi bi-box-arrow-left"></i> Sair</a>
                </li>
            </ul>
        </div>

        <!-- Conteúdo principal -->
        <div class="content">
            <h2 id="pageTitle">Atendimento</h2>
            <iframe id="mainContent" src="agendamento.html"></iframe>
        </div>
    </div>

    <button class="toggle-sidebar" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const submenuItems = document.querySelectorAll(".submenu-item");
        const toggleSidebar = document.getElementById('toggleSidebar');
        const profileToggle = document.getElementById("profileToggle");
        const mainContent = document.getElementById('mainContent');
        const pageTitle = document.getElementById('pageTitle');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        profileToggle.addEventListener("click", function (event) {
            event.preventDefault();
            submenuItems.forEach(item => {
                item.style.display = item.style.display === "none" ? "block" : "none";
            });
        });

        document.addEventListener("click", function (event) {
            if (!profileToggle.contains(event.target) && !Array.from(submenuItems).some(item => item.contains(event.target))) {
                submenuItems.forEach(item => {
                    item.style.display = "none";
                });
            }
        });

        document.querySelectorAll('.sidebar ul li a[href^="#"]').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const sectionId = this.getAttribute('href').substring(1);
                let page = "";
                let title = "";
                switch (sectionId) {
                    case "atendimento":
                        page = "agendamento.html";
                        title = "Atendimento";
                        break;
                    case "planilha":
                        page = "planilha.html";
                        title = "planilha";
                        break;
                    case "pacientes":
                        page = "list.html";
                        title = "Pacientes";
                        break;
                    case "financeiro":
                        page = "financeiro.html";
                        title = "Financeiro";
                        break;
                    case "editperfil":
                        page = "editperfil.html";
                        title = "Editar Perfil";
                        break;
                    case "financas":
                        page = "financas.html";
                        title = "Finanças";
                        break;
                }
                mainContent.src = page;
                pageTitle.textContent = title;
            });
        });

    </script>
</body>

</html>
