# Plan de Arquitectura — Club Sportivo Balnearia

> **Generado por:** Claude (Arquitecto de Software Senior)
> **Fecha:** 2026-02-27
> **Repositorio:** Club-Sportivo-Balnearia-2.0

---

## Stack Tecnológico

| Capa | Tecnología |
|---|---|
| CMS | WordPress 6.x (latest) |
| Gestión deportiva | WP Club Manager (plugin) |
| Tablas visuales | Tableberg (plugin) |
| Contenedores | Docker + docker-compose |
| Base de datos | MySQL 8.0 |
| Servidor web | Apache (imagen oficial `wordpress:latest`) |
| Administración DB | phpMyAdmin |
| PHP | 8.2 (incluido en imagen WordPress) |

---

## Estructura del Proyecto

```
Club-Sportivo-Balnearia-2.0/
├── docker-compose.yml                         ← Orquestación de servicios
├── .env                                       ← Variables de entorno (NO subir a Git)
├── .gitignore
├── PLAN_ARQUITECTURA.md                       ← Este archivo
└── wp-content/
    ├── themes/
    │   └── sportivo-balnearia/               ← Child theme personalizado
    │       ├── style.css
    │       ├── functions.php
    │       ├── assets/
    │       │   ├── css/main.css
    │       │   ├── js/main.js
    │       │   └── images/
    │       └── templates/
    │           ├── page-home.php
    │           ├── page-deporte.php
    │           └── page-futbol.php
    └── plugins/
        ├── wp-club-manager/                   ← Instalar desde panel WP
        └── tableberg/                         ← Instalar desde panel WP
```

---

## FASE 1 — Entorno Docker + Estructura Base

### Puertos de acceso local
| Servicio | URL |
|---|---|
| WordPress | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |

### Comandos de inicio
```bash
# Levantar el entorno completo
docker-compose up -d

# Ver estado de los servicios
docker-compose ps

# Ver logs en tiempo real
docker-compose logs -f wordpress

# Detener los servicios
docker-compose down
```

### Configuración inicial de WordPress (manual)
1. Acceder a `http://localhost:8080`
2. Completar el instalador:
   - **Título del sitio:** Club Sportivo Balnearia
   - **Usuario admin:** `admin_csb`
   - **Idioma:** Español (Argentina)
   - **Zona horaria:** America/Argentina/Cordoba
3. Activar el tema hijo: Apariencia → Temas → Sportivo Balnearia

---

## FASE 2 — Plugins e Integración

### Plugins a instalar (desde Panel WP → Plugins → Añadir nuevo)

| Plugin | Búsqueda en repositorio WP | Propósito |
|---|---|---|
| WP Club Manager | `WP Club Manager` | Gestión deportiva completa |
| Tableberg | `Tableberg` | Tablas visuales en Gutenberg |
| Yoast SEO | `Yoast SEO` | Optimización para buscadores |
| WP Super Cache | `WP Super Cache` | Caché y rendimiento |
| Smush | `Smush` | Optimización de imágenes |
| Contact Form 7 | `Contact Form 7` | Formulario de contacto |
| User Role Editor | `User Role Editor` | Gestión de roles y permisos |

### Configuración de WP Club Manager
- Ajustes → WP Club Manager → Deportes activos: **Fútbol, Básquet, Vóley**
- Temporada activa: año en curso
- Configurar ligas/zonas por deporte

### Rol de usuario "Encargado de Deporte"
Permisos asignados:
- ✅ Editar páginas
- ✅ Cargar medios
- ✅ Acceso a WP Club Manager
- ❌ Modificar apariencia
- ❌ Instalar/desactivar plugins
- ❌ Acceso a configuración del sitio

---

## FASE 3 — Arquitectura de Páginas

### Estructura jerárquica

```
Inicio
│
Fútbol
├── Primera y Reserva
│   ├── Equipos          [wpcm-players club="primera"]
│   ├── Calendario       [wpcm-fixtures club="primera"]
│   └── Estadísticas     [wpcm-player-stats] + Tableberg
├── Femenino
│   ├── Equipos          [wpcm-players club="femenino"]
│   ├── Calendario       [wpcm-fixtures club="femenino"]
│   └── Estadísticas
└── Inferiores
    ├── Equipos          [wpcm-players club="inferiores"]
    ├── Calendario       [wpcm-fixtures club="inferiores"]
    └── Estadísticas
│
Básquet
├── Equipos              [wpcm-players club="basquet"]
├── Calendario           [wpcm-fixtures club="basquet"]
└── Estadísticas
│
Vóley
├── Equipos              [wpcm-players club="voley"]
├── Calendario           [wpcm-fixtures club="voley"]
└── Estadísticas
│
Patín
├── Calendario           Tableberg (tabla manual)
└── Estadísticas         Tableberg (tabla manual)
│
Pádel
├── Calendario           Tableberg (tabla manual)
└── Estadísticas         Tableberg (tabla manual)
```

### Página de Inicio — Bloques
1. Hero con imagen/video del club
2. Próximos partidos: `[wpcm-fixtures limit="5"]`
3. Últimos resultados: `[wpcm-results limit="5"]`
4. Grid de acceso rápido a deportes
5. Últimas noticias (posts recientes)
6. Patrocinadores

### Menús registrados
| ID del menú | Uso |
|---|---|
| `menu-principal` | Navegación superior principal |
| `menu-futbol` | Sub-menú lateral sección Fútbol |
| `menu-footer` | Pie de página (Contacto, Socios, RRSS) |

---

## Verificación End-to-End

- [ ] `docker-compose up -d` → los 3 servicios corren sin errores
- [ ] `http://localhost:8080` → instalador de WordPress disponible
- [ ] `http://localhost:8081` → phpMyAdmin conecta a la base `sportivo_db`
- [ ] Tema "Sportivo Balnearia" activo en Apariencia → Temas
- [ ] WP Club Manager y Tableberg activos en Plugins
- [ ] Shortcode `[wpcm-fixtures]` renderiza correctamente en página de prueba
- [ ] URLs de cada deporte cargan sin errores 404
- [ ] Menú principal muestra jerarquía completa

---

## Notas para Iteraciones Futuras

- **Diseño visual:** Al adjuntar imágenes de referencia, se actualizará la paleta en `assets/css/main.css`
- **Producción:** Se configurará Nginx + SSL (Let's Encrypt) al migrar a VPS
- **Patrocinadores:** WP Club Manager incluye módulo de sponsors; se activa en Fase 2 avanzada
- **Rendimiento:** WP Super Cache + CDN al pasar a producción
