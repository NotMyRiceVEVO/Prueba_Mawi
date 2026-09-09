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

# Análisis de Datos y Modelo de Clasificación

## Cómo correrlo

```bash
python3 -m venv venv
source venv/bin/activate
pip install pandas matplotlib seaborn scikit-learn jupyter notebook
jupyter notebook
```

Abra `EDA_y_Modelo.ipynb` y corra todas las celdas en orden (Kernel → Restart & Run All).

## Qué contiene

- **EDA**: 4 gráficas con hallazgos explicados (distribución de horas por rol, evolución del costo acumulado en el tiempo por proyecto, costo total vs. presupuesto, e importancia de features del modelo).
- **Modelo de clasificación**: Predice si un proyecto excederá su presupuesto, usando solo información disponible hasta un punto en el tiempo.

## Decisiones clave

- **Features sin fuga de datos**: Para cada proyecto se toman 3 "cortes" temporales (al 30%, 50% y 70% de sus registros), y las features se calculan solo con datos hasta ese corte, nunca con el resultado final del proyecto.
- **Solo 6 proyectos históricos** Se expandieron a 18 muestras vía los cortes temporales, esto tiene un costo real: las muestras de un mismo proyecto están correlacionadas entre sí, lo que infla la accuracy si se valida con el *Leave-One-Out* por fila.
- **Dos formas de validación, comparadas explícitamente**: Con Leave-One-Out por fila (accuracy alto pero engañoso, 89-100%) vs. Leave-One-Group-Out por proyecto (más honesto, 33-50%, cercano a adivinar). La diferencia entre ambos es en sí misma uno de los hallazgos más importantes del análisis.
- **Modelos simples** (Regresión Logística y Árbol de Decisión) en vez de algo más complejo como Random Forest, con un modelo complejo solo aumentaría el riesgo de sobreajuste.

## Qué haría con más tiempo

- Conseguir más proyectos históricos para una muestra más robusta.
- Categorizar las tareas por tipo (desarrollo, pruebas, reuniones, documentación) como feature adicional.
- Comparar contra modelos más complejos una vez que el tamaño de muestra lo justifique.


