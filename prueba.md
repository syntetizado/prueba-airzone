El propósito de esta prueba es comprobar como la persona se desenvuelve desarrollando en contexto Laravel, así como evaluar la calidad, claridad y documentación del código generado.

Si Alguna de las tareas no se completa, deja el comentario en el propio commit de la tarea.

<hr>

## 1. Levantar proyecto
Levanta un proyecto laravel y configúralo de la manera adecuada para conectar con la base de datos adjunta en la tarea. 
 
> Una vez el proyecto está inicializadorealiza un primer commit con el mensaje "Inicialización del proyecto".

<hr>

## 2. Modelos

Genera los modelos necesarios para la entidades:
   1. User
   2. Category
   3. Post
   4. Comment

> Genera un commit con el mensaje "Models".

<hr>

## 3. Rellenar BD
Crea los ficheros Factory/Seeder necesarios para cubrir las entidades generadas en el punto 2.


> Genera un commit con el mensaje "Factories/Seeders".

<hr>

## 4. Relaciones

Genera las siguients relaciones:
   1. ### Category-Post

Cada Post puede pertenecer a multiples Categorías y una categoría puede disponer de múltiples comentarios.

   - En Category 'posts'
   - En Post 'categories'

   2. ### Comment-Post

Un post puede tener multiples comentarios

   - En Post 'comments'
   - En Comment 'post'

   3. ### Comment-User

Un Comentario es escrito por un usuario

   - En Comment 'writer'
   - En User 'comments'

   4. ### Post-User

Un Post es creado por un usuario.

   - En Post 'owner'
   - En User 'comments'

   5. ### Post-Comment-User

Se trata de una **relación** en la que mostramos todos aquellos usuarios que han intervenido en el Post a través de comentarios

   - En Post 'writers'

> Genera un commit con el mensaje "Relationships".

<hr>

## 4. CRUD

Realiza un CRUD básico de Categorías donde realices las validaciones para el modelo de datos que estimes oportunas. (Solo a nivel API, no es necesario el desarrollo de un front para su visualización).

Siente libre de utilizar cualquier tipo de arquitectura para organizar tu código, dejando un pequeño comentario en la entrega de como has organizado tu código.

> Genera un commit con el mensaje "Category CRUD".

<hr>

## 5. API

Crea ruta API en la que dado el identificador de un post, devolvamos todos sus comentarios y los usuarios que han intervenido comentando (no a nivel de comentario, sino a nivel de post)

```json
{
    "body": {
            "post": {
            "id": 123,
            "title": "XXXXXX",
            "short_content": null,
            "owner": {…}
            "users": […],
            "comments": […]
        }
    }
}
```



> Genera un commit con el mensaje "Feature-Post-Activity".

<hr>

## 6. Tests

Crea una batería de Tests que según tu criterio es mínima para garantizar la escalabilidad de esta aplicación

Genera un commit con el mensaje "Testing".

<hr>

Para entregar la prueba, envía el enlace de tu repo Github / GitLab / BitBucket… y envía un correo a:

- [mromero@altracorporacion.es](mailto:mromero@altracorporacion.es)
- [jgmartin@altracorporacion.es](mailto:jgmartin@altracorporacion.es)
- [jcarmona@altracorporacion.es](mailto:jcarmona@altracorporacion.es)

indicando tu Nombre y todos los comentarios que encuentres necesarios, así como adjuntando la exportación de rutas que has trabajado en postman.