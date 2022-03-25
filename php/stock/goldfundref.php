<?php

function GoldSilverGetCnFutureSymbol($strSymbol)
{
    if ($strSymbol == 'SZ161226')   return 'AG0';
    return 'AU0';
}

function GoldSilverGetFutureSymbol($strSymbol)
{
    if ($strSymbol == 'SZ161226')   return 'hf_SI';
    return 'hf_GC';
}

class GoldFundReference extends FundReference
{
    function GoldFundReference($strSymbol)
    {
        parent::FundReference($strSymbol);
        $this->SetForex('USCNY');
        $this->est_ref = new FutureReference(GoldSilverGetCnFutureSymbol($strSymbol));
        $this->future_ref = new FutureReference(GoldSilverGetFutureSymbol($strSymbol));
        $this->EstNetValue();
    }

    function _estGoldSilver($fEst)
    {
    	if (empty($this->fFactor))	return 0.0;
    	
   		$fVal = $fEst / $this->fFactor;
        return $this->AdjustPosition($fVal); 
    }
    
    function EstNetValue()
    {
        $this->AdjustFactor();
        
        $est_ref = $this->GetEstRef();
        $this->fOfficialNetValue = $this->_estGoldSilver(floatval($est_ref->GetPrice()));
        $this->strOfficialDate = $est_ref->GetDate();
        $this->UpdateEstNetValue();

        $this->EstRealtimeNetValue();
    }

    function EstRealtimeNetValue()
    {
       	$future_ref = $this->GetFutureRef();
       	$cny_ref = $this->GetCnyRef();
		$fEst = floatval($future_ref->GetPrice()) * floatval($cny_ref->GetPrice()) / 31.1035;
		if ($future_ref->GetSymbol() == 'hf_SI')
		{
//			DebugString('Silver');
			$fEst *= 1000.0;
		}
        $this->fRealtimeNetValue = $this->_estGoldSilver($fEst);
    }

    function AdjustFactor()
    {
        if ($this->UpdateOfficialNetValue())
        {
        	$est_ref = $this->GetEstRef();
            if ($est_ref->HasData() == false)            return false;
            if ($this->GetDate() != $est_ref->GetDate())    return false;
            
            $iHour = $est_ref->GetHour();
            if ($iHour >= 9 && $iHour <= 15)
            {
                $this->fFactor = floatval($est_ref->GetPrice()) / floatval($this->GetPrice());
            }
            else
            {
                $this->fFactor = floatval($est_ref->GetPrevPrice()) / floatval($this->GetPrice());
            }
            $this->InsertFundCalibration();
            return $this->fFactor;
        }
        return false;
    }
}

?>
