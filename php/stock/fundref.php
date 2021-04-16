<?php

define('FUND_POSITION_RATIO', 0.95);

// ****************************** FundReference Class *******************************************************
class FundReference extends MysqlReference
{
    var $stock_ref = false;     // MyStockReference
    var $est_ref = false;       // MyStockRefenrence for fund net value estimation
    var $future_ref = false;
    var $future_etf_ref = false;
    var $cny_ref;

    // estimated data
    var $fOfficialNetValue = false;
    var $fFairNetValue = false;
    var $fRealtimeNetValue = false;

    var $strOfficialDate;
    
    var $sql;
    
    function FundReference($strSymbol) 
    {
        parent::MysqlReference($strSymbol);

        if ($this->IsFundA())
        {
            $this->stock_ref = new MyStockReference($strSymbol);
        }
        if ($strStockId = $this->GetStockId())
        {
        	if ($fVal = SqlGetStockCalibrationFactor($strStockId))		$this->fFactor = $fVal; 
        	$this->sql = new NetValueHistorySql($strStockId);
        }
    }

    function LoadData()
    {
        $this->LoadSinaFundData();
        $this->bConvertGB2312 = true;     // Sina name is GB2312 coded
    }
    
    function GetNetValue()
    {
    	return $this->GetPrice();
    }
    
    function GetOfficialDate()
    {
    	return $this->strOfficialDate;
    }
    
    function GetOfficialNetValue()
    {
    	if ($this->fOfficialNetValue)
    	{
    		return strval($this->fOfficialNetValue);
    	}
    	return false;
    }
    
    function GetFairNetValue()
    {
    	if ($this->fFairNetValue)
    	{
    		return strval($this->fFairNetValue);
    	}
    	return false;
    }
    
    function GetRealtimeNetValue()
    {
    	if ($this->fRealtimeNetValue)
    	{
    		return strval($this->fRealtimeNetValue);
    	}
    	return false;
    }
    
    function SetForex($strForex)
    {
        $this->cny_ref = new CnyReference($strForex);
    }

    // Update database
    function UpdateEstNetValue()
    {
       	$fund_sql = new FundEstSql($this->GetStockId());
   		StockUpdateEstResult($this->sql, $fund_sql, $this->GetOfficialNetValue(), $this->GetOfficialDate());
    }

    function UpdateOfficialNetValue()
    {
		return StockCompareEstResult($this->sql, $this->GetPrice(), $this->GetDate(), $this->GetSymbol());
    }

    function InsertFundCalibration($est_ref, $strEstPrice)
    {
        return SqlInsertStockCalibration($this->GetStockId(), $est_ref->GetSymbol(), $this->GetPrice(), $strEstPrice, $this->fFactor, DebugGetDateTime());
    }

    function GetSymbol()
    {
        if ($this->stock_ref)
        {
            return $this->stock_ref->GetSymbol();
        }
        return parent::GetSymbol();
    }

    function GetStockId()
    {
        if ($this->stock_ref)
        {
            return $this->stock_ref->GetStockId();
        }
        return parent::GetStockId();
    }

    function GetPriceDisplay($strDisp = false, $strPrev = false)
    {
   		if ($this->stock_ref)
   		{
   			return $this->stock_ref->GetPriceDisplay($strDisp, $strPrev);
   		}
   		return parent::GetPriceDisplay($strDisp, $strPrev);
    }
    
    function GetPercentageDisplay($strDivisor = false, $strDividend = false)
    {
   		if ($this->stock_ref)
   		{
   			return $this->stock_ref->GetPercentageDisplay($strDivisor, $strDividend);
   		}
   		return parent::GetPercentageDisplay($strDivisor, $strDividend);
    }
    
    function GetStockRef()
    {
    	return $this->stock_ref;
    }

    function GetEstRef()
    {
    	return $this->est_ref;
    }

    function GetFutureRef()
    {
    	return $this->future_ref;
    }

    function GetCnyRef()
    {
    	return $this->cny_ref;
    }

    function GetFundPosition()
    {
		if ($this->IsLofA())
		{
			switch ($this->GetSymbol())
			{
			case 'SZ162411':
				$fRatio = 0.95;
				break;
    		
			case 'SZ162719':
				$fRatio = 0.95;
				break;
    		
			default:
				$fRatio = FUND_POSITION_RATIO;
				break;
			}
    	}
		else
		{
    		$fRatio = 1.0;
		}
    	return $fRatio;
    }
    
    function AdjustPosition($fVal)
    {
    	$fRatio = $this->GetFundPosition();
        return $fVal * $fRatio + floatval($this->GetPrice()) * (1.0 - $fRatio);
    }
}

?>
