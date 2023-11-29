# BIL372-Project-

Gereksinim Analizi:

Kullanıcı Yetkileri:
  Sisteme giriş yapmak için kullanıcı adı ve şifre gereklidir.
  Yalnızca yetkilendirilmiş yönetici (admin) kullanıcılar bu sisteme erişebilir.
  
Çalışan Bilgileri:
  Sistemde çalışanlar için temel bilgiler (isim, soyisim, cinsiyet, doğum tarihi, maaş) saklanmalıdır.
  Çalışanlar part-time veya full-time olarak işe alınabilmelir.
  Part-time çalışanların müsaitlik bilgileri (musaitlik_id) bulunmalıdır.
  İdari ve temizlik personeli ayrı tablolarda saklanmalıdır.
  
Öğrenci Bilgileri:
  Öğrenci bilgileri (isim, soyisim, cinsiyet, doğum tarihi) tutulmalıdır.
  Mezun olan öğrencilerin mezuniyet tarihleri kaydedilmelidir.
  Aktif öğrencilerin müsaitlik bilgileri (musaitlik_id) bulunmalıdır.
  
Veli Bilgileri:
  Veli bilgileri (isim, soyisim, telefon numarası, e-posta) saklanmalıdır.
  Veli bilgileri, ilgili öğrenci ile ilişkilendirilmelidir.
  
Ders Bilgileri:
  Derslerin temel bilgileri (ders adı, ders kodu) tutulmalıdır.
  Ders saatleri (ders_saati) bilgileri ayrı bir tabloda saklanmalıdır.
  Öğretmenler, dersleri öğretebilmek için ilgili derslere atanmalıdır.
  
Materiyal ve Gider Bilgileri:
  Kullanılabilir malzemelerin (stok miktarı, ders kodu) bilgileri saklanmalıdır.
  Gider bilgileri (tarih, harcama türü, miktar) kaydedilmelir.
  
Öğrenci-Ders İlişkileri:
  Öğrencilerin aldığı dersler ve bu derslere ait saat bilgileri tutulmalıdır.
  Talep edilen derslerin (ders_talep) listesi bulunmalıdır.
  
Maaş Bilgileri:
  Çalışanlara ödenen maaşların bilgileri (maasOdenir) kaydedilmelidir.
  
Raporlama ve İstatistik:
  Çalışanlar, öğrenciler, dersler, veliler ve maaşlar gibi temel veri setleri üzerinden raporlar alınmalıdır.
  Öğrenci ve veli bilgileri ile derslere katılım bilgileri arasında ilişki kurularak detaylı raporlar alınmalıdır.
  
Güvenlik:
  Veritabanına erişim, sadece yetkilendirilmiş kullanıcılar tarafından yapılabilmelidir.
  Kullanıcı şifreleri güvenli bir şekilde saklanmalıdır.
  
View'lar:
  View'lar, kullanıcıların belirli bilgileri daha kolay ve anlamlı bir şekilde görmelerini sağlamak için oluşturulmalıdır.
  
Talep Edilen Derslerin Durumu:
  Ders talepleri (ders_talep) üzerinden hangi derslerin açılacağına dair bilgiler elde edilebilmelidir.

ASSUMPTIONLAR:
Bir dersin tek subesi vardir.
Ogretmen birden fazla ders veremez. Dersleri tek hoca acar.
Ders donemde tektir.
Veli tel ve mail en fazla 1 tane var.
Dersler tek gun 2 saat olarak islenir.
Stok derslere ozgu. Birden fazla ders ayni malzemeyi kullkanamaz.
Öğrenci okuldan ya mezun olur ya da aktiftir. atılamaz.
Ögretmen, temizlik ve idari harici calisan yoktur.
Her dersin sınıfı bellidir ve bir sınıfta çakışma olmaz.
Dersler iki saat sürer. 
