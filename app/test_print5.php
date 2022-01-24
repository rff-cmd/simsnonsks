<?php
$tanggal = date("d-m-Y");
$jam = date("H:i:s");
$var_magin_left = 10;
$printer =  printer_open('EPSON LQ-310 ESC/P2');
printer_set_option($printer, PRINTER_MODE, "RAW"); // mode disobek ( kertas tidak menggulung )
printer_start_doc($printer);
printer_start_page($printer);
$font = printer_create_font("Arial", 18, 17, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($printer, $font);
printer_draw_text($printer, ".: TOKO XYZ :.",130,0);
printer_draw_text($printer, date("Y/m/d H:i:s"),255, 40);

printer_draw_text($printer, "Kasir", $var_magin_left, 40);
printer_draw_text($printer, ":",70, 40);
printer_draw_text($printer, 'abc',80, 40);

// Header Bon
$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
printer_select_pen($printer, $pen);
printer_draw_line($printer, $var_magin_left, 65, 400, 65);
printer_draw_text($printer, "TRANSAKSI", $var_magin_left, 70);
printer_draw_text($printer, "QTY", 290, 70);
printer_draw_text($printer, "PRICE", 350, 70);
printer_draw_line($printer, $var_magin_left, 85, 400, 85);

$row +=150;
printer_draw_text($printer, "Terima Kasih Atas Kunjungan Anda", 80, $row);

printer_delete_font($font);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
?>