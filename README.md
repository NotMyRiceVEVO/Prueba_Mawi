# Backend — API REST de Tiempos y Costos

API REST construida con CI-4 para la gestión de proyectos, empleados y registros de tiempo | incluye cálculo de costos y control de presupuesto.

## ¡ Cómo correrlo !

```bash
composer install
cp env .env
```

En `.env`, dentro de la sección `DATABASE`, descomenta (quitar #) y ajustar:

`database.default.database = database.db`

`database.default.DBDriver = SQLite3`


Correr las migraciones e insertar los datos de prueba:

```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

Inicio del servidor:

```bash
php spark serve
```

La API estará disponible en `http://localhost:8080`.

## Decisiones técnicas

- **Base de datos elegida: SQLite**, en vez de MySQL. No requiere levantar un servidor de base de datos aparte, el archivo vive dentro del proyecto y para un CRUD de este tamaño, no hay ninguna ventaja real de usar MySQL.
- **El costo no se guarda como columna fija.** Se calcula al vuelo (`horas × tarifa_hora`) en el endpoint de resumen, para evitar datos derivados o desincronizados si cambia la tarifa de un empleado después de haber registrado tiempo.
- **Se añadió un `ResourceController`** de CodeIgniter para el CRUD estándar, con un método extra (`resumen`) fuera del patrón RESTful para el requisito del resumen por proyecto.

## Endpoints

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/proyectos` | Lista todos los proyectos |
| GET | `/proyectos/{id}` | Detalle de un proyecto |
| POST | `/proyectos` | Crea un proyecto |
| PUT | `/proyectos/{id}` | Actualiza un proyecto |
| DELETE | `/proyectos/{id}` | Elimina un proyecto |
| GET | `/proyectos/{id}/resumen` | Horas totales, costo acumulado y si excede presupuesto |
| GET/POST/PUT/DELETE | `/empleados` | CRUD de empleados (mismo patrón) |
| GET/POST/PUT/DELETE | `/registros-tiempo` | CRUD de registros de tiempo (mismo patrón) |

Todas las respuestas son JSON, como se solicitó, junto con códigos HTTP estándar.

## Validaciones

Cada entidad valida sus campos vía los Models de CodeIgniter (`required`, tipos, rangos positivos y fechas válidas). Los registros de tiempo taambién validan que `empleado_id` y `proyecto_id` existan realmente (`is_not_unique`), para no permitir llaves foráneas divagando. Los errores se regresan en JSON.




