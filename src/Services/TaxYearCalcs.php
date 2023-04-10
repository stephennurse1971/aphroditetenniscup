<?php

namespace App\Services;

use App\Repository\InvestmentsRepository;
use App\Repository\TaxInputsRepository;

class TaxYearCalcs
{
   public function taxDueOnIncomeByYear(\App\Entity\TaxYear $taxYear,float $income){
      $tax_input_by_year = $this->taxInputsRepository->findOneBy(['year'=>$taxYear]);
      $basic_rate = max(0,min($income,$taxYear->getTaxBand2BasicRate()));
      $higher_rate = max(0,(min($income,$taxYear->getTaxBand3HigherRate())-$basic_rate));
      $additional_rate = max(0,($income- $taxYear->getTaxBand3HigherRate()));
      $tax_due_on_income = ($basic_rate*$taxYear->getTaxBand2Rate()) + ($higher_rate * $taxYear->getTaxBand3Rate()) + ($additional_rate * $taxYear->getTaxBand4Rate());
      return $tax_due_on_income;
   }


    public function taxReliefsByYear(\App\Entity\TaxYear $taxYear ){
        $tax_input_by_year = $this->taxInputsRepository->findOneBy(['year'=>$taxYear]);
        $tax_relief_offset = 0;
         foreach ($this->investmentRepository->findAll() as $investment ){
             if($investment->getEisPurchaseYear1()){
                 if($investment->getEisPurchaseYear1() == $taxYear){
                     $tax_relief_offset = $tax_relief_offset + ($investment->getInvestmentAmount() * $investment->getEISPurchaseYear1Percentage() * ($investment->getTaxScheme()->getPurchaseTaxOffset()/100));
                 }
             }
             if($investment->getEisPurchaseYear2()){
                 if($investment->getEisPurchaseYear2() == $taxYear){
                     $tax_relief_offset = $tax_relief_offset + ($investment->getInvestmentAmount() * $investment->getEISPurchaseYear2Percentage() * ($investment->getTaxScheme()->getPurchaseTaxOffset()/100));
                 }
             }
             if($investment->getEisSaleYear1()){
                 if($investment->getEisSaleYear1() == $taxYear){
                     $tax_relief_offset = $tax_relief_offset + ($investment->getInvestmentAmount() * $investment->getEISSaleYear1Percentage() * $investment->getTaxScheme()->getSaleTaxOffset()/100);
                 }
             }
             if($investment->getEisSaleYear2()){
                 if($investment->getEisPurchaseYear2() == $taxYear){
                     $tax_relief_offset = $tax_relief_offset + ($investment->getInvestmentAmount() * $investment->getEISSaleYear2Percentage() * $investment->getTaxScheme()->getSaleTaxOffset()/100);
                 }
             }
         }
         return $tax_relief_offset;
    }

    public function incomeOffsetsByYear(\App\Entity\TaxYear $taxYear ){
        $tax_input_by_year = $this->taxInputsRepository->findOneBy(['year'=>$taxYear]);
        $income_offset = 0;
        foreach ($this->investmentRepository->findAll() as $investment ){
            if($investment->getEisPurchaseYear1()){
                if($investment->getEisPurchaseYear1() == $taxYear){
                    $income_offset = $income_offset + ($investment->getInvestmentAmount() * $investment->getEISPurchaseYear1Percentage() * ($investment->getTaxScheme()->getPurchaseIncomeOffset()/100));
                }
            }
            if($investment->getEisPurchaseYear2()){
                if($investment->getEisPurchaseYear2() == $taxYear){
                    $income_offset = $income_offset + ($investment->getInvestmentAmount() * $investment->getEISPurchaseYear2Percentage() * ($investment->getTaxScheme()->getPurchaseIncomeOffset()/100));
                }
            }

//            {% if investment.investmentSaleDate is not null %}
//            {% set Loss =  (investment.purchaseSharePrice - investment.saleSharePrice )/investment.purchaseSharePrice %}
//            {% set ClaimableLoss =  Loss -(investment.taxScheme.purchaseIncomeOffset + investment.taxScheme.purchaseTaxOffset) %}
//            {% set ClaimableLossAmount = ClaimableLoss * investment.investmentAmount %}
//
//            {% if investment.eisSaleYear1 == taxYear %}
//            {#                                    Loss: {{ Loss *100 }}% #}
//                {#                                    Claimable loss: {{ ClaimableLoss *100 }}% #}
//                    {#                                    Claimable loss amount: £{{ ClaimableLossAmount }} #}
//                        {% set incomeOffset = incomeOffset +  (investment.eISSaleYear1Percentage * ClaimableLossAmount/100) %}
//                        {% endif %}
//
//                        {% if investment.eisSaleYear2 == taxYear %}
//                        {% set incomeOffset = incomeOffset +  (investment.eISSaleYear2Percentage * ClaimableLossAmount/100) %}
//                        {% endif %}
//                        {% endif %}



            if($investment->getEisSaleYear1()){
                if($investment->getEisSaleYear1() == $taxYear){
                    $income_offset = $income_offset + ($investment->getInvestmentAmount() * $investment->getEISSaleYear1Percentage() * $investment->getTaxScheme()->getSaleIncomeOffset()/100);
                }
            }



            if($investment->getEisSaleYear2()){
                if($investment->getEisPurchaseYear2() == $taxYear){
                    $income_offset = $income_offset + ($investment->getInvestmentAmount() * $investment->getEISSaleYear2Percentage() * $investment->getTaxScheme()->getSaleIncomeOffset()/100);
                }
            }
        }
        return $income_offset;
    }



    public function __construct(TaxInputsRepository $taxInputsRepository, InvestmentsRepository $investmentsRepository){
        $this->taxInputsRepository = $taxInputsRepository;
        $this->investmentRepository = $investmentsRepository;
    }



}