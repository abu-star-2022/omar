<?php
// تحقق من الحقول المطلوبة (التي تحمل علامة *)
if (
    empty($_POST['name']) || 
    empty($_POST['email']) || 
    empty($_POST['uw_aanvraag']) || 
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    http_response_code(500);
    exit();
}

// تنظيف القيم المدخلة
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$adres = isset($_POST['adres']) ? strip_tags(htmlspecialchars($_POST['adres'])) : '';
$postcode = isset($_POST['postcode']) ? strip_tags(htmlspecialchars($_POST['postcode'])) : '';
$woonplaats = isset($_POST['woonplaats']) ? strip_tags(htmlspecialchars($_POST['woonplaats'])) : '';
$telefoonnummer = isset($_POST['telefoonnummer']) ? strip_tags(htmlspecialchars($_POST['telefoonnummer'])) : '';
$uw_aanvraag = strip_tags(htmlspecialchars($_POST['uw_aanvraag']));

// إعداد رسالة البريد الإلكتروني
$to = "omartaktok@gmail.com"; // غير هذا البريد إلى بريدك الحقيقي
$subject = "Nieuwe aanvraag van $name";
$body = "U heeft een nieuwe aanvraag ontvangen van uw website contactformulier.\n\n".
        "Hier zijn de details:\n\n".
        "Naam: $name\n".
        "E-mailadres: $email\n".
        "Adres: $adres\n".
        "Postcode: $postcode\n".
        "Woonplaats: $woonplaats\n".
        "Telefoonnummer: $telefoonnummer\n\n".
        "Uw aanvraag:\n$uw_aanvraag";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// إرسال البريد الإلكتروني
if(!mail($to, $subject, $body, $headers)) {
    http_response_code(500);
}
?>
