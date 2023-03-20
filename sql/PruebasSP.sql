USE BDMM_PROYECTO;

/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
CALL sp_GestionUsuario('I', #Operacion
NULL, #Id Usuario
NULL, #Id Metodo Pago
'ricky_lolo29@hotmail.com', #Correo
'123', #Contraseña
1, #Rol de usuario
NULL, #PFP
'ADMIN', #Descripción
'Ricardo Alberto', # Nombre(s)
'Grimaldo', # Apellido Paterno
'Estévez', # Apellido Materno
'2001-06-29', # Fecha de nacimiento
'Hombre', # Genero
NULL); # Flag Perfil Bloqueado

CALL sp_GestionUsuario('A', #Operacion
NULL, #Id Usuario
NULL, #Correo
NULL, #Nickname
NULL, #Contraseña
NULL, #Rol de usuario
NULL, #PFP
NULL, #Descripcion
NULL, # Nombre(s)
NULL, # Apellido Paterno
NULL, # Apellido Materno
NULL, # Fecha de nacimiento
NULL, # Genero
NULL); # Flag Perfil Bloqueado