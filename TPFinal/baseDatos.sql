CREATE TABLE IF NOT EXISTS categoria(
  idcategoria int(11) NOT NULL,
  descripcion varchar(50) NOT NULL,

  PRIMARY KEY(idcategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO categoria(idcategoria,descripcion) VALUES
(1,'Microprocesadores'),
(2,'Placas madre'),
(3,'Memorias RAM'),
(4,'Fuentes'),
(5,'Placas de video'),
(6,'Discos duros/SSD'),
(7,'Gabinetes'),
(8,'Parlantes'),
(9,'Mouses/Teclados'),
(10,'Monitores'),
(11,'Parlantes/Auriculares'),
(12,'Estabilizadores/UPS'),
(13,'Toner/Cartuchos'),
(14,'Cables/Adaptadores');

CREATE TABLE IF NOT EXISTS producto(
  idproducto int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(100) NOT NULL,
  descripcion varchar(1000) NOT NULL,
  precio int(11) NOT NULL,
  stock int(11) NOT NULL,
  activo tinyint(1) NOT NULL DEFAULT 1,
  idcategoria_categoria int(11) NOT NULL,

  PRIMARY KEY(idproducto),
  FOREIGN KEY(idcategoria_categoria) REFERENCES categoria(idcategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO producto(nombre,descripcion,precio,stock,idcategoria_categoria) VALUES
  ('Microcesador AMD Vishera FX 8350','8 nucleos',3350,10,1),/*agregar mas elementos*/
  ('Microcesador AMD Vishera FX 6300','El AMD FX-6300 alcanza los 3.5GHz y nos sorprende con 4100MHz en modo turbo
    para dejarnos claro que este chip de AMD sobre Socket AM3+ es de los más potentes y no descuida ninguno de sus
    aspectos. Esta pequeña pieza de silicio fabricada con una estructura de 64 bits dispone de 6 procesadores y 8MB
     de caché de nivel 3. La tecnología AMD Turbo Core le da el extra de potencia que necesitan algunas aplicaciones
     del FX 6300 para tener un rendimiento extra en los momentos más exigentes. Las mejoras al conjunto del chip han
     sido diseñadas para incrementar el acceso a la memoria y así nuestras aplicaciones sean más rápidas y estables
     en el AMD FX 6300.',2200,15,1),
  ('Microcesador Intel i7 6700k','6 nucleos',7700,8,1),
  ('Microcesador Intel i3 6100','8 nucleos',3350,25,1),
  ('Microcesador AMD Phenom II x6 1055t','AMD Phenom II X6 1090T cuenta con un reloj a 3.2 GHz. y trae implementado
     lo que denominan Turbo CORE. Ésta es una tecnología similar al Turbo Boost de Intel, y permite configurarse automáticamente para aportar un mayor o menor rendimiento según las exigencias puntuales del equipo y el software. Según AMD, el 1090T puede alcanzar los 3.6 GHz. a través de Turbo CORE.
   Además del reloj también nos encontraremos con seis cachés L2 de 512 KB, más una L3 de 6 MB para coordinar
   todos los seis núcleos del chip. Por supuesto, todos los AMD Phenom II X6 utilizarán el socket AM3, aunque también
    se podrán instalar en los AM2+ pero perdiendo determinadas funcionalidades, con lo que en absoluto es algo
     recomendable. En el caso del modelo 1090T, su TDP es de 125 vatios, de los más altos que podemos
      encontrar.',3350,5,1),
   ('Placa Madre Gigabyte Ga-970-gaming Am3+ Amd 970 Sata 6gb/s ','Soporta procesadores AMD AM3+/ AM3
     Dual Channel DDR3, 4 DIMMs
     Rápido USB 3.1 con USB Type-C - El próximo conector universal del mundo
     Puertos USB DAC-UP GIGABYTE
     Soporte para gráficas en 2 vías win el exclusivo Ultra Durable Metal Shielding sobre el puerto PCIe
     PCIe Gen2 x2 Conectores M.2 con hasta 10Gb/s de transferencia de datos (soporte PCIe NVMe & SATA SSD)
     Condensadores de audio de alta calidad y Audio Noise Guard con iluminación y ambiente LED
     Audio 115dB SNR con tecnología actualizable AMP-UP
     Red Gaming serie Killer™ E2200
     Tecnología UEFI DualBIOS™ de GIGABYTE
     Nuevo GIGABYTE APP Center, sencillo y fácil de usar',2800,4,2);

CREATE TABLE IF NOT EXISTS imagen(
  idimagen int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(250) NOT NULL,
  idproducto_producto int(11) NOT NULL,

  PRIMARY KEY(idimagen),
  FOREIGN KEY(idproducto_producto) REFERENCES producto(idproducto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO imagen(nombre,idproducto_producto) VALUES
('fx8350a.jpg',1),
('fx8350b.jpg',1),
('fx6300a.jpg',2),
('fx6300b.jpg',2),
('gigabyte-ga970a.jpg',6),
('gigabyte-ga970b.jpg',6);



CREATE TABLE IF NOT EXISTS usuario(
  idusuario int(11) NOT NULL AUTO_INCREMENT,
  rol varchar(50) NOT NULL,
  nombre varchar(50) NOT NULL,
  apellido varchar(50) NOT NULL,
  dni int(11) NOT NULL,
  nombreusuario varchar(50) NOT NULL,
  contrasenia varchar(100) NOT NULL,
  fechanacimiento date NOT NULL,

  PRIMARY KEY(idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO usuario(rol,nombre,apellido,dni,nombreusuario,contrasenia,fechanacimiento) VALUES
('administrador','Adrian','Mosler',34666105,'root','7f82c5b1d7a5836070d3c3c55e00ffd9','1989-09-08'),/*pass:uncoma*/
('cliente','Maria','Hernandez',31931931,'marihernandezarg','81dc9bdb52d04dc20036dbd8313ed055','1988-08-02');/*pass:1234*/





CREATE TABLE IF NOT EXISTS cliente(
  idcliente int(11) NOT NULL AUTO_INCREMENT,
  idusuario_usuario int(11) NOT NULL,
  tarjeta varchar(50) NOT NULL,
  numerotarjeta int(20) NOT NULL,


  PRIMARY KEY(idcliente),
  FOREIGN KEY(idusuario_usuario) REFERENCES usuario(idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO cliente(idusuario_usuario,tarjeta,numerotarjeta) VALUES
(2,'visa',112233445566);




CREATE TABLE IF NOT EXISTS pedido(
  idpedido int(11) NOT NULL AUTO_INCREMENT,
  idcliente_cliente int(11) NOT NULL,
  fecha date NOT NULL,
  estado tinyint(1) NOT NULL DEFAULT 0,

PRIMARY KEY(idpedido),
FOREIGN KEY(idcliente_cliente) REFERENCES cliente(idcliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





CREATE TABLE IF NOT EXISTS incluye(
  idproducto_producto int(11) NOT NULL,
  idpedido_pedido int(11) NOT NULL,
  precio int(11) NOT NULL,

  PRIMARY KEY(idproducto_producto,idpedido_pedido),
  FOREIGN KEY(idproducto_producto) REFERENCES producto(idproducto),
  FOREIGN KEY(idpedido_pedido) REFERENCES pedido(idpedido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
