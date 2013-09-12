<div class="DivCenterPage">
    <h1 class="TitleStandartPage"><?php echo $Model["page"]["title"]?></h1>
    <table class="TableStandartSS" cellpadding="0" cellspacing="0" >
        <tr><td colspan="3"  class="TdTableStandartSS"><div class="DivServiceSiteHeader"><h3><?php echo getLangString("ss_summary_h")?></h3><?php echo $Model["page"]["summary"]?></div></td></tr> 
        <tr><td colspan="3"  class="TdTableStandartSS"><div class="DivServiceSiteHeader"><h3><?php echo getLangString("ss_list_icon_h")?></h3><?php echo $Model["ss_list_icon"]?></div></td></tr> 
        <tr>
        <td class="TdSSFree"><div class="DivServiceSiteHeader"><h3><?php echo getLangString("ss_user_cab_h")?></h3><div class="DivServiceSiteListA"><?php echo getLangString("ss_user_cab")?></div></div></td>
        <td class="TdSSFreePadding"><div class="DivServiceSiteHeader"><h3><?php echo getLangString("ss_im_link_h")?></h3><div class="DivServiceSiteListA"><?php echo getLangString("ss_im_link")?></div></div></td>
        </tr> 
    </table>
</div>