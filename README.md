# TC Kimlik Numarası Doğrulama PHP

Bu proje, Türkiye Cumhuriyeti'nin resmi TC Kimlik No doğrulama hizmetini sağlayan [TC Kimlik No Doğrula API servisi](http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula) kullanarak TC Kimlik numarası doğrulaması yapmayı amaçlamaktadır. Kullanıcıya HTML formu üzerinden TC Kimlik numarası, ad, soyad ve doğum yılı gibi bilgileri girmesi için bir arayüz sunar. Form, bu bilgileri PHP aracılığıyla sunucuya POST eder. Dilerseniz `API.php` dosyası aracılığı GET methodu ile kullanabilirsiniz.

## İşleyiş

1. **HTML Formu**: Kullanıcıya TC Kimlik numarası, ad, soyad ve doğum yılı alanlarını doldurması için bir form sunar.
   
2. **POST Metodu**: Kullanıcının girdiği bilgileri PHP aracılığıyla sunucuya POST eder.
   
3. **SOAP İsteği Oluşturma**: Girilen bilgileri içeren SOAP isteği oluşturulur ve TC Kimlik numarası doğrulama servisine gönderilir.
   
4. **cURL ile API İsteği Gönderme**: Oluşturulan SOAP isteği, cURL kullanılarak Nüfus ve Vatandaşlık İşleri Genel Müdürlüğü'nün sunucusuna iletilir.
   
5. **Cevap Alma ve İşleme**: Sunucudan gelen cevap başarılı veya başarısız doğrulama işlemini belirten bir metin içerir.
   
6. **Kullanıcı Geri Bildirimi**: İşlem sonucuna göre kullanıcıya doğrulama başarılı veya başarısız mesajı gösterilir.

## GET Metodu Kullanımı

`API.php` dosyası, TC Kimlik numarası doğrulama işlemini GET metoduyla gerçekleştirir. Kullanıcıdan TC Kimlik numarası, ad, soyad ve doğum yılı gibi bilgileri URL üzerinden GET parametreleri olarak alır. Ardından bu bilgileri kullanarak SOAP formatında bir istek oluşturur ve cURL ile API'ye gönderir.

### Get Methodu Örnek:
`localhost/api.php?tcno=00000000000&ad=AD&soyad=SOYAD&dogumyili=1990`

### İşleyiş

1. **Parametreleri Alma**: URL üzerinden gelen parametreleri `$_GET` global değişkeniyle alır.
   
2. **SOAP İsteği Oluşturma**: Alınan parametrelerle SOAP formatında bir istek oluşturulur.
   
3. **cURL ile API İsteği Gönderme**: Oluşturulan SOAP isteği, cURL kullanılarak ilgili sunucuya iletilir.
   
4. **Cevap Alma ve İşleme**: Sunucudan gelen cevap doğrulama işleminin başarılı veya başarısız olduğunu belirtir.
   
5. **Sonucun Gösterilmesi**: Doğrulama işleminin sonucuna göre kullanıcıya başarılı veya başarısız mesajı gösterilir.

---

Bu proje, Alperen İrtik tarafından geliştirilmiş olup, herkesin kullanımına açıktır ve TC Kimlik numarası doğrulama işlemlerini hızlı ve güvenilir bir şekilde gerçekleştirmeyi sağlar.
