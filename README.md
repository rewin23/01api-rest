
### `README.md`

```markdown
# PHP API Server Instructions

Este proyecto contiene un servidor PHP con endpoints para gestionar servicios y mostrar información sobre el sitio.

## Requisitos

- PHP 7.4 o superior.
- Extensión de PHP `json` habilitada.

## Instrucciones para ejecutar el servidor

1. **Clonar el proyecto**: Clona este repositorio en tu máquina local o descarga los archivos necesarios, asegurándote de incluir `index.php`, `config.php`, `SiteController.php`, y `ServicesController.php`.

2. **Navegar al directorio del proyecto**:

   ```bash
   cd /ruta/a/tu/proyecto
   ```

3. **Iniciar el servidor PHP**: Ejecuta el siguiente comando para iniciar un servidor PHP local en el puerto `8000` (puedes cambiar el puerto si es necesario):

   ```bash
   php -S localhost:8000 index.php
   ```

   Esto iniciará un servidor PHP local que servirá el archivo `index.php`.

4. **Probar los endpoints**: Ahora puedes probar los diferentes endpoints utilizando herramientas como `curl`, Postman, o tu navegador. Asegúrate de incluir un encabezado de autorización (`Authorization`) con un token de tipo `Bearer`, ya que se requiere para las solicitudes.

## Endpoints

### GET `/services`

Obtiene una lista de todos los servicios.

- **Ejemplo**:

  ```bash
  curl -X GET http://localhost:8000/services -H "Authorization: Bearer <your_token>"
  ```

### GET `/services/{id}`

Obtiene información sobre un servicio específico por su ID.

- **Parámetros**:
  - `id` (int): ID del servicio.

- **Ejemplo**:

  ```bash
  curl -X GET http://localhost:8000/services/1 -H "Authorization: Bearer <your_token>"
  ```

### GET `/about`

Obtiene información general sobre el sitio.

- **Ejemplo**:

  ```bash
  curl -X GET http://localhost:8000/about -H "Authorization: Bearer <your_token>"
  ```

## Códigos de respuesta

- **200 OK**: Solicitud exitosa.
- **401 Unauthorized**: Faltan credenciales de autorización o son inválidas.
- **404 Not Found**: Endpoint o recurso no encontrado.
- **405 Method Not Allowed**: Método HTTP no permitido.

## Notas

- Actualmente, la autenticación del token está en modo de prueba (siempre pasa la verificación). Esto significa que la variable `$userId` se establece en `1` para facilitar el desarrollo y pruebas.

## Desarrollo y contribuciones

Si deseas contribuir a este proyecto, puedes hacer un fork y enviar un pull request. Asegúrate de que el código esté bien documentado y probado.
```

### Explicación

Este archivo `README.md` guía al usuario en la configuración y ejecución del servidor PHP, además de proporcionar instrucciones detalladas para probar cada uno de los endpoints disponibles en el archivo `index.php`.

```

## TODO

- Agregar dockerfile y docker compose para probar mas facilmente
- Agregar github action para CI/CD
- Interfaz para generar el token