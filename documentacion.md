# Práctica 3 - Implementación de Prácticas de Seguridad en el Desarrollo de Aplicaciones Web
---
En este archivo de documentacion.md se encuentra la explicacion o documentación de la practica 3.
---

### 1. Validación y Sanitización de Entradas:
La validación y sanitización de entradas son prácticas en la seguridad de aplicaciones web para evitar ataques de inyección, como SQL Injection y Cross-Site Scripting (XSS).

### - Pasos para Validar Entradas de Usuario:

    -Los campos de texto deben tener un límite de caracteres segun lo necesario.
    -Los correos electrónicos deben cumplir con el formato `nombre@dominio.com`.

**Validación en el Lado del Cliente (Opcional)**:
   - Implementar validación en el navegador usando HTML5 o JavaScript. Aunque esto no reemplaza la validación del servidor, pero ayuda a mejorar la experiencia del usuario al mostrar errores inmediatos al ingresar datos que no se permiten.
   - Ejemplo: Campos de HTML5 como `<input type="email">` y `<input type="number">`.

**Validación en el Lado del Servidor (Obligatoria)**:
   - Asegurarse de validar los datos en el servidor, ya que la validación del lado del cliente puede ser fácilmente evitada.
   - Usar expresiones regulares para verificar formatos específicos, como el formato de un correo electrónico.

**Mostrar Mensajes de Error Descriptivos**:
   - Proporcionar retroalimentación clara al usuario si algún campo no cumple con los requisitos, evitando mensajes ambiguos.
   - Es importante no revelar información sensible en los mensajes de error como codigo o consultas, ya que podría dar pistas sobre la estructura de la base de datos o la aplicación.

**Rechazar Datos Inválidos**:
   - Si un campo no cumple con los criterios de validación, rechazar el dato y no procesarlo más.
   - Regresar al usuario a la página de entrada con los errores destacados.

### - Pasos para Sanitizar Entradas de Usuario

 **Eliminar o Escapar Caracteres Especiales**:
   - Usar funciones de sanitización que eliminen o conviertan caracteres potencialmente peligrosos (como `<`, `>`, `&`, `'`, `"`) en sus equivalentes seguros.
   - Por ejemplo, convertir `<` en `&lt;` y `>` en `&gt;` para que no puedan ser interpretados como código HTML en el navegador.

 **Limitar el Tipo de Datos y el Formato de las Entradas**:
   - Restringir los datos a un formato específico (por ejemplo, solo números para un campo de edad).
   - Para entradas de texto, limitar la longitud máxima del campo para reducir el riesgo de inyecciones o desbordamiento de datos.

 **Usar Librerías de Sanitización**:
   - Utilizar librerías de sanitización que hayan sido probadas y recomendadas por la comunidad de seguridad para eliminar código malicioso. Estas librerías facilitan el proceso de limpiar y transformar las entradas.
   - Ejemplos de librerías:
     - Para PHP: `htmlspecialchars` y `filter_var`.
     - Para JavaScript (Node.js): Librerías como `validator`.

 **Escapar Datos en Salida (Output Escaping)**:
   - Asegurarse de que todos los datos ingresados por el usuario y almacenados en el sistema sean correctamente escapados antes de ser mostrados de nuevo en el navegador.
   - Esto es especialmente importante para prevenir ataques XSS cuando se muestran comentarios u otros datos ingresados por usuarios en una página web.

## Ejemplo de Aplicación

Supongamos que tenemos un formulario donde el usuario ingresa un nombre y un correo electrónico:

- Ejemplo en el archivo: 


### 2. Control de Acceso y Autenticación Segura
El control de acceso y la autenticación son aspectos críticos para proteger los recursos de la aplicación y garantizar que solo los usuarios autorizados puedan acceder a ciertas funcionalidades.

#### Autenticación Multifactor (MFA)
La autenticación multifactor es una técnica de seguridad que requiere dos o más verificaciones independientes para probar la identidad del usuario. MFA proporciona una capa adicional de protección frente a accesos no autorizados.

- **Beneficios**: Incrementa la seguridad al requerir múltiples factores, como una contraseña y un código enviado al teléfono del usuario, reduciendo el riesgo de accesos no autorizados.
- **Aplicación**: Ideal para aplicaciones sensibles donde el acceso no autorizado podría tener consecuencias graves.

#### Autenticación basada en Tokens JWT (JSON Web Tokens)
JWT es un estándar para crear tokens seguros que permiten la autenticación sin necesidad de mantener el estado en el servidor. JWT se utiliza ampliamente en sistemas que requieren autenticación en aplicaciones modernas.

- **Beneficios**: Los tokens JWT permiten autenticar usuarios de manera eficiente en aplicaciones distribuidas, ya que el servidor no necesita almacenar información de sesión. Además, son seguros ya que están firmados digitalmente.
- **Aplicación**: Autenticación de usuarios en aplicaciones web y APIs RESTful.

### 3. Gestión de Sesiones y Cookies
Las sesiones y cookies son elementos esenciales en la autenticación y gestión de estados en aplicaciones web. Asegurar estos elementos ayuda a proteger la privacidad y seguridad de los usuarios.

#### HttpOnly y Secure en Cookies
Las cookies pueden configurarse con atributos especiales para mejorar la seguridad de las sesiones de usuario:

- **HttpOnly**: Este atributo evita que la cookie sea accesible a través de JavaScript en el navegador, mitigando el riesgo de ataques XSS. Solo el servidor puede acceder a la cookie.
- **Secure**: Este atributo asegura que la cookie solo sea enviada en conexiones HTTPS, protegiendo la información de posibles ataques de interceptación.

#### Configuración de Cookies Seguras
Al aplicar los atributos HttpOnly y Secure en cookies de sesión, se protege la sesión de usuario contra ataques de robo de cookies y evita que terceros accedan a la información de la sesión.

### 4. Protección de Datos Sensibles
Es importante proteger los datos sensibles, especialmente las contraseñas, para evitar que sean accesibles incluso si los sistemas son comprometidos:

#### Hashing
El hashing es un proceso de transformación de datos en un valor irreversiblemente encriptado. Es comúnmente utilizado para almacenar contraseñas de manera segura en la base de datos.

- **Características**: Los datos hashed no pueden ser revertidos a su forma original. Esto significa que, incluso si un atacante obtiene acceso al hash, no puede recuperar la contraseña original.
- **Ejemplo de uso**: Almacenar contraseñas en bases de datos.

#### Cifrado
El cifrado es un proceso reversible en el que los datos pueden ser encriptados y luego desencriptados con una clave. A diferencia del hashing, el cifrado es ideal para datos que necesitan ser recuperados en su forma original.

- **Características**: Los datos cifrados pueden ser desencriptados si se posee la clave correcta.
- **Ejemplo de uso**: Enviar datos sensibles, como información de tarjetas de crédito, a través de una red segura.

#### Comparación entre Hashing y Cifrado
- **Hashing**: Ideal para datos que no necesitan ser recuperados, como contraseñas. Los datos hashed no pueden ser revertidos a su forma original.
- **Cifrado**: Adecuado para datos que necesitan ser recuperados en su forma original, como información de identificación personal (PII) o información financiera. Los datos cifrados pueden ser desencriptados con una clave.

### Conclusión
En rconclusión, el **hashing** es útil cuando los datos no necesitan ser recuperados, como en el caso de las contraseñas, mientras que el **cifrado** es adecuado para datos que necesitan ser protegidos pero recuperables, como la información personal o financiera.