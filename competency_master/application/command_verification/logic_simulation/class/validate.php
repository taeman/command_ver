<?php
session_start();
$_SESSION['session_staffid'] = '1';
include "../../../../config/conndb_nonsession.inc.php";
include "../../app_function.php";
include "../../app_config.php";
include "class.utility.php";
include "class.education.php";
include "../variable/eduBachelor.php";
include "../variable/eduAccounting.php";
include "../variable/eduBusinessAdmin.php";
include "../variable/eduEconomics.php";
include "../variable/expPosition.php";
include "../variable/expRelatedTasks.php";

$objUti = new utility;
$period = $objUti->getPeriodReal('2011-11-01','2011-12-05');
$strPeriod = $objUti->splitDate($period);
echo $strPeriod;

$objEdu = new education('3620200034234');
$objEdu->getEducation();
$objEdu->showEducation();


$objBachelor = new eduBachelor('3620200034234');
$objBachelor->getBachelor();
if($objBachelor->haveBachelor()){
  echo "have Bachelor Degree";
}
echo "<br>";

$objAcc = new eduAccounting('3569900174992');
$objAcc->getAccounting();
if($objAcc->haveAccounting()){
  echo "have Accounting Mojor";
}


echo "<br>";

$objBusiness = new eduBusinessAdmin('3501300706368');
$objBusiness->getBusinessAdmin();
if($objBusiness->haveBusinessAdmin()){
  echo "have Business Administration Mojor";
}

echo "<br>";

$objEco = new eduEconomics('3102101715906');
$objEco->getEconomics();
if($objEco->haveEconomics()){
  echo "have Business Economics Mojor";
}

echo "<br>";
echo "<br>";
$objExp = new expPosition('3180500030751','525471147','92255106','2010-04-21');
$objExp->checkExp();
$objExp->showExp();

echo "<br>";
echo "<br>";

$objExpRe = new expRelatedTasks('3180500030751','525471147','92255106','2010-04-21');
$objExpRe->checkExp();
$objExpRe->showExp();




?>