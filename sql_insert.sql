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

INSERT INTO calisan (cinsiyet, dogum_tarihi, isim, soyisim) VALUES
('E', '1985-03-10', 'Ahmet', 'Yılmaz'),
('K', '1990-07-22', 'Ayşe', 'Kaya'),
('E', '1988-11-05', 'Mehmet', 'Demir'),
('K', '1995-04-15', 'Fatma', 'Öztürk'),
('E', '1987-09-28', 'Mustafa', 'Arslan'),
('K', '1993-01-12', 'Zeynep', 'Çelik'),
('E', '1986-06-20', 'Ali', 'Şahin'),
('K', '1991-12-08', 'Sema', 'Koç'),
('E', '1989-02-18', 'Burak', 'Turan'),
('K', '1994-08-03', 'Esra', 'Aksoy');

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
