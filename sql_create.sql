-- drop DATABASE proje;
-- CREATE DATABASE  proje;
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
    harcama_turu VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS ders_alir (
    ogrenci_id INT NOT NULL,
    ders_kodu CHAR(3) NOT NULL,
    FOREIGN KEY (ogrenci_id) REFERENCES ogrenci(ogrenci_id),
    FOREIGN KEY (ders_kodu) REFERENCES ders(ders_kodu)
);


CREATE TABLE IF NOT EXISTS ders_talep (
    ogrenci_id INT NOT NULL,
    ders_kodu CHAR(3) NOT NULL,
    FOREIGN KEY (ogrenci_id) REFERENCES ogrenci(ogrenci_id)
);
CREATE VIEW ders_acilacak AS
SELECT d.ders_adi
FROM ders_talep dt join ders d on dt.ders_kodu = d.ders_kodu 
group BY(d.ders_adi)
HAVING COUNT(d.ders_adi) > 4;


CREATE TABLE IF NOT EXISTS maasOdenir (
    calisan_id INT NOT NULL,
    gider_id int not null,
    maas int not null,
    foreign KEY (calisan_id) references calisan(calisan_id),
    foreign KEY (gider_id) references gider(gider_id)
);


CREATE VIEW view_ogretmen AS
SELECT o.calisan_id, d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ogretmen o
LEFT OUTER  JOIN ders d ON o.ders_kodu = d.ders_kodu
LEFT OUTER JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

CREATE VIEW view_ogrenci AS
SELECT o.ogrenci_id, d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ogrenci o
LEFT OUTER JOIN ders_alir da ON o.ogrenci_id = da.ogrenci_id
LEFT OUTER JOIN ders d ON da.ders_kodu = d.ders_kodu
LEFT OUTER JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;


CREATE VIEW view_ders AS
SELECT d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ders d
Left outer JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

CREATE VIEW view_ogretmen_info AS
SELECT o.ogretmen_id, o.calisan_id, c.isim AS calisan_isim, c.soyisim AS calisan_soyisim, 
    c.cinsiyet AS calisan_cinsiyet, c.dogum_tarihi AS calisan_dogum_tarihi,
    d.ders_kodu, d.ders_adi, ds.ders_saati
FROM ogretmen o
LEFT OUTER JOIN calisan c ON o.calisan_id = c.calisan_id
LEFT OUTER JOIN ders d ON o.ders_kodu = d.ders_kodu
LEFT OUTER JOIN ders_saat ds ON d.ders_kodu = ds.ders_kodu;

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

show tables from proje;