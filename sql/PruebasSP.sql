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

CALL sp_GestionUsuario('L', #Operacion
NULL, #Id Usuario
NULL, #Id Metodo Pago
'ricky_lolo29@hotmail.com', #Correo
'123', #Contraseña
NULL, #Rol de usuario
NULL, #PFP
NULL, #Descripción
NULL, # Nombre(s)
NULL, # Apellido Paterno
NULL, # Apellido Materno
NULL, # Fecha de nacimiento
NULL, # Genero
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

CALL sp_GestionUsuario('G', #Operacion
1, #Id Usuario
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


/*--------------------------------------------------------------------------------METODOS DE PAGO--------------------------------------------------------------------------*/
CALL sp_GestionMetodoPago(
'I', #Operacion
NULL, #MetodoPago_Id	 
'VISA',  #Nombre Metodo	
1   #Imagen Metodo
); 

CALL sp_GestionMetodoPago(
'A', #Operacion
NULL, #MetodoPago_Id	 
NULL,  #Nombre Metodo	
NULL   #Imagen Metodo
); 

CALL sp_GestionMetodoPago(
'G', #Operacion
1, #MetodoPago_Id	 
NULL,  #Nombre Metodo	
NULL   #Imagen Metodo
); 

CALL sp_GestionMetodoPago(
'E', #Operacion
1, #MetodoPago_Id	 
'VISA',  #Nombre Metodo	
1   #Imagen Metodo
); 


CALL sp_GestionMetodoPago(
'D', #Operacion
1, #MetodoPago_Id	 
NULL,  #Nombre Metodo	
NULL   #Imagen Metodo
); 



/*--------------------------------------------------------------------------------CURSO--------------------------------------------------------------------------*/
CALL sp_GestionCurso(
'I', 	#Operacion
NULL, 	# Curso Id
1, 	# Usuario Id
50.00,  	# Curso Costo
2,	# Curso Imagen
'Java',	# Curso Nombre
'Curso de Java para principiantes', 	# Curso Descripcion
NULL 		# Curso isBaja
); 

CALL sp_GestionCurso(
'A', 	#Operacion
NULL, 	# Curso Id
NULL, 	# Usuario Id
NULL,  	# Curso Costo
NULL,	# Curso Imagen
NULL,	# Curso Nombre
NULL, 	# Curso Descripcion
NULL 	# Curso isBaja
); 

CALL sp_GestionCurso(
'G', 	#Operacion
1, 	# Curso Id
NULL, 	# Usuario Id
NULL,  	# Curso Costo
NULL,	# Curso Imagen
NULL,	# Curso Nombre
NULL, 	# Curso Descripcion
NULL 	# Curso isBaja
); 

CALL sp_GestionCurso(
'E', 	#Operacion
1, 	# Curso Id
NULL, 	# Usuario Id
51.50,  	# Curso Costo
2,	# Curso Imagen
'Java',	# Curso Nombre
'Curso de Java para principiantes', 	# Curso Descripcion
NULL 		# Curso isBaja
); 


CALL sp_GestionCurso(
'B', 	#Operacion
1, 	# Curso Id
NULL, 	# Usuario Id
NULL,  	# Curso Costo
NULL,	# Curso Imagen
NULL,	# Curso Nombre
NULL, 	# Curso Descripcion
NULL 		# Curso isBaja
); 


