import pymysql


connection = pymysql.connect(
    host='bahgswltwg4pptqeawfa-mysql.services.clever-cloud.com',
    user='uoewlyiudyxkpcy6',
    password='zKYDbl2iXsMdjAzLJXv8',
    database='bahgswltwg4pptqeawfa',
    port=3306
)


cursor = connection.cursor()


#cursor.execute("INSERT INTO Dueño (Rut, nombre, apellido, edad, sexo, estatus) VALUES ('12345678-9', 'Juan', 'Pérez', 35, 'M', 'Activo'), ('98765432-1', 'Ana', 'Gómez', 29, 'F', 'Inactivo');")
cursor.execute("SELECT * FROM Dueño;")
resultados = cursor.fetchall()

# Cerrar la conexión
cursor.close()
connection.close()

print(resultados)

