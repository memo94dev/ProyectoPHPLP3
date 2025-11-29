# ProyectoPHPLP3
# Proyecto SysWeb

Sistema de gestión de usuarios, depósitos y stock con autenticación y control de accesos.

---

## ✅ Requisitos

- PHP >= 7.4 (se recomienda PHP 8+)
- Servidor web Apache/Nginx
- MySQL/MariaDB >= 5.7
- Extensión PDO habilitada en PHP
- Composer (opcional, para dependencias)

---

## ⚙️ Pasos de instalación

1. Clonar el repositorio o copiar los archivos al servidor web:
   ```bash
   git clone https://github.com/memo94dev/ProyectoPHPLP3.git

2. Ejectar las sentencias sql adjuntas en la carpeta sql-statement/creacion-de-tablas-y-sus-relaciones.sql y luego setear al usuario 
sql-statement/creacion-de-esquema-y-usuario-para-conexion.sql, tambien various-statement.sql

3. Iniciar el servidor y acceder a localhost/sysweb-LP3/

4. Credenciales de prueba user: memo password: 1

## 📝 Notas

- Se recomienda reemplazar el uso de MD5 por password_hash() y password_verify() para mayor seguridad.
- El sistema incluye un contador de intentos fallidos de login. Al llegar a 3 intentos, el usuario se bloquea automáticamente.
- Para desbloquear un usuario:
UPDATE usuarios SET status='activo' WHERE username='admin';
- Este proyecto es un ejemplo educativo y debe adaptarse antes de usarse en producción.
