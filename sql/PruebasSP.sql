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

CALL sp_GestionUsuario('I', #Operacion
NULL, #Id Usuario
NULL, #Id Metodo Pago
'rickylolo@hotmail.com', #Correo
'123', #Contraseña
2, #Rol de usuario
NULL, #PFP
'INSTRUCTOR', #Descripción
'Ricardo Alberto', # Nombre(s)
'Grimaldo', # Apellido Paterno
'Estévez', # Apellido Materno
'2001-06-29', # Fecha de nacimiento
'Hombre', # Genero
NULL); # Flag Perfil Bloqueado

CALL sp_GestionUsuario('I', #Operacion
NULL, #Id Usuario
NULL, #Id Metodo Pago
'roberto_gmz@hotmail.com', #Correo
'123', #Contraseña
3, #Rol de usuario
NULL, #PFP
'ALUMNO', #Descripción
'Roberto Juan', # Nombre(s)
'Gomez', # Apellido Paterno
'Perez', # Apellido Materno
'2001-06-09', # Fecha de nacimiento
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
'I', 	#Operacion
NULL, 	# Curso Id
1, 	# Usuario Id
150.00,  	# Curso Costo
2,	# Curso Imagen
'JavaScript',	# Curso Nombre
'Curso de JavaScript para principiantes', 	# Curso Descripcion
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


/*--------------------------------------------------------------------------------CATEGORIA -------------------------------------------------------------------------*/
CALL sp_GestionCategoria(
'I', #Operacion
NULL, # Id
1,# Usuario Id
'Tecnología', 			# Nombre
'Categoría enfocada en toda la industria Tech'  	# Descripcion
); 

CALL sp_GestionCategoria(
'A', # Operacion
NULL, # Id
NULL, # Usuario Id
NULL, # Nombre
NULL #Descripcion
); 

CALL sp_GestionCategoria(
'G', # Operacion
1, # Id
NULL, # Usuario Id
NULL, # Nombre
NULL #Descripcion
); 


CALL sp_GestionCategoria(
'E', # Operacion
1, # Id
NULL,# Usuario Id
'Tecnología', 			# Nombre
'Categoría enfocada en toda la industria Tech'  	# Descripcion
); 



CALL sp_GestionCategoria(
'D', # Operacion
1, # Id
NULL, # Usuario Id
NULL, # Nombre
NULL #Descripcion
); 



/*--------------------------------------------------------------------------------COMENTARIO -------------------------------------------------------------------------*/
CALL sp_GestionComentario(
'I', # Operacion
NULL, # Id
1, 			# User Id
1, 			# Curso Id
1, 				# is Like
'Buen Curso'  				# texto
);

CALL sp_GestionComentario(
'E', # Operacion
1, # Id
NULL, 			# User Id
NULL, 			# Curso Id
1, 				# is Like
'Excelente Curso' # texto
);

CALL sp_GestionComentario(
'A', # Operacion
NULL, # Id
NULL, # User Id
NULL, #Curso Id
NULL, # is Like
NULL # texto
);


CALL sp_GestionComentario(
'G', # Operacion
1, # Id
NULL, # User Id
NULL, #Curso Id
NULL, # is Like
NULL # texto
);


/*--------------------------------------------------------------------------------MENSAJE-------------------------------------------------------------------------*/
CALL sp_GestionMensaje(
'I',  		#Operacion
NULL, 		# Id
2, 			# User Instructor Id
3, 			# User Alumno Id
1, 			# Curso Id
'Hola es una prueba curso 1'# Texto
);

CALL sp_GestionMensaje(
'I',  		#Operacion
NULL, 		# Id
2, 			# User Instructor Id
3, 			# User Alumno Id
1, 			# Curso Id
'Hola es una prueba curso 1'# Texto
);

CALL sp_GestionMensaje(
'I',  		#Operacion
NULL, 		# Id
2, 			# User Instructor Id
3, 			# User Alumno Id
2, 			# Curso Id
'Hola es una prueba curso 2'# Texto
);

CALL sp_GestionMensaje(
'I',  		#Operacion
NULL, 		# Id
2, 			# User Instructor Id
1, 			# User Alumno Id
2, 			# Curso Id
'Hola es una prueba curso 2'# Texto
);

CALL sp_GestionMensaje(
'D',    #Operacion
6, 		# Id
NULL,   # Instructor Id
NULL, 	# Alumno Id
NULL,	# Curso Id
NULL    # Texto
);


CALL sp_GestionMensaje(
'A', # Operacion
NULL, 		# Id
2,   #  User Instructor Id
NULL, 	# User Alumno Id
NULL,	# Curso Id
NULL    # Texto
);


CALL sp_GestionMensaje(
'G', # Operacion
NULL, 		# Id
2,   #  User Instructor Id
3, 	# User Alumno Id
1,	# Curso Id
NULL    # Texto
);

/*--------------------------------------------------------------------------------CURSO CATEGORIA-------------------------------------------------------------------------*/
CALL sp_GestionCursoCategoria(
'I',    #Operacion
NULL ,  # CursoCategoria id
1  	,	# Curso id
2       # Categoria id
);

CALL sp_GestionCursoCategoria(
'A',    #Operacion 
NULL ,  # CursoCategoria id
NULL  	,	# Curso id
2       # Categoria id 
);


CALL sp_GestionCursoCategoria(
'C',    #Operacion 
NULL ,  # CursoCategoria id
1  	,	# Curso id
NULL       # Categoria id 
);

CALL sp_GestionCursoCategoria(
'D',    #Operacion 
1 ,  # CursoCategoria id
NULL  	,	# Curso id
NULL       # Categoria id 
);


/*-------------------------------------------------------------------------------- NIVEL -------------------------------------------------------------------------*/
CALL sp_GestionNivel(
	'I',  # Operacion
	NULL, # Nivel Id	
    1, 		# Curso Id	
    1,          # noNivel
    'Principios de Java',  			# nombre
    120.50  		# costoNivel
);

CALL sp_GestionNivel(
	'I',  # Operacion
	NULL, # Nivel Id	
    1, 		# Curso Id	
    2,          # noNivel
    'Principios de Java 2',  			# nombre
    120.50  		# costoNivel
);

CALL sp_GestionNivel(
	'E',  # Operacion
	1,    # Nivel Id	
    NULL, 		# Curso Id	
    2,          # noNivel
    'Principios de Java',  			# nombre
    120.55  		# costoNivel
);

CALL sp_GestionNivel(
	'D',  # Operacion
	1,    # Nivel Id	
    NULL, 		# Curso Id	
    NULL,          # noNivel
    NULL,  			# nombre
    NULL  		# costoNivel
);


CALL sp_GestionNivel(
	'G',  # Operacion
	NULL,    # Nivel Id	
    1, 		# Curso Id	
    NULL,          # noNivel
    NULL,  			# nombre
    NULL  		# costoNivel
);

/*-------------------------------------------------------------------------------- MULTIMEDIA -------------------------------------------------------------------------*/
CALL sp_GestionMultimedia(
'I',  # Operacion
NULL,    # Id
1, 	    # Nivel Id
NULL,  		# Multimedia
'Texto Prueba', 			# Texto
1 	# Tipo Multimedia
);

CALL sp_GestionMultimedia(
'D',  		# Operacion
1,    		# Id
NULL, 	    # Nivel Id
NULL,  		# Multimedia
NULL, 		# Texto
NULL 		# Tipo Multimedia
);

CALL sp_GestionMultimedia(
'G',  		# Operacion
NULL,    		# Id
1, 	    # Nivel Id
NULL,  		# Multimedia
NULL, 		# Texto
NULL 		# Tipo Multimedia
);


/*-------------------------------------------------------------------------------- USUARIO CURSO -------------------------------------------------------------------------*/
CALL sp_GestionUsuarioCurso(
'I', #Operacion
NULL, 		#usuarioCurso Id
1, #MetodoPago Id
1, #Curso Id
3, #Usuario Id
500.50#costoCurso
);

CALL sp_GestionUsuarioCurso(
'G', 		#Operacion
NULL, 		#usuarioCurso Id
NULL, 		#MetodoPago Id
NULL, 		#Curso Id
3, 			#Usuario Id
NULL		#costoCurso
);

/*-------------------------------------------------------------------------------- USUARIO NIVEL -------------------------------------------------------------------------*/
CALL sp_GestionNivelCurso(
'I', 		#Operacion
NULL, 		#niveCurso Id
1, 			#MetodoPago Id
1, 			#usuarioCurso Id
1, 			#Nivel Id
50.5		#costoNivel
);

CALL sp_GestionNivelCurso(
'G', 		#Operacion
NULL, 		#niveCurso Id
NULL, 			#MetodoPago Id
1, 			#usuarioCurso Id
NULL, 			#Nivel Id
NULL		#costoNivel
);
