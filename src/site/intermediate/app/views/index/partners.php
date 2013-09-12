<h1 class=TitleStandartPage>Партнеры</h1>

<table class=TableStandartCenterPage cellpadding=0 cellspacing=0>
	<tr>
		<td class=TSCPTdCenter>
			<?php if($Data):?>
				<?php foreach ($Data as $key => $value):?>
					<table cellpadding=0 cellspacing=0 border=0 class="">
						<tr>
							<td class=PartnerListImage><img src="<?php echo getLangString("imageDomain")?>/files/partner/<?php echo $value['partner_logo']?>" alt="<?php echo $value['partner_name']?>"></td>
							<td class=PartnerListText><p class=PPName><?php echo $value['partner_name']?></p><?php echo $value['partner_text']?></td>
						</tr>
					</table>
				<?php endforeach;?>
			<?php endif;?>
		</td>
		<td><?php echo appHtmlClass::partialAction("immovables", "partialListHot", array( "cashe" => 1 )); ?></td>
	</tr>
</table>