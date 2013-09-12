<table class="TableCatalogPage" cellpadding="0" cellspacing="0">
		<tr>
			<td class="TCTdList">
				<?php if($Data):?>
				<h1 class="TitleCatalog">Услуги</h1>
				<div class="DivTableCP">
				<table class="TableInfo" border="0" cellpadding="0" cellspacing="0">
					<?php foreach ($Data as $key => $value):?>
						<tr>
							<td class="TableInfoTdImage">
								<a class="ALinkInfo" href="/ru/service/details/<?php echo $value['sc_id']?>" title="<?php echo $value['title']?>"><img src="<?php echo getLangString("imageDomain")?>/files/images/service/<?php echo $value['img']?>" alt="<?php echo $value['title']?>"></a>
							</td>
							<td class="TableInfoTdDescription">
								<a class="ALinkInfo" href="/ru/service/details/<?php echo $value['sc_id']?>" title="<?php echo $value['title']?>"><?php echo $value['title']?></a>
								<?php echo $value['description']?></td>
						</tr>
					<?php endforeach;?>	
				</table>
				</div>
				<?php endif;?>
			</td>
			<td><?php echo appHtmlClass::partialAction("immovables", "partialListHot", array( "cashe" => 1 )); ?></td>
		</tr>
</table>