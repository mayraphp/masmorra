# ⚔️ Masmorra de Turno

RPG de navegador por turnos, feito com **Laravel 13** e **Vue 3**, com tema de fantasia medieval.

Projeto de estudo: o objetivo principal é aprender Vue do zero enquanto o jogo é construído, tela por tela.

## 🎮 O jogo

O jogador cria um herói, entra na masmorra, enfrenta monstros em combate por turnos, ganha XP e ouro, sobe de nível e equipa itens.

### Classes

| Classe | Estilo | Passiva |
|---|---|---|
| 🛡️ Cavaleiro | Forte e constante | Reduz 20% de todo dano recebido |
| 🔮 Mago | Canhão de vidro | Dano ×1.3 e ignora metade da defesa |
| 🗡️ Ladino | Crítico e esquiva | Crítico causa ×2.5 |

### Monstros

Do mais fraco para o mais forte: **Gosma → Esqueleto → Fantasma → Mago Corrompido**.

### Inventário

Inspirado em Path of Exile: slots fixos de equipamento (arma, capacete, luvas, calça e botas) e mochila em grade, onde cada item ocupa um tamanho diferente.

## 🛠️ Stack

- **Backend:** Laravel 13 (PHP 8.4)
- **Frontend:** Vue 3 + Vite *(em construção)*
- **Banco:** MySQL 8.4
- **Ambiente:** Docker (PHP-FPM + Nginx + MySQL), sem Sail

## 🚀 Como rodar

Pré-requisito: Docker e Docker Compose.

```bash
# Clonar o repositório
git clone git@github.com:mayraphp/masmorra.git
cd masmorra

# Configurar o ambiente
cp .env.example .env
```

No `.env`, ajuste o banco:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=rpg
DB_USERNAME=rpg
DB_PASSWORD=secret
```

```bash
# Subir os containers
docker compose up -d --build

# Instalar dependências, gerar a chave e popular o banco
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

Acesse em **http://localhost:8000**.

> O MySQL fica exposto na porta **3307** do host, para não conflitar com um MySQL local.

## 🗺️ Roadmap

- [x] Ambiente Docker
- [x] Migrations, models e seeders (classes, monstros e itens)
- [x] Tela de start
- [ ] Setup do Vue + Vite
- [ ] Criação de personagem
- [ ] Taverna (hub) e navegação
- [ ] Combate por turnos
- [ ] Loja
- [ ] Inventário em grade com arrastar e soltar

## 📄 Licença

Projeto pessoal de estudo.