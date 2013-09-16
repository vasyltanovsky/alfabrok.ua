<?php
/*
 * 
 */
class ExceptionFullGet {
	public function ExcMember($exc) {
		return "<p class=help>Произошла исключительная ситуация (ExceptionMember) - попытка обращения к несуществующему члену класса.{$exc->getMessage()}.</p><p class=help>Ошибка в файле {$exc->getFile()} в строке {$exc->getLine()}.</p>";
	}
	public function ExcMysql($exc) {
		return "<p class=help>Произошла исключительная ситуация (ExceptionMySQL) при обращении к СУБД MySQL.</p><p class=help>{$exc->getMySQLError()}<br>" . $exc->getSQLQuery () . "</p><p class=help>Ошибка в файле {$exc->getFile()} в строке {$exc->getLine()}.</p>";
	}
	public function ExcMysqlN($exc) {
		return "\nПроизошла исключительная ситуация (ExceptionMySQL) при обращении к СУБД MySQL.\n{$exc->getMySQLError()}\n" . $exc->getSQLQuery () . "\nОшибка в файле {$exc->getFile()} в строке {$exc->getLine()}.";
	}
	public function ExcObject($exc) {
		return "<p class=help>Произошла исключительная ситуация (ExceptionObject) - попытка использования в качестве элемента управления объекта, класс которого не является производным от базового класса.{$exc->getMessage()}.</p><p class=help>Ошибка в файле {$exc->getFile()}в строке {$exc->getLine()}.</p>";
	}
	public function ExcError($exc) {
		return "<p class=help>{$exc->getMessage()}.</p><p class=help>Ошибка в файле {$exc->getFile()}в строке {$exc->getLine()}.</p>";
	}
}
?>