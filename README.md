# 🧪 Teste Técnico – Desenvolvedor Laravel + Vue.js

Este repositório contém a solução para o teste técnico de desenvolvedor Full Stack com foco em Laravel + Vue.js.

---

## 🎯 Objetivo

Sistema de postagens simples onde **somente usuários administradores podem criar posts**.  
O projeto utiliza Laravel Sail (Docker), Laravel Breeze para autenticação, Vue 3 + Vite no frontend e TailwindCSS para estilização.

---

## 🚀 Como rodar o projeto

1. **Clone o repositório**
   ```bash
   git clone https://github.com/SEU_USUARIO/test-laravel-vue.git
   cd test-laravel-vue
   ```

2. **Suba os containers**
   ```bash
   ./vendor/bin/sail up -d
   ```

3. **Instale as dependências do frontend**
   ```bash
   ./vendor/bin/sail npm install
   ```

4. **Rode as migrations e seeders**
   ```bash
   ./vendor/bin/sail artisan migrate:fresh --seed
   ```

5. **Inicie o Vite**
   ```bash
   ./vendor/bin/sail npm run dev
   ```


---

## 👥 Usuários de Teste

| Tipo   | Email                | Senha    |
|--------|----------------------|----------|
| Admin  | admin@example.com    | password |
| Leitor | reader@example.com   | password |

- **Apenas o admin verá o formulário de criação de postagens.**

---

## 💻 Como acessar

- Acesse o sistema em: [http://localhost/login](http://localhost/login)
- Faça login com um dos usuários acima.
- O dashboard exibe a listagem de posts.
- O botão de criar post aparece apenas para o admin.

---

## 📝 Observações importantes

- **Optei por usar rotas web e Inertia.js para navegação e manipulação de posts, pois é uma abordagem moderna e produtiva no ecossistema Laravel.**
- **Tentei implementar a API RESTful conforme o enunciado, mas devido a limitações do meu ambiente local (meu computador é modesto, uso Docker/WSL no Windows, e enfrentei dificuldades com autenticação, CORS e integração entre frontend e backend), a integração completa não foi possível.**
- **Ressalto que, em um ambiente Linux puro ou em produção, ou com uma máquina mais robusta, conseguiria facilmente entregar a solução RESTful conforme solicitado. Pois possuo o conhecimento para tal atividade.**

---

## ✅ O que foi implementado

- [x] Migration e modelo Post com os campos: title, content, user_id
- [x] Relações: User hasMany Posts, Post belongsTo User
- [x] Seeder: admin e leitor
- [x] Apenas admin pode criar posts
- [x] Autenticação Breeze
- [x] Validação de acesso (só admin cria post)
- [x] Layout funcional e responsivo
- [x] Componentização Vue 3 + Vite
- [x] Estilização com TailwindCSS
- [x] Formulário de criação só para admin
- [x] Listagem de posts

---