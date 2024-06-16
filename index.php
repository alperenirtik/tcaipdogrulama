<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>TC Kimlik No Doğrulama (POST METHODU İLE)</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .form-control {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">TC Kimlik No Doğrulama (POST METHODU İLE)</h2>
		
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="tcno">TC Kimlik No *</label>
                <input type="text" class="form-control" id="tcno" name="tcno" placeholder="TC Kimlik No" required>
            </div>
            <div class="form-group">
                <label for="ad">Ad *</label>
                <input type="text" class="form-control" id="ad" name="ad" placeholder="Ad" required>
                <small id="adHelp" class="form-text text-muted">Büyük harflerle yazılması zorunludur.</small>
            </div>
            <div class="form-group">
                <label for="soyad">Soyad *</label>
                <input type="text" class="form-control" id="soyad" name="soyad" placeholder="Soyad" required>
                <small id="soyadHelp" class="form-text text-muted">Büyük harflerle yazılması zorunludur.</small>
            </div>
            <div class="form-group">
                <label for="dogumyili">Doğum Yılı *</label>
                <input type="text" class="form-control" id="dogumyili" name="dogumyili" placeholder="Doğum Yılı" required>
            </div>
            <button type="submit" class="btn btn-primary">Doğrula</button>
        </form>

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

        // Formdan gelen verileri işleme
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tcKimlikNo = $_POST['tcno'];
            $isim = strtoupper($_POST['ad']); // İsim büyük harflerle
            $soyisim = strtoupper($_POST['soyad']); // Soyisim büyük harflerle
            $dogumYili = $_POST['dogumyili'];

            // TC Kimlik No doğrulama fonksiyonunu çağırma
            $sonuc = tcdogrula($tcKimlikNo, $isim, $soyisim, $dogumYili);

            // Sonucu kontrol etme ve mesajı yazdırma
            if ($sonuc == "true") {
                echo '<div class="alert alert-success mt-3" role="alert">Doğrulama başarılı</div>';
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">Doğrulama başarısız</div>';
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS ve jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
