# tcaipdogrulama
Bu proje, Türkiye Cumhuriyeti'nin resmi TC Kimlik No doğrulama hizmetini sağlayan http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula API servisini kullanarak TC Kimlik numarası doğrulaması yapmaktadır. HTML formu üzerinden POST metoduyla kullanıcıdan TC Kimlik numarası, ad, soyad ve doğum yılı gibi bilgileri alır ve bu bilgileri SOAP (Simple Object Access Protocol) isteği olarak API'ye gönderir.

İşleyiş şu adımları içerir:

HTML Formu: Kullanıcıya TC Kimlik numarası, ad, soyad ve doğum yılı alanlarını doldurması için bir form sunar.
POST Metodu: Form, kullanıcının bilgilerini PHP aracılığıyla sunucuya POST eder.
SOAP İsteği Oluşturma: Girilen bilgileri içeren SOAP isteği oluşturulur. Bu istek, TC Kimlik numarası doğrulama servisine gönderilir.
CURL İle API İstemi Gönderme: Oluşturulan SOAP isteği, cURL kullanılarak Türkiye Cumhuriyeti Nüfus ve Vatandaşlık İşleri Genel Müdürlüğü'nün sunucusuna iletilir.

Cevap Alma ve İşleme: Sunucudan gelen cevap alınır ve bu cevap doğrulama işleminin başarılı mı yoksa başarısız mı olduğunu belirten bir metin içerir.
Kullanıcıya Geri Bildirim: İşlem sonucuna göre kullanıcıya başarılı veya başarısız doğrulama mesajı gösterilir.
Bu proje, Alperen İrtik tarafından geliştirilmiş olup, herkese açık bir şekilde kullanılabilir. Kullanıcıların TC Kimlik numaralarını doğrulamak için kullanabilecekleri basit ve etkili bir çözüm sunar.

Genel olarak, projenin amacı kullanıcıların girdikleri bilgilerle TC Kimlik numaralarını doğrulayabilmesini sağlamak ve bu işlemi güvenilir bir şekilde yapabilmek için resmi devlet hizmeti olan API'yi kullanmaktır.

GET METHODU KULLANIMI:

API.php dosyası, TC Kimlik numarası doğrulama işlemini GET metoduyla gerçekleştirmek üzere tasarlanmıştır. Bu dosya, kullanıcılardan TC Kimlik numarası, ad, soyad ve doğum yılı gibi bilgileri GET parametreleri olarak alır, ardından bu bilgileri kullanarak TC Kimlik No doğrulama API'sine SOAP isteği yapar.

İşleyiş şu adımları içerir:

Parametreleri Alma: $_GET global değişkeniyle URL üzerinden gelen parametreleri alır.
SOAP İsteği Oluşturma: tcdogrula fonksiyonu, aldığı parametreleri kullanarak SOAP formatında bir istek oluşturur.
CURL ile API İstemi Gönderme: Oluşturulan SOAP isteği, cURL kullanılarak Türkiye Cumhuriyeti Nüfus ve Vatandaşlık İşleri Genel Müdürlüğü'nün sunucusuna iletilir.

Cevap Alma ve İşleme: Sunucudan gelen cevap alınır ve bu cevap doğrulama işleminin başarılı mı yoksa başarısız mı olduğunu belirten bir metin içerir.
Sonucun Gösterilmesi: Doğrulama işleminin sonucuna göre ekrana başarılı veya başarısız mesajı yazdırılır.

Örnek kullanım:
GET parametrelerini aşağıdaki şekilde kullanarak API'yi çağırabilirsiniz:
/api.php?tcno=00000000000&ad=AD&soyad=SOYAD&dogumyili=1990

Bu örnekte tcno, ad, soyad ve dogumyili parametreleri, TC Kimlik numarası doğrulama işlemi için gerekli bilgileri temsil eder. Bu bilgileri değiştirerek veya ekleyerek isteğinizi özelleştirebilirsiniz.

API.php dosyası, kullanımı kolay bir doğrulama aracı olarak tasarlanmış olup, herkesin kullanımına açıktır ve GET metodunu kullanarak hızlı bir şekilde TC Kimlik numarası doğrulaması yapılmasını sağlar.
