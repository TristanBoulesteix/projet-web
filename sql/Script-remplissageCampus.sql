#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Pojet-web-users.CAMPUS
#------------------------------------------------------------

CREATE TABLE Pojet_web_users.CAMPUS(
        id_campus   Int  Auto_increment  NOT NULL ,
        name_campus Varchar (255) NOT NULL
	,CONSTRAINT Pojet_web_users.CAMPUS_PK PRIMARY KEY (id_campus)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pojet-web-users.USER
#------------------------------------------------------------

CREATE TABLE Pojet_web_users.USER(
        id_user         Int  Auto_increment  NOT NULL ,
        first_name_user Varchar (255) NOT NULL ,
        last_name_user  Varchar (255) NOT NULL ,
        password_user   Varchar (255) NOT NULL ,
        email_user      Varchar (255) NOT NULL ,
        status_user     Varchar (255) NOT NULL ,
        id_campus       Int NOT NULL
	,CONSTRAINT Pojet_web_users.USER_PK PRIMARY KEY (id_user)

	,CONSTRAINT Pojet_web_users.USER_Pojet_web_users.CAMPUS_FK FOREIGN KEY (id_campus) REFERENCES Pojet_web_users.CAMPUS(id_campus)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pojet-web.EVENTS
#------------------------------------------------------------

CREATE TABLE Pojet_web.EVENTS(
        id_event          Int  Auto_increment  NOT NULL ,
        description_event Varchar (255) NOT NULL ,
        image_event       Varchar (255) NOT NULL ,
        date_event        Date NOT NULL ,
        type_event        Varchar (255) NOT NULL ,
        cost_event        Int NOT NULL ,
        id_campus         Int NOT NULL
	,CONSTRAINT Pojet_web.EVENTS_PK PRIMARY KEY (id_event)

	,CONSTRAINT Pojet_web.EVENTS_Pojet_web_users.CAMPUS_FK FOREIGN KEY (id_campus) REFERENCES Pojet_web_users.CAMPUS(id_campus)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pojet-web.CATEGORIES
#------------------------------------------------------------

CREATE TABLE Pojet_web.CATEGORIES(
        id_categoriy   Int  Auto_increment  NOT NULL ,
        name_categorie Varchar (255) NOT NULL
	,CONSTRAINT Pojet_web.CATEGORIES_PK PRIMARY KEY (id_categoriy)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pojet-web.PRODUCT
#------------------------------------------------------------

CREATE TABLE Pojet_web.PRODUCT(
        id_product          Int  Auto_increment  NOT NULL ,
        name_product        Varchar (255) NOT NULL ,
        description_product Varchar (255) NOT NULL ,
        price_product       Varchar (255) NOT NULL ,
        id_categoriy        Int NOT NULL ,
        id_campus           Int NOT NULL
	,CONSTRAINT Pojet_web.PRODUCT_PK PRIMARY KEY (id_product)

	,CONSTRAINT Pojet_web.PRODUCT_Pojet_web.CATEGORIES_FK FOREIGN KEY (id_categoriy) REFERENCES Pojet_web.CATEGORIES(id_categoriy)
	,CONSTRAINT Pojet_web.PRODUCT_Pojet_web_users.CAMPUS0_FK FOREIGN KEY (id_campus) REFERENCES Pojet_web_users.CAMPUS(id_campus)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Pojet-web.IDEAS
#------------------------------------------------------------

CREATE TABLE Pojet_web.IDEAS(
        id_idea          Int  Auto_increment  NOT NULL ,
        name_idea        Varchar (255) NOT NULL ,
        description_idea Varchar (255) NOT NULL ,
        image_idea       Varchar (255) NOT NULL ,
        votes_idea       Int NOT NULL ,
        id_campus        Int NOT NULL
	,CONSTRAINT Pojet_web.IDEAS_PK PRIMARY KEY (id_idea)

	,CONSTRAINT Pojet_web.IDEAS_Pojet_web_users.CAMPUS_FK FOREIGN KEY (id_campus) REFERENCES Pojet_web_users.CAMPUS(id_campus)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: participate
#------------------------------------------------------------

CREATE TABLE participate(
        id_event Int NOT NULL ,
        id_user  Int NOT NULL
	,CONSTRAINT participate_PK PRIMARY KEY (id_event,id_user)

	,CONSTRAINT participate_Pojet_web.EVENTS_FK FOREIGN KEY (id_event) REFERENCES Pojet_web.EVENTS(id_event)
	,CONSTRAINT participate_Pojet_web_users.USER0_FK FOREIGN KEY (id_user) REFERENCES Pojet_web_users.USER(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: propose
#------------------------------------------------------------

CREATE TABLE propose(
        id_idea Int NOT NULL ,
        id_user Int NOT NULL
	,CONSTRAINT propose_PK PRIMARY KEY (id_idea,id_user)

	,CONSTRAINT propose_Pojet_web.IDEAS_FK FOREIGN KEY (id_idea) REFERENCES Pojet_web.IDEAS(id_idea)
	,CONSTRAINT propose_Pojet_web_users.USER0_FK FOREIGN KEY (id_user) REFERENCES Pojet_web_users.USER(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: order
#------------------------------------------------------------

CREATE TABLE order(
        id_product Int NOT NULL ,
        id_user    Int NOT NULL
	,CONSTRAINT order_PK PRIMARY KEY (id_product,id_user)

	,CONSTRAINT order_Pojet_web.PRODUCT_FK FOREIGN KEY (id_product) REFERENCES Pojet_web.PRODUCT(id_product)
	,CONSTRAINT order_Pojet_web_users.USER0_FK FOREIGN KEY (id_user) REFERENCES Pojet_web_users.USER(id_user)
)ENGINE=InnoDB;

