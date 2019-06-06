# eset.xmlparser
Модуль парсера XML

Install: 
  - Скачать модуль, разархивировать в папку /local/modules/.
  - Убрать из имени папки "-master"
  - Проверить права на запись папки /upload.

Модуль выполнен как партнерский, поэтому его следует устанавливать по этому пути:

Рабочий стол -> Marketplace -> Установленные решения.

  Пример подключения: CModule::IncludeModule('eset.xmlparser');
  
  
Способы загрузки XML разделены по компонентам:

1. Компонент 'xmlupload:fileupload' - загрузка XML через файл на сервер по Ajax;
  Пример подключения: $APPLICATION->IncludeComponent('xmlupload:fileupload', '');

2. Компнонет 'xmlupload:streamupload' - загрузка XML через текстовое поле.
  Пример подключения: $APPLICATION->IncludeComponent('xmlupload:streamupload', '');
  
Способы вывода отчетности в виде дерева. Компонент 'xmlreport:treereport'.
  Пример подключения: $APPLICATION->IncludeComponent('xmlreport:treereport', '');
  
Прошу особо не смотреть на дизай, т.к. чукча не дизайнер. :D
Так же я понимаю, что выполнить его можно было и по другой архитектуре(начиная с БД), но я хотел показать работу с ORM более развернуто,
работу с D7.
