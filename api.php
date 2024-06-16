<?php

function tcdogrula($tcKimlikNo, $isim, $soyisim, $dogumYili) {
    // SOAP isteği oluşturma
    $soapRequest = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                   xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                   xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
                <TCKimlikNo>'.$tcKimlikNo.'</TCKimlikNo>
                <Ad>'.$isim.'</Ad>
                <Soyad>'.$soyisim.'</Soyad>
                <DogumYili>'.$dogumYili.'</DogumYili>
            </TCKimlikNoDogrula>
        </soap:Body>
    </soap:Envelope>';

    // CURL ayarları
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Geçici olarak SSL sertifikası doğrulamasını devre dışı bırak
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'POST /Service/KPSPublic.asmx HTTP/1.1',
        'Host: tckimlik.nvi.gov.tr',
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
        'Content-Length: '.strlen($soapRequest)
    ));

    // SOAP isteğini gönderme ve cevabı alma
    $response = curl_exec($ch);
    curl_close($ch);

    // Cevabı temizleme ve geri döndürme
    return strip_tags($response);
}

// GET parametrelerini al
if (isset($_GET['tcno'], $_GET['ad'], $_GET['soyad'], $_GET['dogumyili'])) {
    $tcKimlikNo = $_GET['tcno'];
    $isim = strtoupper($_GET['ad']); // İsim büyük harflerle
    $soyisim = strtoupper($_GET['soyad']); // Soyisim büyük harflerle
    $dogumYili = $_GET['dogumyili'];

    // TC Kimlik No doğrulama fonksiyonunu çağırma
    $sonuc = tcdogrula($tcKimlikNo, $isim, $soyisim, $dogumYili);

    // Sonucu kontrol etme ve mesajı yazdırma
    if ($sonuc == "true") {
        echo "Doğrulama başarılı";
    } else {
        echo "Doğrulama başarısız";
    }
} else {
    // Eksik parametre hatası
    echo "TC Kimlik No, ad, soyad ve doğum yılı parametreleri eksik.
	<br> <b>Get Method Örnek Kullanım:</b> /api.php?tcno=00000000000&ad=AD&soyad=SOYAD&dogumyili=2000 ";
}
?>
