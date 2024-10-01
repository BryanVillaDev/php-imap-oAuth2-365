# Proyecto OAuth2 con Microsoft y SQL Server

Este proyecto permite a los usuarios autenticarse con **Microsoft OAuth2** y almacena los tokens de acceso en una base de datos **SQL Server**. Incluye un formulario para ingresar el correo electrónico, luego realiza la autenticación con Microsoft y actualiza o inserta el token en la base de datos.

## Requisitos

- **PHP** (versión 7.4 o superior)
- **Composer** (gestor de dependencias de PHP)
- **SQL Server**
- **Extensión PDO_SQLSRV** (para conectar PHP con SQL Server)

## Instalación

### 1. Clona el repositorio

```bash
git clone https://github.com/tuusuario/oauth2-microsoft-sqlserver.git
cd oauth2-microsoft-sqlserver
