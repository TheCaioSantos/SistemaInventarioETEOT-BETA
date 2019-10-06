import sys


senha = sys.argv[1]
idusuario = sys.argv[2]

import pymysql

conexao = pymysql.connect(db='patrimonio2', user='root', passwd='')

cursor = conexao.cursor()

resultado = cursor.execute("UPDATE usuario SET senha = md5((%s)) WHERE idusuario = (%s)", (senha, idusuario))

conexao.commit()

conexao.close()

print(resultado)
