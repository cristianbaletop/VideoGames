<?php

require('pdf/tcpdf.php');

$first = TCPDF_FONTS::addTTFfont('f.ttf', 'TrueTypeUnicode', '', 96);
$second = TCPDF_FONTS::addTTFfont('s.ttf', 'TrueTypeUnicode', '', 96);
$third = TCPDF_FONTS::addTTFfont('t.ttf', 'TrueTypeUnicode', '', 96);
$last = TCPDF_FONTS::addTTFfont('last4.ttf', 'TrueTypeUnicode', '', 96);


$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetCreator("Духнич Даниил ПИ-21б");
$pdf->SetAuthor('Духнич Даниил');
$pdf->SetTitle('World Cup 2022');
$pdf->SetSubject('Субъект');
$pdf->SetKeywords('Нет такого');
// Устанавливаем данные заголовка по умолчанию

$pdf->SetAutoPageBreak (true, 10);

$pdf->AddPage();

$pdf->SetDrawColor(100, 100, 100); // Установка цвета (RGB)
$pdf->SetTextColor(0, 0, 0); // Установка цвета текста (RGB)

//$pdf->setFontSubsetting(true);
$pdf->SetFont($last, 'B', 20);
$pdf->SetMargins (10, 10, 10);
//$pdf->setFontSpacing(1);
$pdf->setFontStretching(200);
$pdf->StartTransform();
$pdf->SetTextColor(58, 9, 90);
$txt = 'Создание PDF-файлов';
$pdf->StopTransform();

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->setFontStretching(50);
$pdf->Annotation(190, 15, 0, 0, "Already 6 labs!", array('Subtype'=>'Text', 'Name' => 'Comment', 'T' => 'The end is near', 'Subj' => 'example', 'L' => array(100, 100, 50)));

$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->setCellHeightRatio (1.5);

$pdf->StartTransform();
$pdf->Rotate(10);
$pdf->SetTextColor(138, 27, 27);
$pdf->Cell(0, 15, 'Чемпионат Мира по футболу 2022', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->StopTransform();
$pdf->setFontStretching(100);

$pdf->Ln();

$pdf->setFontSpacing(1);
$pdf->SetFont ($first, '', 18, '', false);
$pdf->SetTextColor(0, 0, 0);
$pdf->setCellHeightRatio (1);
$pdf->StartTransform();
$pdf->SetTextColor(41, 90, 9);
$pdf->Write(0, '    В этом году Чемпионат Мира пройдёт в азиатской стране - Катаре.', '', 0, 'L', true, 0, false, false, 0);
$pdf->StopTransform();

$pdf->Ln();
$pdf->setFontSpacing(2);
$pdf->SetFont ($second, '', 16, '', false);
$pdf->setCellHeightRatio (2);
$pdf->StartTransform();
$pdf->SetTextColor(203, 202, 45);
$pdf->Write(0, '    Победитель определится по итогам финального матча, в который пройдут лишь 2 команды из 32.', '', 0, 'C', true, 0, false, false, 0);

$pdf->StopTransform();

$pdf->Ln();
$pdf->setFontSpacing(4);
$pdf->SetFont ($third, '', 14, '', false);
$pdf->setCellHeightRatio (4);
$pdf->StartTransform();
$pdf->SetTextColor(16, 168, 161);
$pdf->Write(0, '    Это случилось! Аргентина стала обладателем Кубка Мира...', '', 0, 'R', true, 0, false, false, 0);
$pdf->StopTransform();

$pdf->Image('first.jpg', 15, 550, 100, 50, 'JPG', 'https://ru.wikipedia.org/wiki/%D0%9A%D0%B0%D1%82%D0%B0%D1%80', '', true, 150, 'C', false, false, 1, false, false, false);
$pdf->StartTransform();
$pdf->Rotate(-25, 50, 145);
$pdf->Image('second.jpg', 50, 120, 80, 50, 'JPG', 'https://ru.wikipedia.org/wiki/%D0%A7%D0%B5%D0%BC%D0%BF%D0%B8%D0%BE%D0%BD%D0%B0%D1%82_%D0%BC%D0%B8%D1%80%D0%B0_%D0%BF%D0%BE_%D1%84%D1%83%D1%82%D0%B1%D0%BE%D0%BB%D1%83_2022', '', true, 150, 'L', false, false, 1, false, false, false);
$pdf->StopTransform();
$pdf->StartTransform();
$pdf->Rotate(25, 160, 145);
$pdf->Image('third.jpg', 100, 120, 80, 50, 'JPG', 'https://lenta.ru/articles/2022/12/19/wc_final/', '', true, 150, 'R', false, false, 1, false, false, false);
$pdf->StopTransform();

$pdf->OutPut();
?>
