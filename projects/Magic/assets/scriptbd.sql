CREATE TABLE usuario (
    login       varchar(20),
    pass        varchar(20),
    nombre      varchar(20),
    apellido    varchar(20),
    genero      char(1),
    fecha_nac   date,
    CONSTRAINT pk_usuario PRIMARY KEY(login)
);

CREATE TABLE equipo (
    id          serial,
    idestadio   integer, /* referencia a estadio */
    nombre      varchar(30),
    siglas      char(4),
    fecha_fun   date,
    CONSTRAINT pk_equipo PRIMARY KEY(id)
);

CREATE TABLE roster (
    loginusuario   varchar(20),
    idliga         integer, /* referencia a liga */
    nombre         varchar(30),
    puntos         smallint,
    fecha_cre      date,
    CONSTRAINT pk_roster PRIMARY KEY(loginusuario,idliga),
    CONSTRAINT fk_roster_usuario FOREIGN KEY(loginusuario) REFERENCES usuario
);

CREATE TABLE administrador (
    loginusuario   varchar(20),
    CONSTRAINT pk_administrador PRIMARY KEY(loginusuario),
    CONSTRAINT fk_administrador_usuario FOREIGN KEY(loginusuario) REFERENCES usuario
);

CREATE TABLE manager (
    loginusuario   varchar(20),
    CONSTRAINT pk_manager PRIMARY KEY(loginusuario),
    CONSTRAINT fk_manager_usuario FOREIGN KEY(loginusuario) REFERENCES usuario
);

CREATE TABLE jugador (
    id          serial,
    idequipo    integer,
    nombre      varchar(20),
    apellido    varchar(20),
    numero      smallint,
    posicion    varchar(20),
    fecha_nac   date,
    CONSTRAINT pk_jugador PRIMARY KEY(id),
    /* CONSTRAINT u1_jugador UNIQUE(idequipo,numero), */
    CONSTRAINT fk_jugador_equipo FOREIGN KEY(idequipo) REFERENCES equipo
);

CREATE TABLE estadistica_bateo (
    idjugador   integer,
    fecha       date,
    ci          smallint,
    ca          smallint,
    tb          smallint,
    br          smallint,
    bb          smallint,
    k           smallint,
    e           smallint,
    CONSTRAINT pk_estadistica_bateo PRIMARY KEY(idjugador,fecha),
    CONSTRAINT fk_estadistica_bateo_jugador FOREIGN KEY(idjugador) REFERENCES jugador
);

CREATE TABLE estadistica_pitcheo (
    idjugador   integer,
    fecha       date,
    sl          smallint,
    cl          smallint,
    i           smallint,
    bb          smallint,
    k           smallint,
    jg          smallint,
    CONSTRAINT pk_estadistica_pitcheo PRIMARY KEY(idjugador,fecha),
    CONSTRAINT fk_estadistica_pitcheo_jugador FOREIGN KEY(idjugador) REFERENCES jugador
);

CREATE TABLE vende (
    loginmanager   varchar(20),
    idjugador      integer,
    fecha          date, /* ¿no se debe colocar fecha? */
    CONSTRAINT pk_vende PRIMARY KEY(loginmanager,idjugador),
    CONSTRAINT fk_vende_manager FOREIGN KEY(loginmanager) REFERENCES manager,
    CONSTRAINT fk_vende_jugador FOREIGN KEY(idjugador) REFERENCES jugador
);

CREATE TABLE compra (
    loginmanager   varchar(20),
    idjugador      integer,
    fecha          date, /* ¿no se debe colocar fecha? */
    CONSTRAINT pk_compra PRIMARY KEY(loginmanager,idjugador),
    CONSTRAINT fk_compra_manager FOREIGN KEY(loginmanager) REFERENCES manager,
    CONSTRAINT fk_compra_jugador FOREIGN KEY(idjugador) REFERENCES jugador
);

CREATE TABLE tiene2 (
    loginusuario   varchar(20),
    idliga         integer,
    idjugador      integer,
    CONSTRAINT pk_tiene2 PRIMARY KEY(loginusuario,idliga,idjugador),
    CONSTRAINT fk_tiene2_roster FOREIGN KEY(loginusuario,idliga) REFERENCES roster,
    CONSTRAINT fk_tiene2_jugador FOREIGN KEY(idjugador) REFERENCES jugador
);
