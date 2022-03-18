<?php
require_once('sqlkeypair.php');

define('TABLE_ADRH_STOCK', 'adrhstock');
define('TABLE_ETF_PAIR', 'etfpair');

// ****************************** StockPairSql class *******************************************************
class StockPairSql extends KeyPairSql
{
    function StockPairSql($strTableName) 
    {
        parent::KeyPairSql($strTableName, false, TABLE_STOCK);
    }

    function GetSymbolArray()
    {
		$arSymbol = array();
		$sql = GetStockSql();
		$ar = $this->GetIdArray('GetData');
		foreach ($ar as $strStockId)
		{
			$arSymbol[] = $sql->GetKey($strStockId);
		}
		sort($arSymbol);
		return $arSymbol;
	}
	
	function GetSymbol($strPairSymbol)
	{
		$sql = GetStockSql();
		if ($strPairId = $sql->GetId($strPairSymbol))
		{
			if ($strStockId = $this->GetId($strPairId))
			{
				return $sql->GetKey($strStockId);
			}
		}
		return false;
	}
	
	function GetPairSymbol($strSymbol)
	{
		$sql = GetStockSql();
		if ($strStockId = $sql->GetId($strSymbol))
		{
			if ($strPairId = $this->GetKeyId($strStockId))
			{
				return $sql->GetKey($strPairId);
			}
		}
		return false;
	}

	function InsertSymbol($strSymbol, $strPairSymbol)
	{
		$sql = GetStockSql();
		if ($strStockId = $sql->GetId($strSymbol))
		{
			if ($strPairId = $sql->GetId($strPairSymbol))
			{
				return $this->Insert($strStockId, $strPairId);
			}
		}
		return false;
	}
	
	function UpdateSymbol($strSymbol, $strPairSymbol)
	{
		$sql = GetStockSql();
		if ($strStockId = $sql->GetId($strSymbol))
		{
			if ($strPairId = $sql->GetId($strPairSymbol))
			{
				return $this->Update($strStockId, $strPairId);
			}
		}
		return false;
	}
	
	function WriteSymbol($strSymbol, $strPairSymbol)
	{
		if ($str = $this->GetPairSymbol($strSymbol))
		{
			if ($str == $strPairSymbol)		return false;
			return $this->UpdateSymbol($strSymbol, $strPairSymbol);
		}
		return $this->InsertSymbol($strSymbol, $strPairSymbol);
	}
	
	function DeleteBySymbol($strPairSymbol)
	{
		$sql = GetStockSql();
		if ($strPairId = $sql->GetId($strPairSymbol))
		{
			return $this->Delete($strPairId);
		}
		return false;
	}
}

// ****************************** AhPairSql class *******************************************************
class AhPairSql extends StockPairSql
{
    function AhPairSql() 
    {
        parent::StockPairSql('ahpair');
    }
}

// ****************************** AbPairSql class *******************************************************
class AbPairSql extends StockPairSql
{
    function AbPairSql() 
    {
        parent::StockPairSql('abpair');
    }
}

// ****************************** PairStockSql class *******************************************************
class PairStockSql extends StockTableSql
{
    function PairStockSql($strTableName, $strStockId) 
    {
        parent::StockTableSql($strTableName, $strStockId);
    }
    
    function GetRecord()
    {
    	return $this->GetSingleData($this->BuildWhere_key());
    }

    function GetRatio()
    {
    	if ($record = $this->GetRecord())
    	{
    		return floatval($record['ratio']);
    	}
    	return false;
    }

    function GetPairId()
    {
    	if ($record = $this->GetRecord())
    	{
    		return $record['pair_id'];
    	}	
    	return false;
    }
    
    function BuildWhere_pair()
    {
    	return _SqlBuildWhere('pair_id', $this->GetKeyId());
    }
    
    function GetFirstStockId()
    {
    	if ($record = $this->GetSingleData($this->BuildWhere_pair()))
    	{
    		return $record['stock_id'];
    	}
    	return false;
    }

    function GetAllStockId()
    {
    	$ar = array();
    	if ($result = $this->GetData($this->BuildWhere_pair())) 
    	{
    		while ($record = mysql_fetch_assoc($result)) 
    		{
    			$ar[] = $record['stock_id'];
    		}
    		@mysql_free_result($result);
    	}
    	return $ar;
    }

	function Update($strId, $strPairId, $strRatio)
    {
		return $this->UpdateById(array('pair_id' => $strPairId, 'ratio' => $strRatio), $strId);
	}
}

class EtfPairSql extends PairStockSql
{
    function EtfPairSql($strStockId) 
    {
        parent::PairStockSql(TABLE_ETF_PAIR, $strStockId);
    }
}

// ****************************** Stock pair tables *******************************************************

function SqlCreateStockPairTable($strTableName)
{
    $str = 'CREATE TABLE IF NOT EXISTS `camman`.`'
         . $strTableName
         . '` ('
         . ' `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,'
         . ' `stock_id` INT UNSIGNED NOT NULL ,'
         . ' `pair_id` INT UNSIGNED NOT NULL ,'
         . ' `ratio` DOUBLE(10,6) NOT NULL ,'
         . ' FOREIGN KEY (`pair_id`) REFERENCES `stock`(`id`) ON DELETE CASCADE ,'
         . ' UNIQUE ( `stock_id` )'
         . ' ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci '; 
	return SqlDieByQuery($str, $strTableName.' create table failed');
}

function SqlInsertStockPair($strTableName, $strStockId, $strPairId, $strRatio)
{
    if ($strStockId == false || $strPairId == false)    return false;
    
	$strQry = 'INSERT INTO '.$strTableName."(id, stock_id, pair_id, ratio) VALUES('0', '$strStockId', '$strPairId', '$strRatio')";
	return SqlDieByQuery($strQry, $strTableName.' insert stock pair failed');
}

function SqlGetStockPairRatio($strTableName, $strStockId)
{
	$sql = new PairStockSql($strTableName, $strStockId);
	return $sql->GetRatio();
}

// ****************************** Support functions *******************************************************

function _sqlGetStockPairArray($strTableName)
{
	$ar = array();
	$sql = new TableSql($strTableName);
	if ($result = $sql->GetData()) 
    {
        while ($record = mysql_fetch_assoc($result)) 
        {
            $ar[] = SqlGetStockSymbol($record['stock_id']);
        }
        @mysql_free_result($result);
    }
    sort($ar);
	return $ar;
}

function SqlGetAdrhArray()
{
	return _sqlGetStockPairArray(TABLE_ADRH_STOCK);
}

function SqlGetEtfPairArray()
{
	return _sqlGetStockPairArray(TABLE_ETF_PAIR);
}

function SqlGetAdrhPairRatio($adr_ref)
{
	return SqlGetStockPairRatio(TABLE_ADRH_STOCK, $adr_ref->GetStockId());
}

function _sqlGetPair($strTableName, $strSymbol, $callback)
{
	if ($strStockId = SqlGetStockId($strSymbol))
	{
		$sql = new PairStockSql($strTableName, $strStockId);
		if ($strPairId = $sql->$callback())
		{
			return SqlGetStockSymbol($strPairId);
		}
	}
	return false;
}

function SqlGetEtfPair($strEtf)
{
	return _sqlGetPair(TABLE_ETF_PAIR, $strEtf, 'GetPairId');
}

function SqlGetAhPair($strSymbolA)
{
	$ah_sql = new AhPairSql();
	return $ah_sql->GetPairSymbol($strSymbolA);
}

function SqlGetAdrhPair($strSymbolAdr)
{
	return _sqlGetPair(TABLE_ADRH_STOCK, $strSymbolAdr, 'GetPairId');
}

function SqlGetHaPair($strSymbolH)
{
	$pair_sql = new AhPairSql();
	return $pair_sql->GetSymbol($strSymbolH);
}

function SqlGetHadrPair($strSymbolH)
{
	return _sqlGetPair(TABLE_ADRH_STOCK, $strSymbolH, 'GetFirstStockId');
}

?>
