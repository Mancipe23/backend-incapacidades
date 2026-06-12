# Documentación de Endpoints

## Microservicio de Autenticación (ms-auth)

### Iniciar Sesión

**POST**

```http
/ms-auth/public/login
```

**Body**

```json
{
  "usuario": "admin",
  "contrasena": "admin123"
}
```

**Respuesta**

```json
{
  "mensaje": "Login correcto",
  "token": "xxxxxxxx"
}
```

---

### Cerrar Sesión

**POST**

```http
/ms-auth/public/logout
```

**Body**

```json
{
  "token": "xxxxxxxx"
}
```

**Respuesta**

```json
{
  "mensaje": "Sesión cerrada"
}
```

---

# Microservicio de Empleados (ms-empleados)

### Listar Empleados

**GET**

```http
/ms-empleados/public/empleados
```

### Registrar Empleado

**POST**

```http
/ms-empleados/public/empleados
```

**Body**

```json
{
  "nombres": "Juan",
  "apellidos": "Perez",
  "documento": "123456",
  "correo": "juan@email.com",
  "telefono": "3001234567",
  "cargo": "Analista",
  "area": "Sistemas",
  "fecha_ingreso": "2026-06-12",
  "estado": "activo"
}
```

---

# Microservicio de Incapacidades (ms-incapacidades)

### Listar Incapacidades

**GET**

```http
/ms-incapacidades/public/incapacidades
```

### Registrar Incapacidad

**POST**

```http
/ms-incapacidades/public/incapacidades
```

**Body**

```json
{
  "empleado_id": 1,
  "fecha_inicio": "2026-06-01",
  "fecha_fin": "2026-06-05",
  "tipo": "enfermedad_general",
  "diagnostico_general": "Gripe",
  "entidad_medica": "Nueva EPS",
  "observaciones": "Reposo en casa"
}
```

---

# Microservicio de Seguimiento (ms-seguimiento)

### Listar Seguimientos

**GET**

```http
/ms-seguimiento/public/seguimientos
```

### Registrar Seguimiento

**POST**

```http
/ms-seguimiento/public/seguimientos
```

**Body**

json
{
  "incapacidad_id": 1,
  "fecha": "2026-06-12",
  "comentario": "Seguimiento realizado",
  "estado": "en_revision",
  "usuario_responsable": "gestionhumana"
}

---

## Tecnologías Utilizadas

* PHP 8
* Slim Framework
* Eloquent ORM
* MySQL
* HTML5
* CSS3
* JavaScript Vanilla
* Arquitectura basada en Microservicios
* APIs REST
* Git y GitHub
