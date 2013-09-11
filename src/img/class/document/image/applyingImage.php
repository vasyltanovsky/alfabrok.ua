<?php
/*
 * 
 *  
 *
 * @version class.applying.image,v 1.0 2010/07/19
 * @author <AlexTsurkin/>
 * @license GNU GPLv3
 */
//prepare_image('myImage.jpg','myImageNew.jpg', '1.png', 1024, 768);


class applyingImageClass {
	/* 
     *
     * @param  filename_src - имя файла исходного изображения
     * @param  filename_dst - имя файла, которое будет иметь результирующее изображение
     * @param  filename_watermark - это имя файла с логотипом, который будет наложен на изображение
	 * @param  w и h - ширина и высота, в которые нужно «вписать» картинку.
     * @return void
     */
	
	function prepare_image($filename_src, $filename_dst, $filename_watermark, $w, $h, $minus_w = 0, $minus_h = 0) {
		// Открываем исходное изображение
		// Считаем, что картинка всегда JPEG, иначе, нужно добавить проверку по расширению
		$imgsource = imagecreatefromjpeg ( $filename_src );
		
		// Получаем ширину и высоту исходного изображения
		$src_w = imagesx ( $imgsource );
		$src_h = imagesy ( $imgsource );
		
		// Высчитываем коэффициенты отношения исходных размеров к заданным
		$dx = $src_w / $w;
		$dy = $src_h / $h;
		
		// Выбираем наибольший коэффициент
		$d = max ( $dx, $dy );
		
		// Получаем высоту и ширину результирующего изображения
		$new_w = $src_w / $d;
		$new_h = $src_h / $d;
		
		// Создаем новое изображение, которое и будет нашим результатом
		$imgdest = imagecreatetruecolor ( $new_w, $new_h );
		
		// Копируем изображение-источник в изображение-результат уменьшая его
		imagecopyresampled ( $imgdest, $imgsource, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h );
		
		// Накладываем ватермарк или логотип
		// Считаем, что картинка всегда PNG, иначе, нужно добавить проверку по расширению
		$imgadd = imagecreatefrompng ( $filename_watermark );
		imagecopy ( $imgdest, $imgadd, ($w / 2 - $minus_w), ($h / 2 - $minus_h), 0, 0, imagesx ( $imgadd ), imagesy ( $imgadd ) );
		
		// Сохраняем результат
		imagejpeg ( $imgdest, $filename_dst, 100 );
		
		// Чистим мусор
		imagedestroy ( $imgadd );
		imagedestroy ( $imgdest );
		imagedestroy ( $imgsource );
		return true;
	}
}
?>