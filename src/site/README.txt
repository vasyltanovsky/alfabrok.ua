1. Сброрка сайта производиться только спомощью Apache Ant

2. Для сборки необходимо:
	Установить Apache Ant v1.8.4
	Установить Java

3. Распаковать архив site-backup.rar
	 (если вы используете иную версию Apache Ant v1.8.4 укажите в файле {root}\build\build.xml, строка <contains string="${ant.version}" substring="1.8.4"/>)
	 
4. После внесения правок через cmd зайдите в папку {root}\build и вызовите комманду ant
	сформируеться 2 новые папки: intermediate, publish

5. Содиржимое папки publish залейте на хостинг

6. Упакуйте сайт в архив (site-backup.rar) без папок: intermediate, publish и залейте на хостинг.

 
