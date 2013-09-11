<?php
error_reporting ( E_ALL );

require_once DOC_ROOT . '/class/json/json.php';

#классы для формирования форм 
require_once DOC_ROOT . '/class/form/class.field.php';
require_once DOC_ROOT . '/class/form/class.field.text.php';
require_once DOC_ROOT . '/class/form/class.field.text.english.php';
require_once DOC_ROOT . '/class/form/class.field.text.int.php';
require_once DOC_ROOT . '/class/form/class.field.text.email.php';
require_once DOC_ROOT . '/class/form/class.field.password.php';
require_once DOC_ROOT . '/class/form/class.field.textarea.php';
require_once DOC_ROOT . '/class/form/class.field.hidden.php';
require_once DOC_ROOT . '/class/form/class.field.hidden.int.php';
require_once DOC_ROOT . '/class/form/class.field.radio.php';
require_once DOC_ROOT . '/class/form/class.field.select.php';
require_once DOC_ROOT . '/class/form/class.field.checkbox.php';
require_once DOC_ROOT . '/class/form/class.field.file.php';
require_once DOC_ROOT . '/class/form/class.field.date.php';
require_once DOC_ROOT . '/class/form/class.field.datetime.php';
require_once DOC_ROOT . '/class/form/class.field.paragraph.php';
require_once DOC_ROOT . '/class/form/class.field.title.php';
require_once DOC_ROOT . '/class/form/class.forms.php';
#классы обработки ошибок
require_once DOC_ROOT . '/class/exception.member.php';
require_once DOC_ROOT . '/class/exception.mysql.php';
require_once DOC_ROOT . '/class/exception.object.php';
#классы для выборки из БД, пейджинка 
require_once DOC_ROOT . '/class/pager/class.pager.php';
require_once DOC_ROOT . '/class/pager/class.pager_mysql.right.php';
require_once DOC_ROOT . '/class/pager/class.pager_mysql.full.php';
require_once DOC_ROOT . '/class/pager/class.pager_abstract.php';
require_once DOC_ROOT . '/class/pager/class.pager_dir.php';
require_once DOC_ROOT . '/class/pager/class.pager_file.php';
require_once DOC_ROOT . '/class/pager/class.pager_file_search.php';
require_once DOC_ROOT . '/class/pager/class.pager_mysql.php';
require_once DOC_ROOT . '/class/pager/class.mysql.select.php';
#класс переключение языка сайта
require_once DOC_ROOT . '/class/language/class.language.php';
#класс работы со словарем
require_once DOC_ROOT . '/class/dictionaries/class.dictionaries.php';
#движок сайта, обработчик страниц, подключаемых модулей
require_once DOC_ROOT . '/class/pages/class.pages.handler.php';
#обработчик модулей сайта HTML
require_once DOC_ROOT . '/class/modules/class.module.site.php';
require_once DOC_ROOT . '/class/modules/class.module.site.im.php';
#набор различных классов  	
require_once DOC_ROOT . '/class/work/class.functional.php';
require_once DOC_ROOT . '/class/work/class.foto.php';
require_once DOC_ROOT . '/class/work/class.news.php';
require_once DOC_ROOT . '/class/work/class.video.php';
require_once DOC_ROOT . '/class/date/class.date.php';
require_once DOC_ROOT . '/class/work/class.build.tree.php';
require_once DOC_ROOT . '/class/work/class.document.php';
require_once DOC_ROOT . '/class/work/class.block.php';
require_once DOC_ROOT . '/class/work/class.discharge.php';
require_once DOC_ROOT . '/class/work/class.part.of.module.php';
#	формирует меню и справочную информация для выбранного модуля
require_once DOC_ROOT . '/class/catalog/class.catalog.php';
#класс отправки email сообщений  
require_once DOC_ROOT . '/class/mailer/class.phpmailer.php';
#класс для кеширования сайта  
require_once DOC_ROOT . '/class/cache/class.cache.php';
#класс для работы с изображениями, изминение размеров
require_once DOC_ROOT . '/class/image/resize.class.php';
require_once DOC_ROOT . '/class/image/class.applying.image.php';
#	
require_once DOC_ROOT . '/class/enter.access.derictory/class.enter.access.php';
#
require_once DOC_ROOT . '/class/propertis/class.propertis.form.php';
require_once DOC_ROOT . '/class/propertis/class.propertis.sort.php';
require_once DOC_ROOT . '/class/propertis/class.propertis.print.php';
#
require_once DOC_ROOT . '/class/im/form/class.ImSiteForm.php';
require_once DOC_ROOT . '/class/im/class.im.print.list.php';
require_once DOC_ROOT . '/class/work/class.get.post.content.php';

require_once DOC_ROOT . '/class/page/class.controller.php';

require_once DOC_ROOT . '/class/provider/class.provider.php';

require_once DOC_ROOT . '/application/module/providers.php';