# 🧙‍♂️ El Hobbyte – Desafío 1 (PHP)  
📚 **2º CFGS DAW – Desarrollo Web en Entorno Servidor**  
🏫 *CIFP Virgen de Gracia*  

---

## 🎮 Descripción del juego
"El Hobbyte" es un pequeño juego inspirado en el universo de Tolkien, con un toque de humor.  
Sí, sí, es un chiste: ¿qué son 8 hobbits? Pues eso… ¡El hobbyte! 😅  

El reto consiste en desarrollar un servicio en **PHP** que permita gestionar partidas, héroes y usuarios, tanto en su faceta de **jugadores** como de **administradores**.  

---

## ✨ Mecánicas del juego
- **Personajes principales**:
  - 🧙‍♂️ Gandalf → Pruebas de magia (máx. 50 poder).  
  - ⚔️ Thorin → Pruebas de fuerza (máx. 50 poder).  
  - 🧝 Bilbo → Pruebas de habilidad (máx. 50 poder).  

- **Tablero**:
  - 20 casillas → cada una contiene una prueba aleatoria (magia, fuerza o habilidad).  
  - Niveles de esfuerzo posibles: `5, 10, 15, 20, 25, 30, 35, 40, 45, 50`.  
  - Probabilidades:  
    - 65% → esfuerzos de 5 a 20  
    - 30% → esfuerzos de 25 a 40  
    - 5% → esfuerzos de 45 a 50  

- **Resolución de pruebas**:
  - Poder > esfuerzo → éxito al 90%.  
  - Poder = esfuerzo → éxito al 70%.  
  - Poder < esfuerzo → éxito al 50%.  
  - Si falla → el héroe queda inactivo.  
  - Si tiene éxito → pierde el poder gastado.  

- **Condiciones de victoria y derrota**:
  - ✅ Ganas → si se destapan la mitad de las casillas **y sobrevive al menos un héroe**.  
  - ❌ Pierdes → si todos los héroes mueren o se pierden 5 pruebas seguidas.  

---

## 👥 Roles de usuario
- **Administrador** 👑  
  - Gestiona usuarios (altas, bajas, modificaciones, roles).  
  - Puede jugar como un jugador más.  
  - Ruta especial: `/admin` (CRUD + gestión de roles).  

- **Jugador** 🎲  
  - Puede tener hasta 2 partidas abiertas.  
  - Siempre juega contra la máquina.  
  - Rutas principales:  
    - `/user` → gestión de perfil, contraseña y estadísticas.  
    - `/gamer` → gestión de partidas (crear, jugar, rendirse).  

---

## 🛠️ Funcionalidades clave
- Crear partida estándar (20 casillas) o personalizada.  
- Destapar casillas → informar del resultado, estado de héroes y progreso de partida.  
- Rendirse → mostrar tablero y héroes tal como quedan.  
- Gestión de errores → control de partidas activas, casillas válidas, estado de héroes.  
- Servicio RESTful → con rutas claras, verbos y códigos estándar.  

---

## 📊 Valoraciones del proyecto
- ✅ Diseño de base de datos completo y correcto.  
- ✅ Cumplimiento de requisitos del enunciado.  
- ✅ Planificación de tareas con metodología **SCRUM**.  
- ✅ Sincronización en **GitHub** (repositorio + project board).  
- ✅ Buen uso de rutas, verbos y respuestas estándar.  
- ✅ Código organizado y uso adecuado de patrones de diseño.  

---

## 🚀 Metodología de trabajo (SCRUM)
- **Roles**:
  - Product Owner → define requisitos y backlog.  
  - Scrum Master → facilita y organiza el trabajo.  
  - Team → equipo de desarrollo.  

- **Sprints**:
  - Planificación → selección de tareas del backlog.  
  - Daily meetings → seguimiento del avance (10 min).  
  - Retrospectiva → análisis de mejoras.  
  - Demo → presentación de lo completado.  

- **Herramientas**:
  - GitHub Projects → tablero de tareas.  
  - Issues & Commits → control de avances.  

---

## ⚔️ Tecnologías utilizadas
- **PHP** (lógica del servidor).  
- **MySQL / MariaDB** (base de datos).  
- **Git & GitHub** (control de versiones y gestión del proyecto).  

---

## 📌 Ejemplo de rutas
- `POST /user/register` → crear usuario.  
- `POST /user/login` → iniciar sesión.  
- `GET /gamer/start` → iniciar partida.  
- `PUT /gamer/cell/:id` → destapar casilla.  
- `POST /gamer/surrender` → rendirse.  
- `GET /admin/users` → listado de usuarios.  
- `PUT /admin/user/:id/role` → cambiar rol de usuario.  

---

## 🧾 Licencia
Proyecto académico para el módulo **Desarrollo Web en Entorno Servidor**.  
Uso exclusivo para fines educativos.  

---

## 👨‍💻 Autores
📌 *2º CFGS DAW – CIFP Virgen de Gracia*  
📅 Curso 2024/2025  
