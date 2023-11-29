drop DATABASE proje;
CREATE DATABASE  proje;
use proje;

CREATE TABLE IF NOT EXISTS `admin` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `ANAME` varchar(150) NOT NULL,
  `APASS` varchar(150) NOT NULL,
  PRIMARY KEY (`AID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `admin` (`AID`, `ANAME`, `APASS`) VALUES
(1, 'admin', '1234');


CREATE TABLE IF NOT EXISTS calisan (
    calisan_id INT NOT NULL AUTO_INCREMENT,
    cinsiyet char NOT NULL,
    dogum_tarihi DATE NOT NULL,
    isim VARCHAR(30) NOT NULL,
    soyisim VARCHAR(30) NOT NULL,  
    maas INT NOT NULL,
    PRIMARY KEY (calisan_id)
);

CREATE TABLE IF NOT EXISTS calisan_tc (
    calisan_id INT NOT null,
    TC CHAR(11) NOT NULL,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id)
);
    
CREATE TABLE IF NOT EXISTS calisan_mail (
    calisan_id INT NOT null,
    mail VARCHAR(20) NOT NULL,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id)
);

CREATE TABLE IF NOT EXISTS calisan_telefon (
    calisan_id INT NOT null,
    telefon CHAR(11) NOT NULL,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id)
);

 CREATE TABLE IF NOT EXISTS partTime (
    calisan_id INT NOT NULL,
    musaitlik_id CHAR(3),
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id)
);

CREATE TABLE IF NOT EXISTS fullTime (
    calisan_id INT NOT NULL,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id)
);

CREATE TABLE IF NOT EXISTS idari (
    idari_id INT NOT null auto_increment,
    calisan_id INT not null,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id),
    primary key (idari_id)
);

CREATE TABLE IF NOT EXISTS temizlik (
    temizlik_id INT NOT null auto_increment,
    calisan_id INT not null,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id),
    primary key(temizlik_id)
);

CREATE TABLE IF NOT EXISTS ders (
    ders_kodu CHAR(3) NOT NULL,
    ders_adi VARCHAR(15),
    PRIMARY KEY (ders_kodu)
);

CREATE TABLE IF NOT EXISTS ders_saat (
    ders_kodu CHAR(3) NOT NULL,
    ders_saati VARCHAR(15),
    FOREIGN KEY (ders_kodu) REFERENCES ders(ders_kodu),
    PRIMARY KEY (ders_kodu)
);

CREATE TABLE IF NOT EXISTS ogretmen (
    ogretmen_id INT NOT null auto_increment,
    calisan_id INT not null,
    ders_kodu CHAR(3)  not null UNIQUE,
    FOREIGN KEY (calisan_id) REFERENCES calisan(calisan_id),
    FOREIGN KEY (ders_kodu) REFERENCES ders(ders_kodu),
    primary key (ogretmen_id)
);

CREATE TABLE IF NOT EXISTS ogrenci (
    ogrenci_id INT NOT NULL AUTO_INCREMENT,
    cinsiyet CHAR,
    isim VARCHAR(20) NOT NULL,
    soyisim VARCHAR(20) NOT NULL,
    dogum_tarihi DATE NOT NULL,
    PRIMARY KEY (ogrenci_id)
);

create table if not exists mezun(
   ogrenci_id int not null,
   mezun_tarih date not null,
   foreign key (ogrenci_id) references ogrenci(ogrenci_id)
);

create table if not exists aktif (
   ogrenci_id int not null,
   musaitlik_id CHAR(3) NOT NULL,
   foreign key (ogrenci_id) references ogrenci(ogrenci_id)
);
   
CREATE TABLE IF NOT EXISTS veli (
    v_id INT NOT NULL AUTO_INCREMENT,
    ogrenci_id int NOT NULL,
    kimin_nesi varchar(20) not null,
    PRIMARY KEY (v_id),
    foreign key (ogrenci_id) references ogrenci(ogrenci_id)
);

CREATE TABLE IF NOT EXISTS veli_tel (
    v_id INT NOT NULL ,
    tel_no VARCHAR(12) NOT NULL,
    foreign key (v_id) references veli(v_id)
);

CREATE TABLE IF NOT EXISTS veli_mail (
    v_id INT NOT NULL ,
    mail VARCHAR(30) NOT NULL,
    foreign key (v_id) references veli(v_id)
);

cREATE TABLE IF NOT EXISTS veli_isim (
    v_id INT NOT NULL,
    isim VARCHAR(20) NOT NULL,
    soyisim VARCHAR(20) NOT null,
    foreign key (v_id) references veli(v_id)
);

CREATE TABLE IF NOT EXISTS malzeme (
    malzeme_id INT AUTO_INCREMENT NOT NULL,
    stok INT,
    ders_kodu CHAR(3),
    FOREIGN KEY (ders_kodu) REFERENCES ders(ders_kodu),
    PRIMARY KEY (malzeme_id)
);

CREATE TABLE IF NOT EXISTS gider (
    gider_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tarih DATE NOT NULL,
    tur char NOT NULL,
    harcama_turu VARCHAR(20) NOT null,
    miktar int not null
);

CREATE TABLE IF NOT EXISTS ders_alir (
    ogrenci_id INT NOT NULL,
    ders_kodu CHAR(3) NOT NULL,
    FOREIGN KEY (ogrenci_id) REFERENCES ogrenci(ogrenci_id),
    FOREIGN KEY (ders_kodu) REFERENCES ders(ders_kodu)
);


CREATE TABLE IF NOT EXISTS ders_talep (
    ogrenci_id INT NOT NULL,
    ders_adi VARCHAR(15),
    FOREIGN KEY (ogrenci_id) REFERENCES ogrenci(ogrenci_id)
);




CREATE TABLE IF NOT EXISTS maasOdenir (
    calisan_id INT NOT NULL,
    gider_id int not null,
    maas int not null,
    foreign KEY (calisan_id) references calisan(calisan_id),
    foreign KEY (gider_id) references gider(gider_id)
);

CREATE VIEW view_calisan_info AS
SELECT
    calisan_id as calisan_id,
    cinsiyet AS calisan_cinsiyet,
    dogum_tarihi AS calisan_dogum_tarihi,
    isim AS calisan_isim,
    maas AS calisan_maas,
    soyisim AS calisan_soyisim
FROM
    calisan;

CREATE VIEW view_veli_info AS
SELECT
    v.v_id as veli_id,
    v.ogrenci_id as ogrenci_id,
    v.kimin_nesi as kimin_nesi,
    vt.tel_no as veli_tel,
    vm.mail as veli_mail,
    vi.isim AS veli_isim,
    vi.soyisim AS veli_soyisim,
    o.cinsiyet AS ogrenci_cinsiyet,
    o.isim AS ogrenci_isim,
    o.soyisim AS ogrenci_soyisim,
    TIMESTAMPDIFF(YEAR, o.dogum_tarihi, CURDATE()) AS ogrenci_age,
    d.ders_kodu AS ogrenci_ders_kodu,
    d.ders_adi,
    ds.ders_saati
FROM
    veli v
LEFT JOIN veli_tel vt ON v.v_id = vt.v_id
LEFT JOIN veli_mail vm ON v.v_id = vm.v_id
LEFT JOIN veli_isim vi ON v.v_id = vi.v_id
LEFT JOIN ogrenci o ON v.ogrenci_id = o.ogrenci_id
LEFT JOIN ders_alir da ON o.ogrenci_id = da.ogrenci_id
LEFT JOIN ders d ON da.ders_kodu = d.ders_kodu
LEFT JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

CREATE VIEW view_full AS
SELECT c.calisan_id as calisan_id, c.cinsiyet AS calisan_cinsiyet, c.dogum_tarihi AS calisan_dogum_tarihi,
    c.isim AS calisan_isim, c.maas AS calisan_maas,c.soyisim AS calisan_soyisim
FROM calisan AS c JOIN fullTime AS f ON c.calisan_id = f.calisan_id;

CREATE VIEW view_part AS
SELECT c.calisan_id as calisan_id, c.cinsiyet AS calisan_cinsiyet, c.dogum_tarihi AS calisan_dogum_tarihi,
    c.isim AS calisan_isim, c.maas AS calisan_maas, c.soyisim AS calisan_soyisim
FROM calisan AS c JOIN partTime AS p ON c.calisan_id = p.calisan_id;

CREATE VIEW view_ogretmen AS
SELECT o.calisan_id as calisan_id, d.ders_kodu as ders_kodu, d.ders_adi as ders_adi, ds.ders_saati as ders_saat 
FROM ogretmen o
JOIN ders d ON o.ders_kodu = d.ders_kodu
JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

CREATE VIEW view_ogrenci AS
SELECT o.ogrenci_id, d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ogrenci o
JOIN ders_alir da ON o.ogrenci_id = da.ogrenci_id
JOIN ders d ON da.ders_kodu = d.ders_kodu
JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;


CREATE VIEW view_ders AS
SELECT d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ders d
JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

CREATE VIEW view_ogretmen_info AS
SELECT o.ogretmen_id, o.calisan_id, c.isim AS calisan_isim, c.soyisim AS calisan_soyisim, 
    c.cinsiyet AS calisan_cinsiyet, c.dogum_tarihi AS calisan_dogum_tarihi,
    c.maas AS calisan_maas, d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ogretmen o
LEFT OUTER JOIN calisan c ON o.calisan_id = c.calisan_id
LEFT OUTER JOIN ders d ON o.ders_kodu = d.ders_kodu
LEFT OUTER JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

CREATE VIEW view_idari_info AS
SELECT o.idari_id, o.calisan_id, c.isim AS calisan_isim, c.soyisim AS calisan_soyisim, 
    c.cinsiyet AS calisan_cinsiyet, c.dogum_tarihi AS calisan_dogum_tarihi,
    c.maas AS calisan_maas
FROM idari o
LEFT OUTER JOIN calisan c ON o.calisan_id = c.calisan_id;

CREATE VIEW view_temizlik_info AS
SELECT o.temizlik_id, o.calisan_id, c.isim AS calisan_isim, c.soyisim AS calisan_soyisim, 
    c.cinsiyet AS calisan_cinsiyet, c.dogum_tarihi AS calisan_dogum_tarihi,
    c.maas AS calisan_maas
FROM temizlik o
LEFT OUTER JOIN calisan c ON o.calisan_id = c.calisan_id;

CREATE VIEW view_ogrenci_info AS
SELECT
    o.ogrenci_id,
    o.cinsiyet AS ogrenci_cinsiyet,
    o.isim AS ogrenci_isim,
    o.soyisim AS ogrenci_soyisim,
    o.dogum_tarihi AS ogrenci_dogum_tarihi,
    TIMESTAMPDIFF(YEAR, o.dogum_tarihi, CURDATE()) AS ogrenci_age,
    d.ders_kodu AS ogrenci_ders_kodu,
    d.ders_adi,
    ds.ders_saati
FROM
    ogrenci o
LEFT OUTER JOIN ders_alir da ON o.ogrenci_id = da.ogrenci_id
LEFT OUTER JOIN ders d ON da.ders_kodu = d.ders_kodu
LEFT OUTER JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;


CREATE VIEW view_mezun AS
SELECT o.ogrenci_id,
    o.cinsiyet AS ogrenci_cinsiyet,
    o.isim AS ogrenci_isim,
    o.soyisim AS ogrenci_soyisim,
    o.dogum_tarihi AS ogrenci_dogum_tarihi,
    TIMESTAMPDIFF(YEAR, o.dogum_tarihi, CURDATE()) AS ogrenci_age,
    m.mezun_tarih
FROM ogrenci o
Natural JOIN mezun m;


CREATE VIEW view_aktif AS
SELECT o.ogrenci_id,
    o.cinsiyet AS ogrenci_cinsiyet,
    o.isim AS ogrenci_isim,
    o.soyisim AS ogrenci_soyisim,
    o.dogum_tarihi AS ogrenci_dogum_tarihi,
    TIMESTAMPDIFF(YEAR, o.dogum_tarihi, CURDATE()) AS ogrenci_age,
    d.ders_kodu AS ders_kodu
FROM ogrenci o
Natural JOIN aktif a
join ders_alir d; 



CREATE VIEW ders_acilacak AS
SELECT ders_adi, COUNT(ders_adi) AS ders_count
FROM ders_talep
GROUP BY ders_adi
HAVING COUNT(ders_adi) > 0;

select * from ders_acilacak ;

INSERT INTO ders (ders_kodu, ders_adi)
VALUES 
    ('Mat', 'Matematik'),
    ('Fiz', 'Fizik'),
    ('Kim ', 'Kimya'),
    ('Rob', 'Robotik'),
    ('Bio', 'Biyoloji');

INSERT INTO ogrenci (cinsiyet, isim, soyisim, dogum_tarihi) VALUES
('E', 'John', 'Doe', '2000-01-05'),
('K', 'Jane', 'Smith', '1999-04-12'),
('E', 'Michael', 'Johnson', '2001-07-20'),
('K', 'Emily', 'Williams', '2000-11-15'),
('E', 'Daniel', 'Brown', '1999-02-28'),
('K', 'Olivia', 'Jones', '2001-09-08'),
('E', 'William', 'Davis', '2000-06-03'),
('K', 'Ella', 'Miller', '1999-12-10'),
('E', 'Matthew', 'Moore', '2001-03-25'),
('K', 'Sophia', 'Anderson', '2000-08-18');

INSERT INTO calisan (cinsiyet, dogum_tarihi, isim, soyisim , maas) VALUES
('E', '1985-03-10', 'Ahmet', 'Yılmaz', 1000),
('K', '1990-07-22', 'Ayşe', 'Kaya', 2888),
('E', '1988-11-05', 'Mehmet', 'Demir', 400),
('K', '1995-04-15', 'Fatma', 'Öztürk', 2888),
('E', '1987-09-28', 'Mustafa', 'Arslan',245),
('K', '1993-01-12', 'Zeynep', 'Çelik',7654),
('E', '1986-06-20', 'Ali', 'Şahin',36),
('K', '1991-12-08', 'Sema', 'Koç',856),
('E', '1989-02-18', 'Burak', 'Turan',6754),
('K', '1994-08-03', 'Esra', 'Aksoy',7685);

INSERT INTO ogretmen (calisan_id, ders_kodu) VALUES
(1, 'MAT'),
(4, 'BIO'),
(7, 'kim');

INSERT INTO temizlik (calisan_id) VALUES
(3),
(6),
(9);

INSERT INTO idari (calisan_id) VALUES
(2),
(5),
(8),
(10);

INSERT INTO `ders_saat` (`ders_kodu`, `ders_saati`) VALUES
('Bio', '110'),
('Mat', '212');

INSERT INTO `ders_alir` (`ogrenci_id`, `ders_kodu`) VALUES
(1, 'Fiz'),
(7, 'Mat');

INSERT INTO `ders_talep` (`ogrenci_id`, `ders_adi`) VALUES
(1, 'internet'),
(7, 'veri');

DELIMITER //
CREATE TRIGGER derse_malzeme_ekleyici AFTER INSERT 
ON ders
FOR EACH ROW
INSERT INTO malzeme (stok, ders_kodu)
VALUES (10, new.ders_kodu);//
DELIMITER ;

DELIMITER //
CREATE TRIGGER giderde_tarih_guncelleyici 
BEFORE INSERT ON gider
FOR EACH ROW
BEGIN
    IF NEW.tur = 's' THEN
        SET NEW.tarih = NOW();
    END IF;
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER calisana_gider_ekle
BEFORE INSERT ON calisan 
FOR EACH ROW
begin 
    DECLARE maas_value INT;
    set maas_value = null;
    INSERT INTO gider (tarih, tur, harcama_turu, miktar)
    VALUES (NOW(), 's', 'maaş', maas_value);
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER gidere_maas_ekle
AFTER INSERT ON maasOdenir
FOR EACH ROW
BEGIN
    DECLARE maas_value INT;
    SET maas_value = NEW.maas;

    UPDATE gider
    SET miktar = maas_value
    WHERE gider_id = NEW.gider_id;
END;//
DELIMITER ;
