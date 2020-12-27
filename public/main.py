from threading import Thread
from time import sleep
from datetime import date,datetime
import pymysql

import time, os, threading

import threading

def escuchador_alarmas():
    while True:

        #abrir conexion a la base de datos , indicar las credenciales del servidor
        # host || username || password || databse
        connection_database = pymysql.connect("127.0.0.1", "root", "", "smarthome")

        connectionMysql = connection_database.cursor()

        #obtener el instante acutal
        now = datetime.now()
        #dar formato al instante actual conforme al campo de la alarma de la tabla de la base de datos
        time_alarm = now.strftime("%Y-%m-%d %H:%M:%S")

        # sentencia sql para obtener las alarmas activas
        sql = "select idAlarma , time_end from tbl_alarmas where time_end = %s and status = 0"

        #ejecutar sentencia sql
        connectionMysql.execute(sql,(time_alarm))
        result = connectionMysql.fetchall()

        for row in result:

            #si se encuentra una alarma disponible  actualizar registro a 1 para que este inactiva
            sql = 'UPDATE tbl_alarmas SET status = 1 where idAlarma = %s'
            connectionMysql.execute(sql, (row[0]))
            connection_database.commit()

            encender_led()

        connection_database.close()


def encender_led():
    #codigo para mandar a encer el led de la alarma
    print("encender led")


escuchador_alarmas()
