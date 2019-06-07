<?php    
$ignoreAuth=true;
require_once 'core.php';

$orderId = $_GET["orderId"];
//phpinfo();
if($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']){ //ensure order receipt requests are coming from this server
   //
} else {
   header("Location: index.php");
}
$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due,";
$sql.= " payment_place,gstn,notes,orderid FROM ".$db_prefix."orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$payment_place = $orderData[10];
$gstn = $orderData[11];
$invoice = $orderData[13];
$notes = stripslashes($orderData[12]);
$tax = $totalAmount - $subTotal;

$orderItemSql = "SELECT ".$db_prefix."order_item.product_id, ".$db_prefix."order_item.rate, ".$db_prefix."order_item.quantity, ".$db_prefix."order_item.total,
".$db_prefix."product.product_name, ".$db_prefix."order_item.description FROM ".$db_prefix."order_item
   INNER JOIN ".$db_prefix."product ON ".$db_prefix."order_item.product_id = ".$db_prefix."product.product_id 
 WHERE ".$db_prefix."order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

$clientsql="select * from " . $db_prefix . "clients where id_clients=" . $clientName;
$clientQuery=$connect->query($clientsql);
$clientData=$clientQuery->fetch_row();

?>
<style>
td {
    font-size:11px;
}
</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> 
    <table width="100%" style="border:1px solid #000;">
    <col width="30">
    <col width="270">
    <col width="200">
    <col width="20">
    <col width="50">
    <tbody>
    <tr><td>&nbsp;</td><td align="center" colspan="3"><h3>Invoice</h3></td><td>&nbsp;</td></tr>
                  <tr>
                     <td rowspan="7" colspan="2" background-image="logo.jpg"><img src="../assets/images/logo.png" alt="logo" width="200px;"></td>
                     <td colspan="3" style=" text-align: right;">&nbsp;</td>
                  </tr>
                  <tr>
                     <td colspan="5" style=" text-align: right;color: red;font-style: italic;font-weight: 600;text-decoration: underline;font-size: 25px;">IMS</td>
                  </tr>
                  <tr>
                     <td colspan="5" style=" text-align: right;"><?PHP echo $ims_companyname;?></td>
                  </tr>
                  <tr>
                     <td colspan="5" style=" text-align: right;"><?PHP echo $ims_address;?></td>
                  </tr>
                  <tr>
                     <td colspan="5" style=" text-align: right;"><?PHP echo $ims_city . " " . $ims_state . " " . $ims_zip;?></td>
                  </tr>
                  <tr>
                     <td colspan="5" style=" text-align: right;">PH: <?PHP echo $ims_phone;?> Cell: <?PHP echo $ims_cell;?></td>
                  </tr>
                  <tr>
                     <td colspan="5" style=" text-align: right;"><?PHP echo $ims_email;?></td>
                  </tr>
                  
                  <tr>
                     <td colspan="3" style="padding: 0px;vertical-align: top; border-top: 1px solid #000;">
                        <table align="left" cellpadding="0" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td style="width: 74px;vertical-align: top;color: red;" rowspan="5">TO</td>
                                 <td>&nbsp;<?PHP echo $clientData[1];?></td>
                              </tr>
                              <tr>
                                 <td><?PHP echo $clientData[4];?></td>
                              </tr>
                              <tr>
                                 <td><?PHP echo $clientData[5] . " " . $clientData[6] . " " . $clientData[7];?></td>
                              </tr>
                              <tr>
                                 <td><?PHP echo $clientData[2];?></td>
                              </tr>
                              <tr>
                                 <td><?PHP echo $clientData[3];?></td>
                              </tr>
                           </tbody>
                        </table>
                        
                     </td>
                     <td colspan="2" style="padding: 0px;vertical-align: top; border-top:1px solid #000">
                        <table align="right" cellpadding="0" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td>Invoice: <?PHP echo $invoice;?></td>
                              </tr>
                              <tr>
                                 <td>Date: <?PHP echo $orderDate; ?></td>
                              </tr>
                              <tr>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                    </tr>


                  <tr>
                      <td colspan="5">

                      
                        <table style="border-top:1px solid #000;">
                        <col width="30">
                        <col width="450">
                        <col width="30">
                        <col width="50">
                        <col width="50">
                        <tr>
                        <th style="border-bottom:1px solid #000;">Item</th>
                        <th style="border-bottom:1px solid #000;">Part/Description</th>
                        <th style="border-bottom:1px solid #000;">Qty</th>
                        <th style="border-bottom:1px solid #000;">Rate</th>
                        <th style="border-bottom:1px solid #000;">Amount</th>
                        </tr>   
                        <?PHP
                            $x = 1;
                            $total = $totalAmount - $paid;
                            
                            
                        while($row = $orderItemResult->fetch_array()) {       
                            ?>       
                        <tr>
                                <td style="border-bottom:1px solid #ccc;text-align:center;"><?PHP echo $x;?></td>
                                <td style="border-left: 1px solid black;border-bottom:1px solid #ccc;"><?PHP echo $row[4]. ' / ' . $row[5];?></td>
                                <td style="border-left: 1px solid black;text-align:center;border-bottom:1px solid #ccc;"><?PHP echo $row[2];?></td>
                                <td style="border-left: 1px solid black;text-align:right;border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $row[1]);?></td>
                                <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:right;border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $row[3]);?></td>
                            </tr>
                        <?PHP
                        $x++;
                        } // /while
                        
                        ?> 
                        </table>




                    </td>
                  </tr>
                  <tr >
                     <td style="border-top: 1px solid black;"></td>
                     <td style="border-top: 1px solid black;"></td>
                     <td style="border-top: 1px solid black;"></td>
                     <td style="border-top: 1px solid black;text-align:right">Total</td>
                     <td style="border-top: 1px solid black;border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $subTotal);?></td>
                  </tr>
                  <tr>
                     <td colspan="2">&nbsp;</td>
                     <td colspan="2" style="text-align:right;">Total w/tax</td>
                     <td style="border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $totalAmount);?></td>
                  </tr>
                  
                  <tr>
                     <td colspan="2">&nbsp;</td>
                     <td colspan="2" style="text-align:right;">Discount</td>
                     <td style="border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $discount);?>
                     </td>
                  </tr>
                  <tr>
                  <td colspan="3" rowspan="3" style="color: blue;" valign="top"><?PHP echo nl2br($notes);?></td>
                     <td>Tax</td>
                     <td style="border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $tax);?></td>
                  </tr>
                  <tr>
                     
                     <td>Paid</td>
                     <td style="border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n',$paid);?></td>
                  </tr>
                  <tr>
                     
                     <td>Due</td>
                     <td style="border-bottom:1px solid #ccc;"><?PHP echo money_format('%.2n', $due);?></td>
                  </tr>
                
    </tbody>
                      
    </table>
</page>