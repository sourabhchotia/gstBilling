
<?php
$ones =array('',' One',' Two',' Three',' Four',' Five',' Six',' Seven',' Eight',' Nine',' Ten',' Eleven',' Twelve',' Thirteen',' Fourteen',' Fifteen',' Sixteen',' Seventeen',' Eighteen',' Nineteen');
$tens = array('','',' Twenty',' Thirty',' Fourty',' Fifty',' Sixty',' Seventy',' Eighty',' Ninety',);
$triplets = array('',' Thousand',' Lac',' Crore',' Arab',' Kharab');


function Show_Amount_In_Words($num) {
  global $ones, $tens, $triplets;
$str ="";


//$num =(int)$num;
$th= (int)($num/1000); 
$x = (int)($num/100) %10;
$fo= explode('.',$num);

if($fo[0] !=null){
$y=(int) substr($fo[0],-2);

}else{
    $y=0;
}

if($x > 0){
    $str =$ones[$x].' Hundred';

}
if($y>0){
if($y<20)
{
 $str .=$ones[$y];

}
else {
    $str .=$tens[($y/10)].$ones[($y%10)];
   }
}
$tri=1;
while($th!=0){

    $lk = $th%100;
    $th = (int)($th/100);
    $count =$tri;

    if($lk<20){
        if($lk == 0){
        $tri =0;}
        $str = $ones[$lk].$triplets[$tri].$str;
        $tri=$count;
        $tri++;
    }else{
        $str = $tens[$lk/10].$ones[$lk%10].$triplets[$tri].$str;
        $tri++;
    }
}
$num =(float)$num;
if(is_float($num)){
     $fo= (String) $num;
      $fo= explode('.',$fo);
       $fo1= @$fo[1];

}else{
    $fo1 =0;
}
$check = (int) $num;
 if($check !=0){
          return $str.' Rupees'.forDecimal($fo1);
    }else{
       return forDecimal($fo1);
    }
}//End function Show_Amount_In_Words

if(isset($_POST['num'])){
   $num = $_POST['num'];
 echo Show_Amount_In_Words($num);
 }



//function for decimal parts
 function forDecimal($num){
    global $ones,$tens;
    $str="";
    $len = strlen($num);
    if($len==1){
        $num=$num*10;
    }
    $x= $num%100;
    if($x>0){
    if($x<20){
        $str = $ones[$x].' Paise';
    }else{
        $str = $ones[$x/10].$ones[$x%10].' Paise';
    }
    }
     return $str;
 }  
?>
